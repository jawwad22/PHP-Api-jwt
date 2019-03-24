<?php


class DbConnect
{
   private $server='localhost';
    private $dbname='jwtapi';
    private $user ='root';
    private $pass='';
   public function connect(){
    try {
        $conn=new PDO('mysql:host='.$this->server.';dbname='.$this->
        dbname,$this->user,$this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      return $conn;
        // $db=new DBConnect;
        // $db->connect();
        // echo 'DataBase Connected'
    } catch (Exception $e) {
        echo "Database Error:". $e->getMessage();
    }

}
}

?>