<?php
namespace Framework;
abstract class Controller
{
    const ADMIN_LAYOUT = 'admin_layout.phtml';
    const DEFAULT_LAYOUT = 'layout.phtml';
    protected $layout = self::DEFAULT_LAYOUT;


    public function setLayout(Request $request)
    {
        $uri = $_SERVER['REQUEST_URI'];

        //echo $uri;
        if (strpos($uri, 'admin') == true) {
            $this->layout = self::ADMIN_LAYOUT;

        }
    }
}