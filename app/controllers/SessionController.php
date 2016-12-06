<?php
namespace Adverts\Controllers;

use Adverts\Forms\LoginForm;
use Adverts\Forms\SignUpForm;
use Adverts\Forms\ForgotPasswordForm;
use Adverts\Forms\ResendActivationForm;
use Adverts\Auth\Exception as AuthException;
use Adverts\Models\Users;
use Adverts\Models\ResetPassword;
use Adverts\Models\EmailConfirmations;

/**
 * Needs to make that when logged in and you move to another country on right side you are still logged in
 */

/**
 * Controller used handle non-authenticated session actions like login/logout, user signup, and forgotten passwords
 */
class SessionController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $mainLogo = $this->config->application->mainLogo;
        $mainTitle = $this->config->application->mainTitle;

        try
        {
            $sql1 = 'SELECT * FROM sites where active = "Y" order by RAND() LIMIT 6';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $sites = $data1->fetchAll();
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }

        if (!$this->auth->getIdentity())
        {
            $this->view->mainLogo = $mainLogo;
            $this->view->mainTitle = $mainTitle;
            $this->view->sites = $sites;
            $this->view->setTemplateBefore('public');
        }
        else
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $this->view->user = $user;
            $this->view->profileName = strtolower($user->profile->name);
            $this->view->mainLogo = $mainLogo;
            $this->view->mainTitle = $mainTitle;
            $this->view->sites = $sites;
            $this->view->setTemplateBefore('privat');
        }
    }

    public function indexAction()
    {

    }

    public function registerAction()
    {

    }

    /**
     * Allow a user to signup to the system
     */
    public function signupAction($param) {
        $form = new SignUpForm();

        try {
            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $email = $this->request->getPost('email');
                    $chkUser = Users::findFirst(array(
                        'email = "'.$email.'"'
                    ));
                    $exists = $chkUser->id;

                    if (!$exists) {
                        $user = new Users();
                        $salt = $this->request->getPost('password');
                        $code = $this->request->getPost('code');
                        $aff_code = uniqid('s3x', true);

                        if (!$param)
                            $param = 2;

                        if ($code) {
                            $parent = Users::findFirst(array(
                                'code = "'.$code.'"'
                            ));
                            if ($parent) {
                                $parent_id = $parent->id;
                            } else {
                                $parent_id = 0;
                            }
                        } else {
                            $parent_id = 0;
                        }

                        $user->assign(array(
                            'parent_id' => $parent_id,
                            'name' => $this->request->getPost('name'),
                            'email' => $email,
                            'password' => $this->security->hash($this->request->getPost('password')),
                            'salt' => $salt,
                            'profiles_id' => $param,
                            'code' => $aff_code
                        ));

                        if ($user->save()) {
                            return $this->response->redirect('login');
                        } else {
                            $this->flash->error('There was some unexpected error. Please try again!');
                            $form->clear();
                        }
                    } else {
                        $this->flash->error('The user already exists in the system! Register with different e-mail!');
                        $form->clear();
                    }
                }
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {
        $form = new LoginForm();

        try
        {
            if (!$this->request->isPost())
            {
                if ($this->auth->hasRememberMe())
                {
                    return $this->auth->loginWithRememberMe();
                }
            }
            else
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $this->auth->check(array(
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')
                    ));

                    $user = Users::findFirstByEmail($this->request->getPost('email'));
                    $profileName = strtolower($user->profile->name);

                    return $this->response->redirect($profileName);
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Sends the forgotten password to email
     */
    public function forgotPasswordAction()
    {
        $form = new ForgotPasswordForm();

        try
        {
            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $user = Users::findFirstByEmail($this->request->getPost('email'));
                    if (!$user)
                    {
                        $this->flash->error('There is no account associated to this email');
                    }
                    else
                    {
                        $resetPassword = new ResetPassword();
                        $resetPassword->users_id = $user->id;
                        $resetPassword->password = $user->salt;

                        if ($resetPassword->save())
                        {
                            $this->flash->success('Please check your email messages for an email with your password!');
                            $form->clear();
                        }
                        else
                        {
                            foreach ($resetPassword->getMessages() as $message)
                            {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Resends the activation link
     */
    public function resendActivationAction()
    {
        $form = new ResendActivationForm();

        try
        {
            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $user = Users::findFirstByEmail($this->request->getPost('email'));
                    if (!$user)
                    {
                        $this->flash->error('There is no account associated to this email');
                    }
                    else
                    {
                        $resendActivation = EmailConfirmations::findFirstByUsers_id($user->id);
                        $email = $user->email;
                        $name = $user->name;

                        $resendEmail = $this->getDI()->getMail()->send(array(
                            $email => $name), "Account Verification", 'confirmation', array(
                            'confirmUrl' => '/confirm/' . $resendActivation->code . '/' . $email
                        ));

                        if ($resendEmail)
                        {
                            $this->flash->success('Please check your email messages for an email with the activation link!');
                            $form->clear();
                        }
                        else
                        {
                            foreach ($resendActivation->getMessages() as $message)
                            {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();

        return $this->response->redirect('');
    }
}