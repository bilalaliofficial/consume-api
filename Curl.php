<?php


class Curl
{
    protected $endpoint='';
    protected $method='';
    protected $params=[];

    public function __construct($method,$endpoint,$params=[])
    {
        $this->endpoint=$endpoint;
        $this->method=$method;
        $this->params=$params;
    }

    public function execute_api()
    {
        $result=null;

        $headers=["Content-type: application/json"];
        $curl=curl_init();

        $options=[
            CURLOPT_TIMEOUT =>  7,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_HTTPHEADER  =>  $headers
        ];

        if ($this->method=='post'){
            $options +=[
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($this->params),
                CURLOPT_URL => $this->endpoint
            ];
        }elseif ($this->method=='get' && !empty($this->params)){
            $options +=[
                CURLOPT_URL => $this->endpoint.'?'.http_build_query($this->params)
            ];
        }
        curl_setopt_array($curl,$options);
        $response=curl_exec($curl);
        $response_info=curl_getinfo($curl);
        curl_close($curl);

        if ($response_info['http_code']==0){
            throw new Exception('Timeout');
        }elseif($response_info['http_code']==200){
            $result=json_decode($response);
        }elseif ($response_info['http_code']==401){
            throw new Exception('Unauthorized request!');
        }elseif ($response_info['http_code']==404){
            $result=null;
        }else{
            throw new Exception('Failed to connect API with response : '.$response_info['http_code']);
        }
        return $result;
    }
}