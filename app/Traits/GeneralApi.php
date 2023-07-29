<?php

namespace App\Traits;

trait GeneralApi
{
    static public function returnData($status, $msg, $data)
    {

        return response()->json([
            "status" => $status,
            "msg" => $msg,
            "data" => $data
        ]);
    }
}
