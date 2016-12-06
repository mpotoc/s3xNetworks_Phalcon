<?php
namespace Adverts\Controllers;

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Adverts\Models\Users;

class AdministratorController extends ControllerBase
{
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
        $this->persistent->conditions = null;
    }

    public function manageescortsAction()
    {
        $this->persistent->conditions = null;
    }

    public function manageclubsAction()
    {
        $this->persistent->conditions = null;
    }

    public function managemlmAction()
    {
        $this->persistent->conditions = null;
    }

    public function manageclientsAction()
    {
        $this->persistent->conditions = null;
    }

    public function managepaymentsAction()
    {
        $this->persistent->conditions = null;
    }

    public function managecoinsAction()
    {
        $this->persistent->conditions = null;
    }

    public function managetoursAction()
    {
        $this->persistent->conditions = null;
    }

    public function manageverificationAction()
    {
        $this->persistent->conditions = null;
    }

    public function settingsAction()
    {
        $this->persistent->conditions = null;
    }

    public function supportAction()
    {
        $this->persistent->conditions = null;
    }

    public function managevideosAction()
    {
        $this->persistent->conditions = null;
    }

    public function managepmAction()
    {
        $this->persistent->conditions = null;
    }

    public function managecommentsAction()
    {
        $this->persistent->conditions = null;
    }

    public function manageblacklistsAction()
    {
        $this->persistent->conditions = null;
    }
}