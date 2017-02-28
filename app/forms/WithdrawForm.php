<?php
namespace Adverts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class WithdrawForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // Comment
        $comment = new TextArea('amount');
        $comment->setLabel('Amount to withdraw:');
        $comment->addValidator(new PresenceOf(array(
            'message' => 'Amount to withdraw field is required!'
        )));
        $this->add($comment);

        // Sign Up
        $this->add(new Submit('Submit', array(
            'class' => 'myButton3'
        )));
    }
}
