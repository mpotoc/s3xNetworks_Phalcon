<?php
namespace Adverts\Controllers;

use Adverts\Forms\PMForm;
use Adverts\Forms\CoinsForm;
use Adverts\Models\Coins;
use Adverts\Models\PrivateMessages;
use Adverts\Models\Packages;
use Phalcon\Tag;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Adverts\Models\Users;
use Adverts\Models\Support;
use Adverts\Forms\UsersForm;
use Adverts\Forms\SupportForm;
use Adverts\Auth\Exception as AuthException;

class MemberController extends ControllerBase
{
    public function initialize()
    {
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

    public function indexAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $coins = Coins::find(array(
                'users_id = ' . $user->id
            ));
            $sum_coins = 0;

            foreach ($coins as $c)
            {
                $sum_coins += $c->value;
            }

            $this->view->coins = $sum_coins;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function pmAction()
    {
        $this->persistent->conditions = null;

        $user = $this->auth->getUser();

        $numberPage = 1;

        //$pm = PrivateMessages::findByUsers_id($user->id);
        $sql = 'SELECT pm.*, a.showname from private_messages pm inner join ad a on pm.to_user = a.id where pm.users_id = "'.$user->id.'"  group by pm.users_id ASC';
        $conn = $this->db;
        $data = $conn->query($sql);
        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $results = $data->fetchAll();

        /*
          * SELECT pm.*, a.showname from private_messages pm inner join ad a on pm.to_user = a.id where pm.users_id = "'.$user->id.'"  group by pm.users_id ASC
         */

        $paginator = new Paginator(array(
            "data"  => $results,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $results;

        $form = new PMForm();

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
                if (!$user)
                {
                    $this->flash->error('There is an error!');
                }
                else
                {
                    $ts = new \DateTime();
                    $str = $ts->format('Y-m-d H:i:s');

                    $privatem = new PrivateMessages();
                    $privatem->users_id = $user->id;
                    $privatem->to_user = $this->request->getPost('ad');
                    $privatem->message = $this->request->getPost('message');
                    $privatem->date = $str;

                    if ($privatem->save())
                    {
                        $this->flash->success('You send a private message!');
                        $form->clear();
                        return $this->response->redirect('member/support');
                    }
                    else
                    {
                        foreach ($privatem->getMessages() as $message)
                        {
                            $this->flash->error($message);
                        }
                    }
                }
            }
        }

        $this->view->form = $form;
    }

    public function commentsAction()
    {
        $this->persistent->conditions = null;
    }

    public function favoritesAction()
    {
        $this->persistent->conditions = null;
    }

    public function coinsAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $form = new CoinsForm();

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
                    $packages_id = $this->request->getPost('packages');
                    $this->response->redirect('member/pay/' . $packages_id);
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function payAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $packages = Packages::findFirst(array(
                'id = ' . $param
            ));

            $price = $packages->price;
            $micro = sprintf("%06d",(microtime(true) - floor(microtime(true))) * 1000000);

            $json = '{"version":"3","public_key":"'.$this->config->application->liqpay_public.'","action":"pay","amount":'.$price.',"currency":"EUR","description":"'.$packages->name.'","order_id":"'.$user->id.'|'.$packages->id.'|'.$micro.'","language":"en","server_url":"http://'.$_SERVER['SERVER_NAME'].'/callback.php","result_url":"http://'.$_SERVER['SERVER_NAME'].'/member/result"}';
            // "sandbox":"1",

            $data = base64_encode($json);
            $signature = base64_encode(sha1($this->config->application->liqpay_private.$data.$this->config->application->liqpay_private, 1));

            $this->view->data = $data;
            $this->view->signature = $signature;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function resultAction()
    {
        $this->persistent->conditions = null;
    }

    public function giftAction()
    {
        $this->persistent->conditions = null;
    }

    public function deleteAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            if ($idarray[1] == 'support')
            {
                $this->db->delete('support', 'id = ' . $idarray[0]);

                $this->flash->success('You have successfully deleted support ticket.');
                $this->response->redirect('member/support');
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function settingsAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $form = new UsersForm();

            $user = $this->auth->getUser();

            $u = Users::findFirst(array(
                'id = ' . $user->id
            ));

            $this->view->u = $u;

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
                    $salt = $u->salt;
                    $pwd = $this->request->getPost('opassword');
                    $newpwd = $this->request->getPost('password');

                    if ($pwd == $salt && $pwd != $newpwd)
                    {
                        $user = Users::findFirstById($user->id);
                        $user->password = $this->security->hash($newpwd);
                        $user->salt = $newpwd;

                        if ($user->update())
                        {
                            $this->flash->success('You have successfully changed your password.');
                            $this->response->redirect('member');
                        }
                    }
                    elseif ($pwd == $newpwd)
                    {
                        $this->flash->error('Your new password must be different then old one!');
                        $form->clear();
                    }
                    else
                    {
                        $this->flash->error('Your old password is not the same as in database!');
                        $form->clear();
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function supportAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $numberPage = 1;

            $support = Support::findByUsers_id($user->id);

            $paginator = new Paginator(array(
                "data"  => $support,
                "limit" => 10,
                "page"  => $numberPage
            ));

            $this->view->page = $paginator->getPaginate();

            $form = new SupportForm();

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
                    if (!$user)
                    {
                        $this->flash->error('There is an error!');
                    }
                    else
                    {
                        $ts = new \DateTime();
                        $str = $ts->format('Y-m-d H:i:s');

                        $support = new Support();
                        $support->users_id = $user->id;
                        $support->subject = $this->request->getPost('subject');
                        $support->message = $this->request->getPost('message');
                        $support->path_to_file = '/';
                        $support->date = $str;

                        if ($support->save())
                        {
                            $this->flash->success('Thank you for sending a support ticket. We will reply to your support ticket ASAP!');
                            $form->clear();
                            return $this->response->redirect('member/support');
                        }
                        else
                        {
                            foreach ($support->getMessages() as $message)
                            {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }
}