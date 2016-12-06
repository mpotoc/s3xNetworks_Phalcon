<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Ip2c extends Model
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
    public $begin_ip;

    /**
     *
     * @var string
     */
    public $end_ip;

    /**
     *
     * @var integer
     */
    public $begin_ip_num;

    /**
     *
     * @var integer
     */
    public $end_ip_num;

    /**
     *
     * @var string
     */
    public $country_code;

    /**
     *
     * @var string
     */
    public $country_name;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ip2c';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ip2c[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ip2c
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
