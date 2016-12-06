<?php
namespace Adverts\Forms;

use Adverts\Models\City;
use Adverts\Models\Country;
use Adverts\Models\Ethnicity;
use Adverts\Models\Nationality;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class AdForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $baseCountry = $this->config->application->baseCountry;
        $workingCountry = $this->config->application->workingCountry;

        // Shownamw
        $showname = new Text('showname');
        $showname->setLabel('Showname:');
        $showname->addValidator(new PresenceOf(array(
            'message' => 'Showname field is required!'
        )));
        $this->add($showname);

        // Slogan
        $slogan = new Text('slogan');
        $slogan->setLabel('Slogan:');
        $this->add($slogan);

        // Gender
        $gender = new Radio('gender');
        $gender->setLabel('Gender:');
        $gender->setDefault('F');
        $this->add($gender);

        // Age
        $age = new Text('age');
        $age->setLabel('Age:');
        $this->add($age);

        // Ethnicity
        $ethnicity = new Select('ethnicity', Ethnicity::find(
            array('order' => 'ethnicity ASC')),
            array('useEmpty' => true,
                'emptyText' =>  'Please select ...',
                'using' => array('ethnicity', 'ethnicity')
        ));
        $ethnicity->setLabel('Ethnicity:');
        $this->add($ethnicity);

        // Nationality
        $nationality = new Select('nationality', Nationality::find(
            array('order' => 'nationality ASC')),
            array('useEmpty' => true,
                'emptyText' =>  'Please select ...',
                'using' => array('nationality', 'nationality')
        ));
        $nationality->setLabel('Nationality:');
        $this->add($nationality);

        // Country
        $home_country = new Select('home_country', Country::find(
            array('order' => 'country_name ASC')),
            array('useEmpty' => true,
                'emptyText' =>  'Please select ...',
                'using' => array('country_name', 'country_name')
            ));
        $home_country->setLabel('Home country:');
        $this->add($home_country);

        // Hairstyle
        $hairstyle = new Text('hairstyle');
        $hairstyle->setLabel('Hairstyle:');
        $this->add($hairstyle);

        // Eyes
        $eyes = new Text('eyes');
        $eyes->setLabel('Eyes:');
        $this->add($eyes);

        // Measurement
        $measurement = new Text('measurement');
        $measurement->setLabel('Measurement:');
        $this->add($measurement);

        // Languages
        $languages = new Text('languages');
        $languages->setLabel('Languages:');
        $this->add($languages);

        // Working time
        $working_time = new Text('working_time');
        $working_time->setLabel('Working time:');
        $this->add($working_time);

        // About me
        $about_me = new TextArea('about_me');
        $about_me->setLabel('About me:');
        $about_me->addValidator(new PresenceOf(array(
            'message' => 'About me field is required!'
        )));
        $this->add($about_me);

        // Working country
        $working_country = new Select('working_country', Country::find(
            array('country_iso_code in ("AU", "AT", "BR", "CA", "FR", "DE", "GR", "IL", "IT", "PT", "ES", "CH", "TR", "AE", "GB", "US", "SE", "NO", "FI",
            "DK", "IS", "BE", "NL", "LU", "MC", "AR", "CL", "CO", "MX", "DO", "CU", "BO", "VE", "EC", "ZA", "EG", "KE", "CM", "NG", "GH", "CI", "HK",
            "SG", "CN", "TH", "JP", "KR", "MY", "ID", "PH", "TW", "IN", "OM", "BH", "KW", "KZ", "QA", "LB", "JO", "SA", "MO", "RU", "UA", "BY", "MD",
            "RO", "BG", "EE", "LT", "LV", "PL", "CZ", "SK", "HU", "RS", "SI", "HR", "BA", "CY")',
                'order' => 'country_name ASC')),
            array('useEmpty' => true,
                'emptyText' =>  'Please select ...',
                'using' => array('country_name', 'country_name')
            ));
        $working_country->setLabel('Working country:');
        $working_country->setDefault($workingCountry);
        $working_country->addValidator(new PresenceOf(array(
            'message' => 'Working country field is required!'
        )));
        $this->add($working_country);

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
        if (isset($entity))
        {
            $cities = array();
            if ($entity->working_city1)
            {
                $cities[$entity->working_city1] = $entity->working_city1;
            }
            if ($entity->working_city2)
            {
                $cities[$entity->working_city2] = $entity->working_city2;
            }
            if ($entity->working_city3)
            {
                $cities[$entity->working_city3] = $entity->working_city3;
            }
            if ($entity->working_city4)
            {
                $cities[$entity->working_city4] = $entity->working_city4;
            }
            $working_city_sel = new Select('working_city_sel', $cities);
        }
        else
        {
            $working_city_sel = new Select('working_city_sel', []);
        }
        $working_city_sel->setLabel('Working cities:');
        $working_city_sel->addValidator(new PresenceOf(array(
            'message' => 'Selected cities field is required!'
        )));
        $this->add($working_city_sel);

        // Prices
        $price1 = new Text('price1');
        $price1->setLabel('30 minutes:');
        $price1->addValidator(new PresenceOf(array(
            'message' => 'The price field for 30 minutes is required!'
        )));
        $this->add($price1);

        $price2 = new Text('price2');
        $price2->setLabel('1 hour:');
        $price2->addValidator(new PresenceOf(array(
            'message' => 'The price field 1 hour is required!'
        )));
        $this->add($price2);

        $price3 = new Text('price3');
        $price3->setLabel('2 hours:');
        $this->add($price3);

        $price4 = new Text('price4');
        $price4->setLabel('Night:');
        $this->add($price4);

        // Phone
        $phone = new Text('phone');
        $phone->setLabel('Phone number:');
        $phone->addValidator(new PresenceOf(array(
            'message' => 'The phone number field is required!'
        )));
        $this->add($phone);

        // Contact me
        $sms_call = new Radio('contact_me');
        $sms_call->setLabel('Contact me:');
        $sms_call->setDefault('C');
        $this->add($sms_call);

        $no_witheld = new Check('no_witheld');
        $no_witheld->setLabel('No witheld numbers:');
        $this->add($no_witheld);

        // Social networks
        $social = new Text('social');
        $social->setLabel('Apps:');
        $this->add($social);

        $chekWhatsapp = new Check('chekWhatsapp');
        $chekWhatsapp->setLabel('WhatsApp:');
        $this->add($chekWhatsapp);

        $chekViber = new Check('chekViber');
        $chekViber->setLabel('Viber:');
        $this->add($chekViber);

        $chekLine = new Check('chekLine');
        $chekLine->setLabel('Line:');
        $this->add($chekLine);

        $chekWechat = new Check('chekWechat');
        $chekWechat->setLabel('Wechat:');
        $this->add($chekWechat);

        // Skype
        $skype = new Text('skype');
        $skype->setLabel('Skype:');
        $this->add($skype);

        // Website
        $website = new Text('website');
        $website->setLabel('Website:');
        $this->add($website);

        // Services
        $services = new TextArea('services');
        $services->setLabel('Services:');
        $services->addValidator(new PresenceOf(array(
            'message' => 'Services field is required!'
        )));
        $this->add($services);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail:');
        $this->add($email);

        // Orientation
        $orientation = new Radio('orientation');
        $orientation->setLabel('Orientation:');
        $this->add($orientation);

        // Submit
        $this->add(new Submit('Save', array(
            'class' => 'myButton3'
        )));
    }
}