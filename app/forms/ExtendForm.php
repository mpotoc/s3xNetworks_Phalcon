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

class ExtendForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $payment = new Radio('payment');
        //$payment->setDefault(1);
        $this->add($payment);

        $this->add(new Submit('Extend package', array(
            'class' => 'myButton3'
        )));
    }
}