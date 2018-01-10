<?php
namespace Controller;
use Framework\Controller;
use Framework\Request;
use Framework\Router;
use Model\Repository;
use Model\Entity\Policy;
use Framework\Session;

class DefaultController extends Controller {
    public function indexAction(){
        ob_start();

$policy=Repository::findLast();
$users=Repository::commenttop();
$subjects=Repository::showtopcomment();


        require VIEW_DIR . 'Default/policy.phtml';


          $content= ob_get_clean();
        return $content;
  /*$content='123';
return $content;*/
    }


    public function policyAction(){
        ob_start();

        $policy=Repository::findLimit('policy');

        require VIEW_DIR . 'Default/poly.phtml';


        $content= ob_get_clean();
        return $content;
    }
    public function bisnessAction(){
        ob_start();

        $policy=Repository::findLimit('bisness');

        require VIEW_DIR . 'Default/poly.phtml';


        $content= ob_get_clean();
        return $content;
    }
    public function scienceAction(){
        ob_start();

        $policy=Repository::findLimit('science');

        require VIEW_DIR . 'Default/poly.phtml';


        $content= ob_get_clean();
        return $content;
    }
    public function natureAction(){
        ob_start();

        $policy=Repository::findLimit('nature');

        require VIEW_DIR . 'Default/poly.phtml';
        $content= ob_get_clean();
        return $content;
    }
    public function butAction(Request $request){

        $name=$_GET['name'];

        ob_start();

        $policy=Repository::findLimit($name);

        require VIEW_DIR . 'Default/newpoly.phtml';
        $content= ob_get_clean();
        return $content;
    }

    public function showAction(Request $request){
        if(!empty($_GET['name'])) {
           $name = $_GET['name'];
       }
       else $name=$_GET['action'];
    $numb=$request->get('id');

        ob_start();
       $json= self::allvisit($name, $numb);

       $comment_view=Repository::findcomment($name, $numb);

        /*if(!isset($_COOKIE['all_read'])) {
            $_COOKIE['all_read']=$read_now;}
           else
               { $_COOKIE['all_read']=$_COOKIE['all_read']+$read_now;
            }
            setcookie('all_read', $_COOKIE['all_read']);*/
      /* $now=$array[0];
       $all=$array[1];
       Repository::addvisit($name, $numb, $all);*/
       // $array[]=$_COOKIE['all_read'];
       /* $json=json_encode($array);*/

        $policy=Repository::findById($name, $numb);
        require VIEW_DIR . 'Default/show.phtml';
        $content= ob_get_clean();
        return $content;

    }
    public static function allvisit($tableName, $number){
        $read_now=rand(1, 5);
        $all_read=Repository::visit($tableName, $number);

        if($all_read[0]==Null){
            $all_read[0]=0;
        }

        $all_read[0]=$all_read[0]+$read_now;

        Repository::addvisit($tableName, $number, "$all_read[0]");
        $array[]=$read_now;
        $array[]=$all_read[0];

        $json=json_encode($array);
        return $json;

    }
    public function findtagAction(Request $request){
        $tag=$request->get('tag');
        if(empty($_GET['idd'])){
            $_GET['idd']=1;
        }
        $name=$_GET['idd'];
        ob_start();

        $array=Repository::findbyTag($tag);
        for($i=0+5*($name-1); $i<=4+5*($name-1); $i++){
            if($i<count($array)){
                $policy[]=$array[$i];
            }


        }
        require VIEW_DIR . 'Default/findtag.phtml';
        $content= ob_get_clean();
        return $content;
    }

    public function buttagAction(){
        if(empty($_GET['idd'])){
            $_GET['idd']=1;
        }
        $name=$_GET['idd'];
        ob_start();
$array=$this->findtagAction();
die(var_dump($array));
for($i=0+5*($name-1); $i<=4+5*($name-1); $i++){
$policy[]=$array[$i];
}
        require VIEW_DIR . 'Default/findtag.phtml';
        $content= ob_get_clean();
        return $content;

    }

    public function findAction(Request $request){

        if(!empty($request->post('tag'))) {

            $form = $request->post('tag');
            ob_start();
            $array = Repository::findbyTag($form);
$_GET['tag']=$form;
            if(empty($_GET['idd'])){
                $_GET['idd']=1;
            }
            $name=$_GET['idd'];

            for($i=0+5*($name-1); $i<=4+5*($name-1); $i++){
                if($i<count($array)){
                    $policy[]=$array[$i];
                }
            }
            require VIEW_DIR . 'Default/findtag.phtml';
            $content= ob_get_clean();
            return $content;
        }

    }
    public function chekinAction(Request $request){
        ob_start();
        session_start();
        if($_SESSION['user']=='user'){
            require VIEW_DIR. 'Default/chekout.phtml';

            $content=ob_get_clean();
            return $content;
        }
        else {
            $_SESSION['flash'] = 'Please login';
            require VIEW_DIR . 'Default/chekin.phtml';

            $content = ob_get_clean();
            return $content;
        }

    }
    public function chekAction(Request $request){
        $email=$request->post('email');
        $password=$request->post('password');
        ob_start();

        $policy=Repository::checked($email, $password);
if($policy=='admin'){
    session_start();
    $_SESSION['admin']='admin';
    Router::redirect('/admin/index.php');
}
if($policy=='user') {
    session_start();
    $_SESSION['flash']='Hello';
    $_SESSION['user']='user';

  require VIEW_DIR . 'Default/chekout.phtml';
  // Session::setFlash("CheckIn");

    $content = ob_get_clean();
    return $content;
}
    }
    public function sendAction(Request $request){
        session_start();
        $table_name = $request->get('name');
        $id = $request->get('id');
        if($_SESSION['user']=='user') {
            ob_start();

            $text = $request->post('comment');
            $comment_view = Repository::savecomment($table_name, $id, 'user', $text);


        }
        Router::redirect("../webroot/index.php?controller=default&action=show&name={$table_name}&id={$id}");

           /* require VIEW_DIR . 'Default/findtag.phtml';
            $content= ob_get_clean();
            return $content;*/


    }
    public function checkoutAction(){
        session_start();
        $_SESSION['user']=null;
        require VIEW_DIR . 'Default/chekin.phtml';
        // Session::setFlash("CheckIn");

        $content = ob_get_clean();
        return $content;
    }

    public function pluslikeAction(Request $request){
        ob_start();
        $id_like=$request->get('idlike');
        $id = $_GET['id'];
        $table_name = $request->get('name');

if($request->post('li')) {
    $policy = Repository::likeplus($id_like);
    Router::redirect("../webroot/index.php?controller=default&action=show&name={$table_name}&id={$id}");

}
        if($request->post('dli')) {
            $policy = Repository::likeminus($id_like);
            Router::redirect("../webroot/index.php?controller=default&action=show&name={$table_name}&id={$id}");

        }
    }
public function showUserAction(Request $request){
        $user_name=$request->get('username');
    ob_start();
$users=Repository::showtopcomment($user_name);

    require VIEW_DIR . 'Default/showuser.phtml';
    $content= ob_get_clean();
    return $content;
}
public function addanswerAction(Request $request){
    session_start();
    $table_name = $request->get('name');
    $id = $request->get('id');
    $comment_id = $request->get('comid');
    if($_SESSION['user']=='user') {
        ob_start();

        $text = $request->post('comment');
        $comment_view = Repository::addcommenttocomment('user', $comment_id, $text);


    }
    Router::redirect("../webroot/index.php?controller=default&action=show&name={$table_name}&id={$id}");
}
public function findoptionAction(Request $request){
    ob_start();


    require VIEW_DIR . 'Default/findoption.phtml';
    $content= ob_get_clean();
    return $content;
}
public function findnewsbynameAction(Request $request){

    $find_new=$request->post('findnew');

    ob_start();
    $policy=Repository::findnewbyname($find_new);
if(count($policy)>0) {
    $a = $_GET['table_name'];


    require VIEW_DIR . 'Default/findnewsbyname.phtml';
    $content = ob_get_clean();
    return $content;
}
else $content="News not found";
return $content;
}
    public function findnewsbycretAction(Request $request){

        $find_data=$request->post('date');
        $subject=$request->post('subj');

        ob_start();
        $policy=Repository::findbycretery($subject[0], $find_data);
        if($_GET['act']=='all'){
            require VIEW_DIR . 'Default/allnews.phtml';


            $content= ob_get_clean();
            return $content;
        }
        if(count($policy)>0) {
            $a = $subject;


            require VIEW_DIR . 'Default/findnewsbyname.phtml';
            $content = ob_get_clean();
            return $content;
        }
        else $content="News not found";
        return $content;
    }


}
?>