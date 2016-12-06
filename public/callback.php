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
    $ad_id = $myarr[1];
    $c_date = date("Y-m-d H:i:s", ($arr->{'create_date'} / 1000));
    $e_date = date("Y-m-d H:i:s", ($arr->{'end_date'} / 1000));
    $price = $myarr[2];

    $sql = "INSERT INTO payments (users_id, packages_id, json, payment_id, status, paytype, acq_id, order_id, liqpay_order_id, ip, create_date, end_date, transaction_id) VALUES (".$users_id.",".$ad_id.",'".$xml_decode."','".$arr->{'payment_id'}."','".$arr->{'status'}."','".$arr->{'paytype'}."','".$arr->{'acq_id'}."','".$arr->{'order_id'}."','".$arr->{'liqpay_order_id'}."','".$arr->{'ip'}."','".$c_date."','".$e_date."','".$arr->{'transaction_id'}."')";
    $conn->query($sql);

    /*$sql1 = "INSERT INTO coins (users_id,value) VALUES (".$users_id.", ".$price.")";
    $conn->query($sql1);*/
    $conn->close();
}
else
{
    header('Location: index.php');
}

//make global variables to know if payment is successfull or not.

/*
{"action":"pay","payment_id":137874163,"status":"sandbox","version":3,"type":"buy","public_key":"i15035619760","acq_id":414963,
"order_id":"20160228153649122431","liqpay_order_id":"S4HQSAN81456670229308751","description":"TEST PAYMENT","sender_card_mask2":"414949*19",
"sender_card_bank":"pb","sender_card_country":804,"ip":"77.38.104.71","amount":1.0,"currency":"EUR","sender_commission":0.0,
"receiver_commission":0.03,"agent_commission":0.0,"amount_debit":30.3,"amount_credit":30.3,"commission_debit":0.0,"commission_credit":0.83,
"currency_debit":"UAH","currency_credit":"UAH","sender_bonus":0.0,"amount_bonus":0.0,"mpi_eci":"7","is_3ds":false,"transaction_id":137874163}
*/