<?php
namespace Adverts\Forms;

use Adverts\Models\Ad;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class PMForm extends Form
{
    public function initialize()
    {
        // Models
        $ad = new Select('ad', Ad::find(
            array('order' => 'showname ASC')),
            array('useEmpty' => true,
                'emptyText' =>  'Please select ...',
                'using' => array('id', 'showname')
            ));
        $ad->setLabel('Model:');
        $ad->addValidator(new PresenceOf(array(
            'message' => 'The model must be selected'
        )));
        $this->add($ad);

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