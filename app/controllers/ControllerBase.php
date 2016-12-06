<?php
namespace Adverts\Controllers;

use Adverts\Auth\Exception as AuthException;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        try
        {
            $controllerName = $dispatcher->getControllerName();

            // Only check permissions on private controllers
            if ($this->acl->isPrivate($controllerName))
            {
                // Get the current identity
                $identity = $this->auth->getIdentity();

                // If there is no identity available the user is redirected to index/index
                if (!is_array($identity))
                {
                    $this->flash->warning('Unauthorized. You don\'t have access to this page. Please Sign Up or Log In or contact an administrator!');

                    /*$dispatcher->forward(array(
                        'controller' => 'index',
                        'action' => 'index'
                    ));*/
                    $this->response->redirect('');
                    return false;
                }

                // Check if the user have permission to the current option
                $actionName = $dispatcher->getActionName();
                if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName))
                {
                    $this->flash->warning('Unauthorized. You don\'t have access to this module: ' . $controllerName . ':' . $actionName . '!');

                    if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index'))
                    {
                        /*$dispatcher->forward(array(
                            'controller' => $controllerName,
                            'action' => 'index'
                        ));*/
                        $this->response->redirect($controllerName);
                    }
                    else
                    {
                        /*$dispatcher->forward(array(
                            'controller' => 'index',
                            'action' => 'index'
                        ));*/
                        $this->response->redirect('');
                    }

                    return false;
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }
}