<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Permissions extends Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $profiles_id;

    /**
     *
     * @var string
     */
    public $res;

    /**
     *
     * @var string
     */
    public $act;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('profiles_id', __NAMESPACE__ . '\Profiles', 'id', array('alias' => 'profile'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'permissions';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Permissions[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Permissions
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
