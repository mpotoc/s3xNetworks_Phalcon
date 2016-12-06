<?php
namespace Adverts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class UsersForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // Name
        $name = new Text('name');
        $name->setLabel('Username:');
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail:');
        $this->add($email);

        // Old Password
        $opassword = new Password('opassword');
        $opassword->setLabel('Current password:');
        $opassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'Current password is required'
            ))
        ));
        $this->add($opassword);
        $opassword->clear();

        // Password
        $password = new Password('password');
        $password->setLabel('Password:');
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'The password is required'
            )),
            new StringLength(array(
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
            )),
            new Confirmation(array(
                'message' => 'Password doesn\'t match confirmation',
                'with' => 'confirmPassword'
            ))
        ));
        $this->add($password);
        $password->clear();

        // Confirm Password
        $confirmPassword = new Password('confirmPassword');
        $confirmPassword->setLabel('Confirm Password:');
        $confirmPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'The confirmation password is required'
            ))
        ));
        $this->add($confirmPassword);
        $confirmPassword->clear();

        // Sign Up
        $this->add(new Submit('Change', array(
            'class' => 'myButton3'
        )));
    }
}
