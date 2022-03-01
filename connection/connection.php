<?php

Class Connection {
private  $server = "mysql:host=smarttekmw.com;dbname=smarttek_orderin";
private  $user = "smarttekmw";
private  $pass = "cent2029";
private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    
protected $con;

 
            public function openConnection()
             {
               try
                 {
          $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
                   
          return $this->con;
                  }
               catch (PDOException $e)
                 {
                     echo "There is some problem in connection: " . $e->getMessage();
                 }
             }
public function closeConnection() {
     $this->con = null;
  }
    
public function err()
    {
        $erro = "failed to do operation";
    }
}
?>