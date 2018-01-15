<?php
namespace Controller;
use Framework\Request;
use Framework\Router;
use Model\Repository;

class AdmindefaultController{

    public function policyAction()
    {
        session_start();
        if (!empty($_SESSION['admin'])) {
            ob_start();
            $a = Repository::lc();
            $news = Repository::findAllnews();

            require VIEW_DIR . 'Default/admin_view.phtml';
            $content = ob_get_clean();

            return $content;
        }
        else $content="Please login";
        return $content;
    }
    public function bisnessAction(Request $request){
        session_start();
        if (!empty($_SESSION['admin'])) {
            ob_start();
            $news = Repository::findAllcomment();

            require VIEW_DIR . 'Default/admin_coment.phtml';
            $content = ob_get_clean();

            return $content;
        }
        else $content="Please login";
        return $content;
    }
    public function scienceAction(Request $request){
        session_start();
        if (!empty($_SESSION['admin'])) {
            ob_start();
            $news = Repository::findAllReklama();

            require VIEW_DIR . 'Default/admin_reklama.phtml';
            $content = ob_get_clean();

            return $content;
        }
        else $content="Please login";
        return $content;
    }
    public function addAction(Request $request){

            $id=$request->post('id');
            $name= $request->post('name');
            $content= $request->post('content');
            $created=$request->post('created');
            $picture=$request->post('picture');
            $tag=$request->post('tag');
            $visit=$request->post('visit');
            $table_name=$request->post('table_name');



        Repository::save($table_name,$id, $name, $content, $created, $picture, $tag, $visit);
       Router::redirect("../admin/index.php?controller=admindefault&action=policy");
    }
    public function deleteAction(Request $request){
        $form=$request->post('id');
        ob_start();
        Repository::delete($form);
        $news=Repository::findAllnews();
        require   VIEW_DIR.'Default/admin_view.phtml';
        $content= ob_get_clean();
        return $content;
    }
    public function addComAction(Request $request){

        $id=$request->post('id');
        $name= $request->post('table_name');
        $content= $request->post('news_id');
        $created=$request->post('user_name');
        $picture=$request->post('comments');
        $tag=$request->post('like_n');
        $visit=$request->post('status');



ob_start();
        Repository::saveCom($id, $name, $content, $created, $picture, $tag, $visit);
        $news=Repository::findAllcomment();
       /* Router::redirect("../webroot/admin/index.php?controller=admindefault&action=bisness");*/
        require VIEW_DIR . 'Default/admin_coment.phtml';
        $content= ob_get_clean();

        return $content;
    }
    public function deleteComAction(Request $request){
        $form=$request->post('id');
        ob_start();
        Repository::deleteCom($form);
        $news=Repository::findAllnews();
        require   VIEW_DIR.'Default/admin_view.phtml';
        $content= ob_get_clean();
        return $content;
    }

    public function addReklAction(Request $request){
        $id=$request->post('id');
        $name= $request->post('name');
        $content= $request->post('name_firm');
        $created=$request->post('price');
        $picture=$request->post('date');

        Repository::saveRekl($id, $name, $content, $created, $picture);
        Router::redirect("../admin/index.php?controller=admindefault&action=science");
    }
    public function deleteReklAction(Request $request){
        $form=$request->post('id');
        ob_start();
        Repository::deleteRekl($form);
        $news=Repository::findAllReklama();
        require   VIEW_DIR.'Default/admin_reklama.phtml';
        $content= ob_get_clean();
        return $content;
    }
public function colorAction(Request $request){
        $color=$request->post('color');

        ob_start();
       $color= Repository::color($color);
    require VIEW_DIR . 'Default/admin_view.phtml';
    $content= ob_get_clean();

    return $content;
}
    public function chekinAction(Request $request){
        ob_start();
        session_start();
        if($_SESSION['admin']=='admin'){
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
    public function checkoutAction(){
        session_start();
        $_SESSION['user']=null;
        require VIEW_DIR . 'Default/chekin.phtml';
        // Session::setFlash("CheckIn");

        $content = ob_get_clean();
        return $content;
    }
}

?>