<?php
class Api extends Rest{
    public $dbConn;

    public function __construct(){
parent::__construct();

    }
public function generateToken(){
          $email=$this->validateParameter('email',$this->param['email'],STRING);
          $pass=$this->validateParameter('pass',$this->param['pass'],STRING);
            try{
          $stmt =$this->dbConn->prepare("SELECT * FROM users WHERE email=
          :email AND password=:pass");

          $stmt->bindParam(":email",$email);
          $stmt->bindParam(":pass",$pass);
          $stmt->execute();
          $user=$stmt->fetch(PDO::FETCH_ASSOC);
          print_r($user);
          if(!is_array($user)){
             
              $this->returnResponse(INVALID_USER_PASS,"Email or Password is incorrect");
          }
          if($user['active']==0){
              $this->returnResponse(USER_NOT_ACTIVE,"user is not activated,please contact to admin");
          }
          $payload=[
              'iat'=>time(),
              'iss'=>'localhost',
              'exp'=>time()+(15*60),
              'userId'=>$user['id']
          ];
         
          $token=jwt::encode($payload,SECRET_KEY);
         $this->returnResponse(SUCCESS_RESPONSE,$token);
        }
        catch(Exception $e){
            $this->throwError(JWT_PROCESSING_ERROR,$e->getMessage());
        }
}
public function validateToken(){
    try{
        $token=$this->getBearerToken();
        $payload=JWT::decode($token,SECRET_KEY,['HS256'] );
        $stmt =$this->dbConn->prepare("SELECT * FROM users WHERE id=
        :userId");

        $stmt->bindParam(":userId",$payload->userId);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_ASSOC);
        if(!is_array($user)){
           
            $this->returnResponse(INVALID_USER_PASS,"user not found");
        }
        if($user['active']==0){
            $this->returnResponse(USER_NOT_ACTIVE,"user is not activated,please contact to admin");
        }
    }catch(Exception $e){
        $this->throwError(ACCESS_TOKEN_ERRORS,$e->getMessage());

    }
}


public function addCustomer(){
    $name=$this->validateParameter('name',$this->param['name'],STRING,false);
    $email=$this->validateParameter('email',$this->param['email'],STRING,false);
    $addr=$this->validateParameter('addr',$this->param['addr'],STRING,false);
    $mobile=$this->validateParameter('mobile',$this->param['mobile'],STRING,false);

        $cust=new Customer;
        $cust->setName($name);
        $cust->setEmail($email);
        $cust->setAddress($addr);
        $cust->setMobile($mobile);
        $cust->setCreatedBy($payload->userId);
        $cust->setCreatedOn(date('Y-m-d'));

        $booStatus=true;
        if(!$cust->insert()){
$message='Failed to insert.';
$booStatus=false;
        }else{
            $message="Inserted successfully";
        }
        $this->returnResponse(SUCCESS_RESPONSE,$message);
   

}
}
?>