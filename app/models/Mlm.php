<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Mlm extends Model
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
    public $users_id;

    /**
     *
     * @var integer
     */
    public $parent_id;

    /**
     *
     * @var integer
     */
    public $level;

    /**
     *
     * @var integer
     */
    public $isFull;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('users_id', __NAMESPACE__ . '\Users', 'id', array('alias' => 'user'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mlm';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mlm[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mlm
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
