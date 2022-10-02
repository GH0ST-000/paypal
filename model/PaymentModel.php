<?php

namespace app\model;

use app\core\Application;

class PaymentModel
{


    public function Insert($payment_id,$payer_id,$payer_email,$amount,$currency,$payment_status){
        $result=Application::$app->database->pdo->query("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status) 
        VALUES('". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");
    }


}