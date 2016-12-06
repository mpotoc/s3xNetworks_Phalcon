<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Profiles extends Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $active;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\Users', 'profiles_id', array('alias' => 'users'));
        $this->hasMany('id', __NAMESPACE__ . '\Permissions', 'profiles_id', array('alias' => 'permissions'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'profiles';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Profiles[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Profiles
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
