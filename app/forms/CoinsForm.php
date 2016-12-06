<?php
namespace Adverts\Forms;

use Adverts\Models\Packages;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class CoinsForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $packages = new Select('packages', Packages::find(array(
            'id in (15,16,17,18,19,20)'
        )),
            array('useEmpty' => true, 'emptyText' =>  'Please select ..',
                'using' => array('id', 'name')
            ));
        $packages->setLabel('s3xcoin packages:');
        $packages->addValidators(array(
            new PresenceOf(array(
                'message' => 'It is required to choose a package!'
            ))
        ));
        $this->add($packages);

        $this->add(new Submit('Buy', array(
            'class' => 'myButton3'
        )));
    }
}