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

class PaymentForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $user = $this->auth->getUser();

        $adverts = new Select('adverts', Ad::find(array(
            'columns' => 'id,' . new RawConcat('CONCAT (showname, "-", id, " ", working_country) AS conName'),
            'users_id = ' . $user->id . ' and deleted = "N" and active = "Y" and (advertisement = "N" or end_date < now() or ad_days = 90)',
            'order' => 'showname ASC'
            )),
            array('useEmpty' => true, 'emptyText' =>  'Please select ...',
                'using' => array('id', 'conName')
            ));
        $adverts->setLabel('Models:');
        $adverts->addValidators(array(
            new PresenceOf(array(
                'message' => 'It is required to choose a model!'
            ))
        ));
        $this->add($adverts);

        $payment = new Radio('payment');
        //$payment->setDefault(1);
        $this->add($payment);

        $this->add(new Submit('Buy package', array(
            'class' => 'myButton3'
        )));
    }
}