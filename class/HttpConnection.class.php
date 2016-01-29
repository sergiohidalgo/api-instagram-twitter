<?php

class HttpConnection {
    private $curl;
    private $cookie;
    private $cookie_path="/cookies";
    private $id;
    public $login;
    public function __construct() {
        $this->id = time();
    }
    public function init($cookie=null) {
        if($cookie)
            $this->cookie = $cookie;
        else
            $this->cookie = $this->cookie_path . $this->id;
        $this->curl=curl_init();
        curl_setopt($this->curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1");
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        curl_setopt($this->curl, CURLOPT_COOKIEFILE,$this->cookie);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en"));
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, TRUE);
    }
    public function setCookiePath($path){
        $this->cookie_path = $path;
    }
    public function get($url,$follow=false) {
        $this->init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST,false);
        curl_setopt($this->curl, CURLOPT_HEADER, $follow);
        curl_setopt($this->curl, CURLOPT_REFERER, '');
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, $follow);

        $result=curl_exec ($this->curl);
        if($result === false){
            echo curl_error($this->curl);
        }
        $this->_close();
        return $result;
    }
    public function getBinary($url){
        $this->init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_BINARYTRANSFER,1);
        $result = curl_exec ($this->curl);
        $this->_close();
        return $result;
    }
    private function _close() {
        curl_close($this->curl);
    }
    public function close(){
        if(file_exists($this->cookie))
            unlink($this->cookie);
    }
}