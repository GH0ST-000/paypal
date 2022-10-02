<?php
namespace app\model;
use app\core\Application;
use PDO;

class RegisterModel
{
    public string $firstname;
    public string $email;
    public string $amount;

    public function SaveUser($firstname,$email,$amount){
      $result=Application::$app->database->pdo->prepare("INSERT INTO users (name,email,amount) VALUE (
        '$firstname','$email','$amount')");
       if ( $result->execute()){
          header('Location:users');
       }

    }

    public function GetUser(){
       $result = Application::$app->database->pdo->query("SELECT id,name,email,amount  FROM users;");
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function GetTransactions(){
        $result = Application::$app->database->pdo->query("SELECT payment_id,payer_id,payer_email,amount,currency,payment_status  FROM payments;");
        $payments = $result->fetchAll(PDO::FETCH_ASSOC);
        return $payments;
    }

}