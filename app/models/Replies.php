<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Replies extends Model
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
     * @var integer
     */
    public $reviews_id;

    /**
     *
     * @var string
     */
    public $reply;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('ad_id', __NAMESPACE__ . '\Ad', 'id', array('alias' => 'ad'));
        $this->belongsTo('reviews_id', __NAMESPACE__ . '\Reviews', 'id', array('alias' => 'reviews'));
        $this->belongsTo('users_id', __NAMESPACE__ . '\Users', 'id', array('alias' => 'user'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'replies';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Replies[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Replies
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
