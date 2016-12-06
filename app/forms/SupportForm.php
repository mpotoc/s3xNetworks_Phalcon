<?php
namespace Adverts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class SupportForm extends Form
{
    public function initialize()
    {
        // Subject
        $subject = new Text('subject');
        $subject->setLabel('Subject:');
        $subject->addValidator(new PresenceOf(array(
            'message' => 'The subject is required'
        )));
        $this->add($subject);

        // Message
        $message = new TextArea('message');
        $message->setLabel('Message:');
        $message->addValidator(new PresenceOf(array(
            'message' => 'The message is required'
        )));
        $this->add($message);

        // Submit
        $this->add(new Submit('Submit', array(
            'class' => 'myButton3'
        )));
    }
}