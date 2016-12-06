<?php
namespace Adverts\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class CommentForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // Comment
        $comment = new TextArea('comment');
        $comment->setLabel('Comment:');
        $comment->addValidator(new PresenceOf(array(
            'message' => 'Comment field is required!'
        )));
        $this->add($comment);

        // Sign Up
        $this->add(new Submit('Comment', array(
            'class' => 'myButton3'
        )));
    }
}
