<?php
namespace Adverts\Forms;

use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Submit;

class BannerExchangeForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // banner exchange
        $email = new Text('email');
        $email->setLabel('Your email:');
        $email->addValidator(new PresenceOf(array(
            'message' => 'Email field is required!'
        )));
        $this->add($email);

        $domain = new Text('domain');
        $domain->setLabel('Your domain:');
        $domain->addValidator(new PresenceOf(array(
            'message' => 'Domain field is required!'
        )));
        $this->add($domain);

        $banner = new TextArea('banner');
        $banner->setLabel('Your banner code:');
        $banner->addValidator(new PresenceOf(array(
            'message' => 'Banner code field is required!'
        )));
        $this->add($banner);

        $msg = new TextArea('msg');
        $msg->setLabel('Your message:');
        $msg->addValidator(new PresenceOf(array(
            'message' => 'Message field is required!'
        )));
        $this->add($msg);

        // Send form
        $this->add(new Submit('Send', array(
            'class' => 'myButton3'
        )));
    }
}
