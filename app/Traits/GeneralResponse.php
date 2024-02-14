<?php

namespace App\Traits;

trait GeneralResponse
{

    public function error($statusCode,$error)
    {
        return response()->json([
            'IsSuccess' => false,
            'Status'=>$statusCode,
            'Error' => $error,

        ]);
    }

    public function successMessage($statusCode,$message='')
    {
        return response()->json( [
            'IsSuccess' => true,
            'Status'=>$statusCode,
            'Message'=>$message
        ]);
    }

    public function data($statusCode, $key, $value)
    {
        return response()->json([
            'IsSuccess' => true,
            'Status'=>$statusCode,
             $key => $value
        ]);
    }

}

