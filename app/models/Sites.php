<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Sites extends Model
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
    public $www;

    /**
     *
     * @var string
     */
    public $image;

    /**
     *
     * @var string
     */
    public $active;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sites';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Sites[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Sites
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
