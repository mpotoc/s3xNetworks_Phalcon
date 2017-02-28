<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $servername = "localhost";
    $username = "root";
    $password = "admin01";
    $dbname = "escort_adverts";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sig = $_POST['signature'];
    $xml_decode = base64_decode($_POST['data']);

    $fp = fopen('text.txt', 'w');
    fwrite($fp, $xml_decode);
    fclose($fp);

    $arr = json_decode($xml_decode);

    $myarr = explode('|', $arr->{'order_id'});
    $users_id = $myarr[0];
    $ad_id = 1;//$myarr[1];
    $c_date = date("Y-m-d H:i:s", ($arr->{'create_date'} / 1000));
    $e_date = date("Y-m-d H:i:s", ($arr->{'end_date'} / 1000));
    $price = $myarr[2];
    //for testing only, remove after test and change sql1 to $price
    $price2 = 200;

    $sql = "INSERT INTO payments (users_id, packages_id, json, payment_id, status, paytype, acq_id, order_id, liqpay_order_id, ip, create_date, end_date, transaction_id) VALUES (".$users_id.",".$ad_id.",'".$xml_decode."','".$arr->{'payment_id'}."','".$arr->{'status'}."','".$arr->{'paytype'}."','".$arr->{'acq_id'}."','".$arr->{'order_id'}."','".$arr->{'liqpay_order_id'}."','".$arr->{'ip'}."','".$c_date."','".$e_date."','".$arr->{'transaction_id'}."')";
    $conn->query($sql);

    $sql1 = "INSERT INTO revenue r (r.users_id, r.sum) VALUES (".$users_id.", ".$price2.")";
    $conn->query($sql1);

    $sql2 = "SELECT sum(r.sum) as total FROM revenue r WHERE users_id = " . $users_id;
    $data = $conn->query($sql2);
    $total = $data->fetch_all();

    /*$sql3 = "SELECT parent_id FROM users WHERE id = " . $users_id;
    $data1 = $conn->query($sql3);
    $user = $data1->fetch_all();

    $sql4 = "SELECT count(*) as count FROM mlm WHERE users_id = " . $users_id;
    $data2 = $conn->query($sql4);
    $count = $data2->fetch_all();

    if ($total[0]['total'] >= 200 && $count[0]['count'] == 0)
    {
        $sql6 = "INSERT INTO mlm m (m.users_id, m.parent_id, m.level) VALUES (".$users_id.", ".$user[0]['parent_id'].", ".$level.")";
        $conn->query($sql6);

        // send mail to manually add to mlm for now
    }*/

    $conn->close();
}
else
{
    header('Location: index.php');
}

//make global variables to know if payment is successfull or not.

/*
{"action":"pay","payment_id":209270866,"status":"success","version":3,"type":"buy","paytype":"card","public_key":"i15035619760","acq_id":414963,
"order_id":"12|16|150|499375","liqpay_order_id":"G5OFEKDM1468819197794644","description":"150 s3xcoins","sender_card_mask2":"516875*00",
"sender_card_bank":"pb","sender_card_type":"mc","sender_card_country":804,"ip":"146.0.81.72","amount":0.1,"currency":"EUR","sender_commission":0.0,
"receiver_commission":0.0,"agent_commission":0.0,"amount_debit":2.75,"amount_credit":2.75,"commission_debit":0.0,"commission_credit":0.08,
"currency_debit":"UAH","currency_credit":"UAH","sender_bonus":0.0,"amount_bonus":0.0,"authcode_debit":"455004","authcode_credit":"004447",
"rrn_debit":"000420165181","rrn_credit":"000420165185","mpi_eci":"5","is_3ds":true,"create_date":1468819201988,"end_date":1468819201988,
"transaction_id":209270866}

SELECT * FROM `mlm` GROUP BY level

SELECT count(level) FROM `mlm` WHERE level = 1;

SELECT count(level) FROM `mlm` WHERE level = 2;

SELECT count(level) FROM `mlm` WHERE level = 3;

SELECT count(level) FROM `mlm` WHERE level = 4;

SELECT count(level) FROM `mlm` WHERE level = 5;



*/