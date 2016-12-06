<?php
namespace Adverts\Models;

use Phalcon\Mvc\Model;

class Payments extends Model
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
    public $packages_id;

    /**
     *
     * @var string
     */
    public $json;

    /**
     *
     * @var string
     */
    public $payment_id;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var string
     */
    public $paytype;

    /**
     *
     * @var string
     */
    public $acq_id;

    /**
     *
     * @var string
     */
    public $order_id;

    /**
     *
     * @var string
     */
    public $liqpay_order_id;

    /**
     *
     * @var string
     */
    public $ip;

    /**
     *
     * @var string
     */
    public $create_date;

    /**
     *
     * @var string
     */
    public $end_date;

    /**
     *
     * @var string
     */
    public $transaction_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('packages_id', 'Packages', 'id', array('alias' => 'packages'));
        $this->belongsTo('users_id', 'Users', 'id', array('alias' => 'users'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'payments';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Payments[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Payments
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
