<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Advertising extends Model
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
    public $packages_id;

    /**
     *
     * @var integer
     */
    public $date;

    /**
     *
     * @var integer
     */
    public $end_date;

    /**
     *
     * @var integer
     */
    public $days;

    /**
     * After save advertising update ad
     */
    public function afterSave()
    {
        $package = $this->packages_id;
        $ad = Ad::findFirstById($this->ad_id);

        if ($package == 8)
        {
            $ad->vip = 'Y';
            $ad->end_vip = $this->end_date;
            $ad->vip_days = $this->days;
        }
        else
        {
            $ad->advertisement = 'Y';
            $ad->ad_date = $this->date;
            $ad->end_date = $this->end_date;
            $ad->ad_days = $this->days;
        }

        $ad->update();
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('packages_id', __NAMESPACE__ . '\Packages', 'id', array('alias' => 'packages'));
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
        return 'advertising';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Advertising[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Advertising
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
