<?php

namespace App\Services;

class MessageSendService
{
    public function __construct()
    {
    }

    public function sendMessage($phone, $message): bool
    {
        if($phone != null && $message != null){
            return true;
        } else {
            return false;
        }
    }


}
