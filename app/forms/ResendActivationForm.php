<?php
namespace Adverts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class ResendActivationForm extends Form
{
    public function initialize()
    {
        $email = new Text('email');
        $email->setLabel('E-Mail:');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'The e-mail is required'
            )),
            new Email(array(
                'message' => 'The e-mail is not valid'
            ))
        ));
        $this->add($email);

        $this->add(new Submit('Resend', array(
            'class' => 'myButton3'
        )));
    }
}