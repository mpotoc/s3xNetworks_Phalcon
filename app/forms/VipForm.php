<?php
namespace Adverts\Forms;

use Adverts\Models\Ad;
use Adverts\Models\Packages;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Db\RawValue as RawConcat;

class VipForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $user = $this->auth->getUser();

        $adverts = new Select('adverts', Ad::find(array(
            'columns' => 'id,'.new RawConcat('CONCAT (showname, "-", id, " ", working_country, " - Package ends: ", end_date, " CET") AS conName'),
            'users_id = ' . $user->id . ' and advertisement = "Y" and deleted = "N" and active = "Y" and end_vip < now() and end_date > now()',
            'order' => 'showname ASC'
        )),
            array('useEmpty' => true, 'emptyText' =>  'Please select ...',
                'using' => array('id', 'conName')
            ));
        $adverts->setLabel('Active models:');
        $adverts->addValidators(array(
            new PresenceOf(array(
                'message' => 'It is required to choose an active model!'
            ))
        ));
        $this->add($adverts);

        $vipDays = new Text('vipDays');
        $vipDays->setLabel('VIP days:');
        $vipDays->addValidator(new PresenceOf(array(
            'message' => 'How many days field is required!'
        )));
        $this->add($vipDays);

        $this->add(new Submit('Buy VIP', array(
            'class' => 'myButton3'
        )));
    }
}