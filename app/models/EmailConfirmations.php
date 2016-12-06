<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class EmailConfirmations extends Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var string
     */
    public $code;

    /**
     *
     * @var integer
     */
    public $created;

    /**
     *
     * @var string
     */
    public $confirmed;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->created = time();

        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->confirmed = 'N';
    }

    /**
     * Send a confirmation e-mail to the user after create the account
     */
    public function afterCreate()
    {
        $user = Users::findFirst($this->users_id);
        $email = $user->email;
        $name = $user->name;

        $this->getDI()
            ->getMail()
            ->send(array(
                $email => $name
            ), "Account Verification", 'confirmation', array(
                'confirmUrl' => '/confirm/' . $this->code . '/' . $email
            ));

        $this->getDI()
            ->getFlash()
            ->notice('A confirmation mail has been sent to ' . $email . '. It can take few minutes before you receive it.');

        //$this->url;
        $this->getDI()
            ->getFlash()
            ->notice('If you didn\'t get a confirmation mail, use resend activation link and confirmation email will be resend to your email.');
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('users_id',  __NAMESPACE__ . '\Users', 'id', array('alias' => 'user'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'email_confirmations';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return EmailConfirmations[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return EmailConfirmations
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
