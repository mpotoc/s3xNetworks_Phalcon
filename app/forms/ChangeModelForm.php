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

class ChangeModelForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $user = $this->auth->getUser();

        $adverts = new Select('adverts', Ad::find(array(
            'users_id = ' . $user->id . ' and ((advertisement = "N" and deleted = "N" and active = "Y") or end_date < now())',
            'order' => 'showname ASC'
        )),
            array('useEmpty' => true, 'emptyText' =>  'Please select ...',
                'using' => array('id', 'showname')
            ));
        $adverts->setLabel('Models:');
        $adverts->addValidators(array(
            new PresenceOf(array(
                'message' => 'It is required to choose a model!'
            ))
        ));
        $this->add($adverts);

        $this->add(new Submit('Change', array(
            'class' => 'myButton3'
        )));
    }
}