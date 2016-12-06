<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Reviews extends Model
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
     * @var integer
     */
    public $ad_id;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var string
     */
    public $review;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\Replies', 'reviews_id', array('alias' => 'replies'));
        $this->belongsTo('ad_id', __NAMESPACE__ . '\Ad', 'id', array('alias' => 'ad'));
        $this->belongsTo('users_id', __NAMESPACE__ . '\Users', 'id', array('alias' => 'user'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'reviews';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reviews[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reviews
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
