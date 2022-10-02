<?php

class  m0001_initial{

    public function up()
    {
       $db=\app\core\Application::$app->database;
       $SQL="CREATE TABLE users(
          id INT AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(255) NOT NULL ,
          email VARCHAR(255) NOT NULL,
          amount VARCHAR(255) NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
            )ENGINE=INNODB;";
       $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db=\app\core\Application::$app->database;
        $SQL="DROP TABLE users;";
        $db->pdo->exec($SQL);
    }

}