<?php
require_once 'Curl.php';

class Post extends Curl
{
    public function __construct($method, $endpoint, $params = [])
    {
        parent::__construct($method, $endpoint, $params);
    }

    public function send()
    {
        $data=$this->execute_api();
        return $data;
    }
}