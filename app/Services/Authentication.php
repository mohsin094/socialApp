<?php
namespace App\Services;
use Firebase\JWT\JWT;
class Authentication
{
    protected $token;
    public function __construct($userDate){
        try{
            $data = [
                "id"=>(string)$userDate['_id'],
                "name"=>$userDate['name'],
                "email"=>$userDate['email'],
                "password"=>$userDate['password']
                ];

            $key = "owt125";
            $payload = array(
                "iss" => "http://localhost.com",
                "aud" => "http://localhost.com",
                "iat" => time(),
                "nbf" => time(),
                "data"=> $data
            );
                $this->token =  JWT::encode($payload, $key, 'HS256');
        }
        catch(\Exception $e){
            return response()->error($e->getMessage(),400);
        }
    }

    public function getToken(){
        return $this->token;
    }

}
