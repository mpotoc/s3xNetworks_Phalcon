<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Likes extends Model
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
    public $ad_id;

    /**
     *
     * @var integer
     */
    public $like;

    /**
     *
     * @var integer
     */
    public $dislike;

    /**
     *
     * @var string
     */
    public $ip;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('ad_id', __NAMESPACE__ . '\Ad', 'id', array('alias' => 'ad'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'likes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Likes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Likes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}