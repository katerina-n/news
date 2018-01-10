<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__.DS .'..'.DS);  //'..'.DS
define('VIEW_DIR', ROOT.'View'.DS);
define('CONF_DIR', ROOT.'config'.DS);
spl_autoload_register(function($className){
    $path=ROOT.str_replace('\\', DS, $className).'.php';
    if(!file_exists($path)){
        throw new\Exception("{$path} not found");
    }
    require $path;
});
$db= ['dsn'=>'mysql:host=db3.ho.ua;dbname=films',
    'user'=>'films',
    'password'=>'Gf6NcFld8V'
];
$pdo= new \PDO($db['dsn'], $db['user'], $db['password']);

$request=new \Framework\Request($_GET, $_POST);
//var_dump($request);

$controller=$request->get('controller', 'default');

$action=$request->get('action', 'index');

// var_dump($controller);
$controller='\\Controller\\'.ucfirst($controller).'Controller';

$controller=new $controller();

//$viw=$controller->setLayout($request);
$action=$action.'Action';

$content= $controller->$action($request);

$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, 'admin') == true) {
    require VIEW_DIR."admin_layout.phtml";}
else{
    require VIEW_DIR."layout.phtml";
} //zakomicheno eto
//echo $content;
