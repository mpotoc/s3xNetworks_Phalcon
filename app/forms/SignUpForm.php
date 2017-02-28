<?php
namespace Adverts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class SignUpForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $name = new Text('name');
        $name->setLabel('Username:');
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'The name is required'
            ))
        ));
        $this->add($name);

        // Email
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

        $code = new Text('code');
        $code->setLabel('Bonus code:');
        $this->add($code);

        // Terms
        $terms = new Check('termscond', array(
            'value' => 'yes'
        ));
        $terms->setLabel('Accept term and conditions');
        $terms->addValidator(new Identical(array(
            'value' => 'yes',
            'message' => 'Terms and conditions must be accepted'
        )));
        $this->add($terms);
        $terms->clear();

        // Sign Up
        $this->add(new Submit('Sign Up', array(
            'class' => 'myButton3'
        )));
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name))
        {
            foreach ($this->getMessagesFor($name) as $message)
            {
                $this->flash->error($message);
            }
        }
    }
}