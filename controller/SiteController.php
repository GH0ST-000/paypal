<?php
namespace app\controller;
use http\Url;
use Omnipay\Omnipay;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\model\PaymentModel;
use app\model\RegisterModel;
use Exception;


class SiteController extends Controller
{

    public function show(){
        $controller=new RegisterModel();
        $users=$controller->GetUser();

        foreach ($users as $user){
            echo  '
                <table class="table align-middle mb-0 bg-white mx-auto mt-5 pb-5 pt-4" style="width: 1200px">
                    <thead class="bg-light">
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th class="ms-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span>'.$user['name'].'</span>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">'.$user['email'].'</p>
                        </td>
                        <td>
                            <p>'.$user['amount'].'</p>
                        </td>
                        <td class="">
                    <a href="'.$user['email'].'"  onclick="Payment(this)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            charge
                        </a>
                        </td>
                    </tr>
               
                    </tbody>
                </table>
                
            
            ';
        }

        return $this->renders('users');


    }

    public static function handleRequest(Request $request){
       if ($request->isPost()){
           $register = new RegisterModel();
           $body = $request->getBody();
           $firstname=$body['username'];
           $email=$body['email'];
           $amount=$body['amount'];
           $register->SaveUser($firstname,$email,$amount);
       }

    }

    public function ChargeUser(Request $request){
        define('PAYPAL_RETURN_URL', ''.Application::$BASE_URL.'success');
        define('PAYPAL_CANCEL_URL', ''.Application::$BASE_URL.'cancel');
        define('PAYPAL_CURRENCY', 'USD');

        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(Application::$CLIENT_ID);
        $gateway->setSecret(Application::$CLIENT_SECRET);
        $gateway->setTestMode(true);

        if ($request->isPost()){
            $body = $request->getBody();
            try {
                $response = $gateway->purchase(array(
                    'amount' => $body['amount'],
                    'currency' => PAYPAL_CURRENCY,
                    'returnUrl' => PAYPAL_RETURN_URL,
                    'cancelUrl' => PAYPAL_CANCEL_URL,
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect();
                } else {
                    echo $response->getMessage();
                }
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function success(){
        define('PAYPAL_RETURN_URL', ''.Application::$BASE_URL.'success');
        define('PAYPAL_CANCEL_URL', ''.Application::$BASE_URL.'cancel');
        define('PAYPAL_CURRENCY', 'USD');

        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(Application::$CLIENT_ID);
        $gateway->setSecret(Application::$CLIENT_SECRET);
        $gateway->setTestMode(true);
        $payment=new PaymentModel();
        if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
            $transaction = $gateway->completePurchase(array(
                'payer_id'             => $_GET['PayerID'],
                'transactionReference' => $_GET['paymentId'],
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr_body = $response->getData();

                $payment_id = $arr_body['id'];
                $payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payer_email = $arr_body['payer']['payer_info']['email'];
                $amount = $arr_body['transactions'][0]['amount']['total'];
                $currency = PAYPAL_CURRENCY;
                $payment_status = $arr_body['state'];
                $db_response = $payment->Insert($payment_id,$payer_id,$payer_email,$amount,$currency,$payment_status);
                header('Location:transactions');

            } else {
                echo $response->getMessage();
            }
        } else {
            echo 'Transaction is declined';
        }
    }

    public function cancel(){
        echo '	<h3>User cancelled the payment.</h3>';
    }

    public function transactions(){
        $controller=new RegisterModel();
        $payments=$controller->GetTransactions();
        foreach ($payments as $payment){
            echo  '
                <table class="table align-middle mb-0 bg-white mx-auto mt-5 pb-5 pt-4" style="width: 1200px">
                    <thead class="bg-light">
                    <tr>
                        <th>Payment ID</th>
                        <th>Payer ID</th>
                        <th>Payer Email</th>
                        <th>Amount</th>
                        <th class="ms-2">Currency</th>
                        <th class="ms-2">payment_status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span>'.$payment['payment_id'].'</span>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">'.$payment['payer_id'].'</p>
                        </td>
                        <td>
                            <p>'.$payment['payer_email'].'</p>
                        </td>
                         <td>
                            <p>'.$payment['amount'].'</p>
                        </td>
                         <td>
                            <p>'.$payment['currency'].'</p>
                        </td>
                        <td>
                            <p class="text-success">'.$payment['payment_status'].'</p>
                        </td>
                    </tr>
               
                    </tbody>
                </table>
                
            
            ';
        }
        return $this->renders('transactions');

    }

}