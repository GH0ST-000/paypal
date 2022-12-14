<?php

class m0002_payment
{
    public function up()
    {
        $db=\app\core\Application::$app->database;
        $SQL="CREATE TABLE `payments` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `payment_id` varchar(255) NOT NULL,
         `payer_id` varchar(255) NOT NULL,
         `payer_email` varchar(255) NOT NULL,
         `amount` float(10,2) NOT NULL,
         `currency` varchar(255) NOT NULL,
         `payment_status` varchar(255) NOT NULL,
         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db=\app\core\Application::$app->database;
        $SQL="DROP TABLE payments;";
        $db->pdo->exec($SQL);
    }
}