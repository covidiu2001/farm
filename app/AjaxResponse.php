<?php

namespace App;

class AjaxResponse {
    
    public $status = '';
    public $message = '';
    
    public function __construct()
    {
        $this->status = 'error';
    }
    
    function setStatusOK()
    {
        $this->status = 'success';
    }

    function setMessage($message)
    {
        $this->message = $message;
    }
}

