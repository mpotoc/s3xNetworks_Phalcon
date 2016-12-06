<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Nationality extends Model
{

    /**
     *
     * @var string
     */
    public $country;

    /**
     *
     * @var string
     */
    public $nationality;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'nationality';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Nationality[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Nationality
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
