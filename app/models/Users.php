<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Users extends Model
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
    public $parent_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $salt;

    /**
     *
     * @var integer
     */
    public $profiles_id;

    /**
     *
     * @var string
     */
    public $banned;

    /**
     *
     * @var string
     */
    public $suspended;

    /**
     *
     * @var string
     */
    public $active;

    /**
     *
     * @var string
     */
    public $code;

    /**
     * Before create the user assign values
     */
    public function beforeValidationOnCreate()
    {
        // The account must be confirmed via e-mail
        $this->active = 'N';

        // The account is not suspended by default
        $this->suspended = 'N';

        // The account is not banned by default
        $this->banned = 'N';
    }

    /**
     * Send a confirmation e-mail to the user if the account is not active
     */
    public function afterSave()
    {
        if ($this->active == 'N')
        {
            $emailConfirmation = new EmailConfirmations();
            $emailConfirmation->users_id = $this->id;
            $emailConfirmation->save();
        }

        $coins = new Coins();
        $coins->users_id = $this->id;
        $coins->value = 30;
        $coins->save();
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('profiles_id', __NAMESPACE__ . '\Profiles', 'id', array(
            'alias' => 'profile',
            'reusable' => true
        ));
        $this->hasMany('id', __NAMESPACE__ . '\Ad', 'users_id', array('alias' => 'ad'));
        $this->hasMany('id', __NAMESPACE__ . '\Advertising', 'users_id', array('alias' => 'advertising'));
        $this->hasMany('id', __NAMESPACE__ . '\Coins', 'users_id', array('alias' => 'coins'));
        $this->hasMany('id', __NAMESPACE__ . '\Comments', 'users_id', array('alias' => 'comments'));
        $this->hasMany('id', __NAMESPACE__ . '\EmailConfirmations', 'users_id', array('alias' => 'emailConfirmations'));
        $this->hasMany('id', __NAMESPACE__ . '\FailedLogins', 'users_id', array('alias' => 'failedLogins'));
        $this->hasMany('id', __NAMESPACE__ . '\Gallery', 'users_id', array('alias' => 'gallery'));
        $this->hasMany('id', __NAMESPACE__ . '\Gotm', 'users_id', array('alias' => 'gotm'));
        $this->hasMany('id', __NAMESPACE__ . '\LiveMessages', 'users_id', array('alias' => 'liveMessages'));
        $this->hasMany('id', __NAMESPACE__ . '\Mytours', 'users_id', array('alias' => 'mytours'));
        $this->hasMany('id', __NAMESPACE__ . '\Payments', 'ad_id', array('alias' => 'payments'));
        $this->hasMany('id', __NAMESPACE__ . '\PrivateMessages', 'users_id', array('alias' => 'privateMessages'));
        $this->hasMany('id', __NAMESPACE__ . '\RememberToken', 'users_id', array('alias' => 'rememberToken'));
        $this->hasMany('id', __NAMESPACE__ . '\Replies', 'users_id', array('alias' => 'replies'));
        $this->hasMany('id', __NAMESPACE__ . '\ResetPassword', 'users_id', array('alias' => 'resetPasswords'));
        $this->hasMany('id', __NAMESPACE__ . '\Reviews', 'users_id', array('alias' => 'reviews'));
        $this->hasMany('id', __NAMESPACE__ . '\SuccessLogins', 'users_id', array('alias' => 'successLogins'));
        $this->hasMany('id', __NAMESPACE__ . '\Support', 'users_id', array('alias' => 'support'));
        $this->hasMany('id', __NAMESPACE__ . '\Topten', 'users_id', array('alias' => 'topten'));
        $this->hasMany('id', __NAMESPACE__ . '\Verification', 'users_id', array('alias' => 'verification'));
        $this->hasMany('id', __NAMESPACE__ . '\Video', 'users_id', array('alias' => 'video'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}