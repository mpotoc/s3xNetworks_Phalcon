<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class City extends Model
{

    /**
     *
     * @var integer
     */
    public $geoname_id;

    /**
     *
     * @var string
     */
    public $locale_code;

    /**
     *
     * @var string
     */
    public $continent_code;

    /**
     *
     * @var string
     */
    public $continent_name;

    /**
     *
     * @var string
     */
    public $country_iso_code;

    /**
     *
     * @var string
     */
    public $country_name;

    /**
     *
     * @var string
     */
    public $subdivision_1_iso_code;

    /**
     *
     * @var string
     */
    public $subdivision_1_name;

    /**
     *
     * @var string
     */
    public $subdivision_2_iso_code;

    /**
     *
     * @var string
     */
    public $subdivision_2_name;

    /**
     *
     * @var string
     */
    public $city_name;

    /**
     *
     * @var string
     */
    public $metro_code;

    /**
     *
     * @var string
     */
    public $time_zone;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'city';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return City[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return City
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
