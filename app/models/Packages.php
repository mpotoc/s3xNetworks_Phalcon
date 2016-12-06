<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Packages extends Model
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
     * @var integer
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $coins;

    /**
     *
     * @var integer
     */
    public $day;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\Advertising', 'packages_id', array('alias' => 'advertising'));
        $this->hasMany('id', __NAMESPACE__ . '\Payments', 'packages_id', array('alias' => 'payments'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'packages';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Packages[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Packages
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
