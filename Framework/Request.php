<?php
namespace Framework;
class Request{
    private $get=[];
    private $post=[];
    public function __construct($get, $post)
    {
        $this->get=$get;
        $this->post=$post;
    }

    public function get($key, $default=null){
        return isset($this->get[$key])? $this->get[$key]: $default;
    }
    public function post($key, $default=null){
        return isset($this->post[$key])? $this->post[$key]: $default;
    }
}