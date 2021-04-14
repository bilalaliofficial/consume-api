<?php
require_once 'Curl.php';

class Register extends Curl
{
    public function __construct($method, $endpoint, $params = [])
    {
        parent::__construct($method, $endpoint, $params);
    }

    public function submit()
    {
        $data=$this->execute_api();
        echo json_encode($data);
    }
}