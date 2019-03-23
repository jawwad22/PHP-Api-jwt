<?php 
require_once('constants.php');
class Rest {
    public function __construct(){
        if($_SERVER['REQUEST_METHOD']!=='POST'){
            $this->throwError(REQUEST_METHOD_NOT_VALID,
            'Request method is not valid'
        );
        }
$handler=fopen('php://input','r');
echo $request= stream_get_contents($handler);
    }
    public function validateRequest(){

    } 
    public function processApi(){

    }
    public function validateParameter($fieldName,$value,$dataType,$required)
    {
        
    }
    public function throwError($code,$message){
        header("content-type:application/json");
$errorMsg =json_encode(['Http'=>$code,'status'=>'false','message'=>$message]);
echo $errorMsg;exit;
    }
    public function  returnResponse(){

    }
}
?>