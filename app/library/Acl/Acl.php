<?php
namespace Adverts\Acl;

use Phalcon\Mvc\User\Component;
use Phalcon\Acl\Adapter\Memory as AclMemory;
use Phalcon\Acl\Role as AclRole;
use Phalcon\Acl\Resource as AclResource;
use Adverts\Models\Profiles;

/**
 * Adverts\Acl\Acl
 */
class Acl extends Component
{
    /**
     * The ACL Object
     *
     * @var \Phalcon\Acl\Adapter\Memory
     */
    private $acl;

    /**
     * The filepath of the ACL cache file from APP_PATH
     *
     * @var string
     */
    private $filePath = '/app/cache/acl/data.txt';

    /**
     * Define the resources that are considered "private". These controller => actions require authentication.
     *
     * @var array
     */
    private $privateResources = array(
        'private' => array(
            'index',
            'addprofile',
            'managemodels',
            'editprofile',
            'gallery',
            'payment',
            'coins',
            'tours',
            'verification',
            'settings',
            'support',
            'video',
            'pm',
            'comments',
            'boostprofile',
            'blacklist',
            'deletemodel',
            'deletegallery',
            'deactivatemodel',
            'activatemodel',
            'pay',
            'changepackage',
            'result',
            'changecity',
            'vip',
            'delete',
            'bonus',
            'loadMlm',
            'documents',
            'withdraw',
            'extend'
        ),
        'member' => array(
            'index',
            'pm',
            'comments',
            'favorites',
            'coins',
            'gift',
            'settings',
            'support',
            'pay',
            'blacklist',
            'delete',
            'result'
        ),
        'administrator' => array(
            'index',
            'manageescorts',
            'manageclubs',
            'managemlm',
            'manageclients',
            'managepayments',
            'managecoins',
            'managetours',
            'manageverification',
            'settings',
            'support',
            'managevideos',
            'managepm',
            'managecomments',
            'manageblacklists'
        )
    );

    /**
     * Human-readable descriptions of the actions used in {@see $privateResources}
     *
     * @var array
     */
    private $actionDescriptions = array(
        'index' => 'Access',
        'addprofile' => 'Add Model Profile'/*,
        'independent' => 'Independent'*/
    );

    /**
     * Checks if a controller is private or not
     *
     * @param string $controllerName
     * @return boolean
     */
    public function isPrivate($controllerName)
    {
        $controllerName = strtolower($controllerName);
        return isset($this->privateResources[$controllerName]);
    }

    /**
     * Checks if the current profile is allowed to access a resource
     *
     * @param string $profile
     * @param string $controller
     * @param string $action
     * @return boolean
     */
    public function isAllowed($profile, $controller, $action)
    {
        return $this->getAcl()->isAllowed($profile, $controller, $action);
    }

    /**
     * Returns the ACL list
     *
     * @return 'Phalcon\Acl\Adapter\Memory'
     */
    public function getAcl()
    {
        // Check if the ACL is already created
        if (is_object($this->acl))
        {
            return $this->acl;
        }

        // Check if the ACL is in APC
        if (function_exists('apc_fetch'))
        {
            $acl = apc_fetch('adverts-acl');
            if (is_object($acl))
            {
                $this->acl = $acl;
                return $acl;
            }
        }

        // Check if the ACL is already generated
        if (!file_exists(APP_PATH . $this->filePath))
        {
            $this->acl = $this->rebuild();
            return $this->acl;
        }

        // Get the ACL from the data file
        $data = file_get_contents(APP_PATH . $this->filePath);
        $this->acl = unserialize($data);

        // Store the ACL in APC
        if (function_exists('apc_store'))
        {
            apc_store('adverts-acl', $this->acl);
        }

        return $this->acl;
    }

    /**
     * Returns the permissions assigned to a profile
     *
     * @param Profiles $profile
     * @return array
     */
    public function getPermissions(Profiles $profile)
    {
        $permissions = array();
        foreach ($profile->getPermissions() as $permission)
        {
            $permissions[$permission->res . '.' . $permission->act] = true;
        }

        return $permissions;
    }

    /**
     * Returns all the resoruces and their actions available in the application
     *
     * @return array
     */
    public function getResources()
    {
        return $this->privateResources;
    }

    /**
     * Returns the action description according to its simplified name
     *
     * @param string $action
     * @return $action
     */
    public function getActionDescription($action)
    {
        if (isset($this->actionDescriptions[$action]))
        {
            return $this->actionDescriptions[$action];
        }
        else
        {
            return $action;
        }
    }

    /**
     * Rebuilds the access list into a file
     *
     * @return \Phalcon\Acl\Adapter\Memory
     */
    public function rebuild()
    {
        $acl = new AclMemory();

        $acl->setDefaultAction(\Phalcon\Acl::DENY);

        // Register roles
        $profiles = Profiles::find('active = "Y"');

        foreach ($profiles as $profile)
        {
            $acl->addRole(new AclRole($profile->name));
        }

        foreach ($this->privateResources as $res => $act)
        {
            $acl->addResource(new AclResource($res), $act);
        }

        // Grant acess to private areas
        foreach ($profiles as $profile)
        {
            // Grant permissions in "permissions" model
            foreach ($profile->getPermissions() as $permission)
            {
                $acl->allow($profile->name, $permission->res, $permission->act);
            }

            // Always grant these permissions
            /*$acl->allow($profile->name, 'users', 'changePassword');*/
        }

        if (touch(APP_PATH . $this->filePath) && is_writable(APP_PATH . $this->filePath))
        {
            file_put_contents(APP_PATH . $this->filePath, serialize($acl));

            // Store the ACL in APC
            if (function_exists('apc_store'))
            {
                apc_store('adverts-acl', $acl);
            }
        }
        else
        {
            $this->flash->error(
                'The user does not have write permissions to create the ACL list at ' . APP_PATH . $this->filePath
            );
        }

        return $acl;
    }
}