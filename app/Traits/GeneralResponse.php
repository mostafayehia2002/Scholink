<?php

namespace App\Traits;

trait GeneralResponse
{

    public function error($statusCode,$error)
    {
        return response()->json([
            'IsSuccess' => false,
            'Status'=>$statusCode,
            'Error' =>$error,

        ],$statusCode);
    }
    public function errorMessage($statusCode,$error)
    {
        return response()->json([
            'IsSuccess' => false,
            'Status'=>$statusCode,
            'Error' =>[
                'message'=>$error,
                ]

        ],$statusCode);
    }
    public function successMessage($statusCode,$message='')
    {
        return response()->json( [
            'IsSuccess' => true,
            'Status'=>$statusCode,
            'Message'=>$message
        ],$statusCode);
    }

    public function data($statusCode, $key, $value)
    {
        return response()->json([
            'IsSuccess' => true,
            'Status'=>$statusCode,
             $key => $value
        ],$statusCode);
    }

}

