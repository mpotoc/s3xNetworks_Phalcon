<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Ad extends Model
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
    public $advertisement;

    /**
     *
     * @var integer
     */
    public $ad_date;

    /**
     *
     * @var integer
     */
    public $end_date;

    /**
     *
     * @var integer
     */
    public $ad_days;

    /**
     *
     * @var string
     */
    public $vip;

    /**
     *
     * @var integer
     */
    public $end_vip;

    /**
     *
     * @var integer
     */
    public $vip_days;

    /**
     *
     * @var string
     */
    public $showname;

    /**
     *
     * @var string
     */
    public $slogan;

    /**
     *
     * @var string
     */
    public $gender;

    /**
     *
     * @var integer
     */
    public $age;

    /**
     *
     * @var string
     */
    public $ethnicity;

    /**
     *
     * @var string
     */
    public $nationality;

    /**
     *
     * @var string
     */
    public $home_country;

    /**
     *
     * @var string
     */
    public $hairstyle;

    /**
     *
     * @var string
     */
    public $eyes;

    /**
     *
     * @var string
     */
    public $measurement;

    /**
     *
     * @var string
     */
    public $languages;

    /**
     *
     * @var string
     */
    public $working_time;

    /**
     *
     * @var string
     */
    public $about_me;

    /**
     *
     * @var string
     */
    public $working_country;

    /**
     *
     * @var string
     */
    public $working_city1;

    /**
     *
     * @var string
     */
    public $working_city2;

    /**
     *
     * @var string
     */
    public $working_city3;

    /**
     *
     * @var string
     */
    public $working_city4;

    /**
     *
     * @var integer
     */
    public $price1;

    /**
     *
     * @var integer
     */
    public $price2;

    /**
     *
     * @var integer
     */
    public $price3;

    /**
     *
     * @var integer
     */
    public $price4;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $contact_me;

    /**
     *
     * @var string
     */
    public $no_witheld;

    /**
     *
     * @var string
     */
    public $whatsapp;

    /**
     *
     * @var string
     */
    public $viber;

    /**
     *
     * @var string
     */
    public $line;

    /**
     *
     * @var string
     */
    public $wechat;

    /**
     *
     * @var string
     */
    public $skype;

    /**
     *
     * @var string
     */
    public $website;

    /**
     *
     * @var string
     */
    public $services;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $orientation;

    /**
     *
     * @var string
     */
    public $verified;

    /**
     *
     * @var string
     */
    public $active;

    /**
     *
     * @var string
     */
    public $deleted;

    /**
     *
     * @var string
     */
    public $photos;

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
        $this->advertisement = 'N';
        $this->vip = 'N';
        $this->verified = 'N';
        $this->active = 'N';
        $this->deleted = 'N';
        $this->photos = 'N';
        $this->ad_days = 0;
        $this->vip_days = 0;
        $this->end_vip = '0000-00-00 00:00:00';
        //$this->created = new \DateTime();
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\Advertising', 'ad_id', array('alias' => 'advertising'));
        $this->hasMany('id', __NAMESPACE__ . '\Comments', 'ad_id', array('alias' => 'comments'));
        $this->hasMany('id', __NAMESPACE__ . '\Gallery', 'ad_id', array('alias' => 'gallery'));
        $this->hasMany('id', __NAMESPACE__ . '\Gotm', 'ad_id', array('alias' => 'gotm'));
        $this->hasMany('id', __NAMESPACE__ . '\LiveMessages', 'ad_id', array('alias' => 'liveMessages'));
        $this->hasMany('id', __NAMESPACE__ . '\Mytours', 'ad_id', array('alias' => 'mytours'));
        $this->hasMany('id', __NAMESPACE__ . '\Replies', 'ad_id', array('alias' => 'replies'));
        $this->hasMany('id', __NAMESPACE__ . '\Reviews', 'ad_id', array('alias' => 'reviews'));
        $this->hasMany('id', __NAMESPACE__ . '\Topten', 'ad_id', array('alias' => 'topten'));
        $this->hasMany('id', __NAMESPACE__ . '\Verification', 'ad_id', array('alias' => 'verification'));
        $this->hasMany('id', __NAMESPACE__ . '\Video', 'ad_id', array('alias' => 'video'));
        $this->belongsTo('users_id', __NAMESPACE__ . '\Users', 'id', array('alias' => 'user'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ad';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ad[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ad
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}