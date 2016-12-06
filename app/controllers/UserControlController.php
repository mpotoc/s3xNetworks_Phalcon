<?php
namespace Adverts\Controllers;

use Adverts\Models\EmailConfirmations;
use Adverts\Models\Users;
use Adverts\Auth\Exception as AuthException;

/**
 * UserControlController
 * Provides help to users to confirm their account
 */
class UserControlController extends ControllerBase
{
    public function initialize()
    {
        if ($this->session->has('auth-identity'))
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $this->view->user = $user;
            $this->view->profileName = strtolower($user->profile->name);
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

            $this->view->mainLogo = $mainLogo;
            $this->view->mainTitle = $mainTitle;
            $this->view->sites = $sites;
            $this->view->setTemplateBefore('privat');
        }
    }

    public function indexAction()
    {

    }

    /**
     * Confirms an e-mail
     */
    public function confirmEmailAction()
    {
        try
        {
            $code = $this->dispatcher->getParam('code');
            $confirmation = EmailConfirmations::findFirstByCode($code);

            if (!$confirmation)
            {
                return $this->dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'index'
                ));
            }

            if ($confirmation->confirmed != 'N')
            {
                return $this->dispatcher->forward(array(
                    'controller' => 'session',
                    'action' => 'login'
                ));
            }

            $confirmation->confirmed = 'Y';
            $confirmation->user->active = 'Y';

            /**
             * Change the confirmation to 'confirmed' and update the user to 'active'
             */
            if ($confirmation->save())
            {
                /**
                 * Identify the user in the application
                 */
                $this->auth->authUserById($confirmation->user->id);
                $this->flash->success('The email was successfully confirmed');

                $user = Users::findFirstByEmail($confirmation->user->email);
                $profileName = strtolower($user->profile->name);

                /*return $this->dispatcher->forward(array(
                    'controller' => $profileName,
                    'action' => 'index'
                ));*/

                return $this->response->redirect($profileName);
            }
            else
            {
                foreach ($confirmation->getMessages() as $message)
                {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'index'
                ));
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }
}