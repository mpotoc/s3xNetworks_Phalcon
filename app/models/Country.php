<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Country extends Model
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'country';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Country[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Country
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
