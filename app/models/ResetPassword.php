<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class ResetPassword extends Model
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
    public $password;

    /**
     *
     * @var integer
     */
    public $created;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->created = time();
    }

    /**
     * Send an e-mail to users allowing him/her to reset his/her password
     */
    public function afterCreate()
    {
        $this->getDI()
            ->getMail()
            ->send(array(
                $this->user->email => $this->user->name
            ), "Reset password", 'reset', array(
                'resetPwd' =>  $this->password
            ));
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
        return 'reset_password';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ResetPassword[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ResetPassword
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
