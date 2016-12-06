<?php
namespace Adverts\Auth;

use Adverts\Models\Ad;
use Phalcon\Mvc\User\Component;
use Adverts\Models\Users;
use Adverts\Models\RememberToken;
use Adverts\Models\SuccessLogins;
use Adverts\Models\FailedLogins;

/**
 * Adverts\Auth\Auth
 * Manages Authentication/Identity Management in Adverts
 */
class Auth extends Component
{
    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolan
     */
    public function check($credentials)
    {
        // Check if the user exist
        $user = Users::findFirstByEmail($credentials['email']);
        if ($user == false)
        {
            $this->registerUserThrottling(1);
            throw new Exception('Wrong email/password combination');
        }

        // Check the password
        if (!$this->security->checkHash($credentials['password'], $user->password))
        {
            $this->registerUserThrottling($user->id);
            throw new Exception('Wrong email/password combination');
        }

        // Check if the user was flagged
        $this->checkUserFlags($user);

        // Register the successful login
        $this->saveSuccessLogin($user);

        // Check if the remember me was selected
        if (isset($credentials['remember']))
        {
            $this->createRememberEnviroment($user);
        }

        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'name' => $user->name,
            'profile' => $user->profile->name
        ));
    }

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param 'Adverts\Models\Users $user'
     */
    public function saveSuccessLogin($user)
    {
        $successLogin = new SuccessLogins();
        $successLogin->users_id = $user->id;
        $successLogin->ipaddr = $this->request->getClientAddress();
        $successLogin->user_agent = $this->request->getUserAgent();
        if (!$successLogin->save())
        {
            $messages = $successLogin->getMessages();
            throw new Exception($messages[0]);
        }
    }

    /**
     * Implements login throttling
     * Reduces the efectiveness of brute force attacks
     *
     * @param int $userId
     */
    public function registerUserThrottling($userId)
    {
        $failedLogin = new FailedLogins();
        $failedLogin->users_id = $userId;
        $failedLogin->ipaddr = $this->request->getClientAddress();
        $failedLogin->attempts = time();
        $failedLogin->save();

        $att = FailedLogins::count(array(
            'ipaddr = ?0 AND attempts >= ?1',
            'bind' => array(
                $this->request->getClientAddress(),
                time() - 3600 * 6
            )
        ));

        switch ($att)
        {
            case 1:
            case 2:
                // no delay
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param 'Adverts\Models\Users $user'
     */
    public function createRememberEnviroment(Users $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);

        $remember = new RememberToken();
        $remember->users_id = $user->id;
        $remember->token = $token;
        $remember->user_agent = $userAgent;

        if ($remember->save() != false)
        {
            $expire = time() + 86400 * 8;
            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }

    /**
     * Check if the session has a remember me cookie
     *
     * @return boolean
     */
    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }

    /**
     * Logs on using the information in the coookies
     *
     * @return 'Phalcon\Http\Response'
     */
    public function loginWithRememberMe()
    {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = Users::findFirstById($userId);
        if ($user)
        {
            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token)
            {
                $remember = RememberToken::findFirst(array(
                    'users_id = ?0 AND token = ?1',
                    'bind' => array(
                        $user->id,
                        $token
                    )
                ));
                if ($remember)
                {
                    // Check if the cookie has not expired
                    if ((time() - (86400 * 8)) < $remember->createdAt)
                    {
                        // Check if the user was flagged
                        $this->checkUserFlags($user);

                        // Register identity
                        $this->session->set('auth-identity', array(
                            'id' => $user->id,
                            'name' => $user->name,
                            'profile' => $user->profile->name
                        ));

                        // Register the successful login
                        $this->saveSuccessLogin($user);

                        return $this->response->redirect(strtolower($user->profile->name));
                    }
                }
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect('login');
    }

    /**
     * Checks if the user is banned/inactive/suspended
     *
     * @param 'Adverts\Models\Users $user'
     */
    public function checkUserFlags(Users $user)
    {
        if ($user->active != 'Y')
        {
            throw new Exception('The user is inactive. Activate your profile with confirmation mail sent to you.');
        }

        if ($user->banned != 'N')
        {
            throw new Exception('The user is banned.');
        }

        if ($user->suspended != 'N')
        {
            throw new Exception('The user is suspended.');
        }
    }

    /**
     * Returns the current identity
     *
     * @return array
     */
    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    /**
     * Returns the current identity
     *
     * @return string
     */
    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['name'];
    }

    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        if ($this->cookies->has('RMU'))
        {
            $this->cookies->get('RMU')->delete();
        }

        if ($this->cookies->has('RMT'))
        {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth-identity');
    }

    /**
     * Auths the user by his/her id
     *
     * @param int $id
     */
    public function authUserById($id)
    {
        $user = Users::findFirstById($id);
        if ($user == false)
        {
            throw new Exception('The user does not exist');
        }

        $this->checkUserFlags($user);

        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'name' => $user->name,
            'profile' => $user->profile->name
        ));
    }

    /**
     * Get the entity related to user in the active identity
     *
     * @return 'Adverts\Models\Users'
     */
    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id']))
        {
            $user = Users::findFirstById($identity['id']);
            if ($user == false)
            {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }

    /**
     * Get ad id from the current chosen
     */
    public function getAd()
    {
        $idad = $this->session->get('bio');
        if (isset($idad['id']))
        {
            $ad = Ad::findFirstById($idad['id']);
            if ($ad == false)
            {
                throw new Exception('The ad does not exist');
            }

            return $ad;
        }

        return false;
    }
}