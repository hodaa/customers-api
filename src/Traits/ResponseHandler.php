<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;


trait ResponseHandler{

    /**
     * @param $data
     * @return mixed
     */
    public function success($message){

        return new JsonResponse(["message"=>$message,"status"=>"success"]);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function successWithData($data){

        return new JsonResponse(["data"=>$data,"status"=>'success']);
    }

    /**
     * @return mixed
     */
    public  function fail($message){
        return new JsonResponse(["message"=>$message,"status"=>'Fail']);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public  function  notFound($message){
        $res=new JsonResponse(["message"=>$message,"status"=>"Fail"]);
        return  $res->setStatusCode(404);
    }
}