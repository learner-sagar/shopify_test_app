<?php

class App{
    public $store_url;
    public $access_token;


    public function set_url($url){
        $this->store_url = $url;
    }

    public function set_token($token){
        $this->access_token = $token;
    }

    public function get_url(){
        return $this->store_url;
    }

    public function get_token(){
        return $this->access_token;
    }


    public function rest_call($api_endpoint, $query_paramerter = array(), $verb = "GET"){
        $url = "https://".$this->store_url.$api_endpoint;

        if(in_array($method, array('GET', 'DELETE')) && !is_null($method)){
            $url = $url.'?'.http_build_query($query_paramerter);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        $headers[] = "";
        if(!is_null($this->access_token)){
            $headers[] = "X-Shopify-Access-Token:". $this->access_token;
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        if()


    }
}