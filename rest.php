<?php 
class Rest {
    public function __construct(){
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

    }
    public function  returnResponse(){

    }
}
?>