<?php
namespace Adverts\Forms;

use Adverts\Models\Country;
use Adverts\Models\City;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class ToursForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $baseCountry = $this->config->application->baseCountry;

        // Working country
        $country = new Select('working_country', Country::find(
            array('country_iso_code in ("AU", "AT", "BR", "CA", "FR", "DE", "GR", "IL", "IT", "PT", "ES", "CH", "TR", "AE", "GB", "US", "SE", "NO", "FI",
            "DK", "IS", "BE", "NL", "LU", "MC", "AR", "CL", "CO", "MX", "DO", "CU", "BO", "VE", "EC", "ZA", "EG", "KE", "CM", "NG", "GH", "CI", "HK",
            "SG", "CN", "TH", "JP", "KR", "MY", "ID", "PH", "TW", "IN", "OM", "BH", "KW", "KZ", "QA", "LB", "JO", "SA", "MO", "RU", "UA", "BY", "MD",
            "RO", "BG", "EE", "LT", "LV", "PL", "CZ", "SK", "HU", "RS", "SI", "HR", "BA", "CY")',
                'order' => 'country_name ASC')),
            array('useEmpty' => true,
                'emptyText' =>  'Please select ...',
                'using' => array('country_name', 'country_name')
            ));
        $country->setLabel('Country:');
        $country->setDefault($entity->working_country);
        $country->addValidators(array(
            new PresenceOf(array(
                'message' => 'It is required to choose a country!'
            ))
        ));
        $this->add($country);

        // Working city
        if (isset($entity))
        {
            $wcountry = Country::findFirst(array(
                'country_name = "' . $entity->working_country . '"'
            ));
            $country = $wcountry->country_iso_code;
            $working_city = new Select('working_city', City::find(
                array('country_iso_code = "' . $country . '" and city_name<>""', 'group' => 'city_name', 'order' => 'city_name ASC')),
                array('using' => array('city_name', 'city_name')
                ));
        }
        else
        {
            $working_city = new Select('working_city', City::find(
                array('country_iso_code = "' . $baseCountry . '" and city_name<>""', 'group' => 'city_name', 'order' => 'city_name ASC')),
                array('using' => array('city_name', 'city_name')
                ));
        }
        $working_city->setLabel('Select cities:');
        $this->add($working_city);

        // Selected working city
        $working_city_sel = new Select('working_city_sel1', []);
        $working_city_sel->setLabel('Next tour:');
        $working_city_sel->addValidator(new PresenceOf(array(
            'message' => 'Selected cities field is required!'
        )));
        $this->add($working_city_sel);

        $this->add(new Submit('Set tour', array(
            'class' => 'myButton3'
        )));
    }
}