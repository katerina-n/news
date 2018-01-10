<?php
namespace Model;
use Framework\Request;
use Model\Entity\Answer_comment;
use Model\Entity\Bisness;
use Model\Entity\Comment;
use Model\Entity\Nature;
use Model\Entity\Policy;
use Model\Entity\Reklama;
use Model\Entity\Science;

class Repository
{

    public static function findLast()
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT *FROM `policy` order by id desc limit 5";

        $std = $pdo->prepare($sql);
        $std->execute();

        $sql2 = "SELECT *FROM `bisness` order by id desc limit 5";
        $std2 = $pdo->prepare($sql2);
        $std2->execute();

        $sql3 = "SELECT *FROM `science` order by id desc limit 5";
        $std3 = $pdo->prepare($sql3);
        $std3->execute();

        $sql1 = "SELECT *FROM `nature` order by id desc limit 5";
        $std1 = $pdo->prepare($sql1);
        $std1->execute();


        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $result1 = $std1->fetchAll(\PDO::FETCH_ASSOC);
        $result2 = $std2->fetchAll(\PDO::FETCH_ASSOC);
        $result3 = $std3->fetchAll(\PDO::FETCH_ASSOC);
        for ($i = 0; $i <= count($result) - 1; $i++) {

            $policy = (new Policy())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);

            $collections[] = $policy;
        }
        for ($i = 0; $i <= count($result2) - 1; $i++) {

            $policy = (new Bisness())->setId($result2[$i]['id'])
                ->setName($result2[$i]['name'])
                ->setContent($result2[$i]['content'])
                ->setCreated($result2[$i]['created'])
                ->setPicture($result2[$i]['picture'])
                ->setTag($result2[$i]['tag'])
                ->setVisit($result2[$i]['visit']);

            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result3) - 1; $i++) {

            $policy = (new Science())->setId($result3[$i]['id'])
                ->setName($result3[$i]['name'])
                ->setContent($result3[$i]['content'])
                ->setCreated($result3[$i]['created'])
                ->setPicture($result3[$i]['picture'])
                ->setTag($result3[$i]['tag'])
                ->setVisit($result3[$i]['visit']);

            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result1) - 1; $i++) {

            $policy = (new Nature())->setId($result1[$i]['id'])
                ->setName($result1[$i]['name'])
                ->setContent($result1[$i]['content'])
                ->setCreated($result1[$i]['created'])
                ->setPicture($result1[$i]['picture'])
                ->setTag($result1[$i]['tag'])
                ->setVisit($result1[$i]['visit']);

            $collections[] = $policy;
        }

        return $collections;

    }

    public static function findAll($tableName)
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT *FROM `{$tableName}`";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $object = ucfirst($tableName);
        $GLOBALS['total'] = ceil(count($result) / 5);

        for ($i = 0; $i <= count($result) - 1; $i++) {

            $object = 'Model\\Entity\\' . ucfirst($tableName);

            $policy = (new $object())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);
            $collections[] = $policy;


        }

        return $collections;

    }

    public static function findLimit($tableName)
    {
        $array = self::findAll($tableName);
        $c = count($array);
        $GLOBALS['total'] = ceil("$c" / 5);
        global $pdo;
        $collections = [];
        if (!isset($_GET['idd'])) {
            $_GET['idd'] = 1;
        }
        $number = $_GET['idd'];
        $ot = 0 + ($number - 1) * 5;
        $do = 5;
        $sql = "SELECT *FROM `{$tableName}` LIMIT {$ot}, {$do} ";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $object = ucfirst($tableName);
        for ($i = 0; $i <= count($result) - 1; $i++) {

            $object = 'Model\\Entity\\' . ucfirst($tableName);

            $policy = (new $object())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);
            $collections[] = $policy;


        }

        return $collections;
    }

    public static function id()
    {

        $arr = Repository::findLast();
        $array = [];
        for ($i = 0; $i <= 8; $i = $i + 2) {
            $num = rand(0, count($arr) - 1);
            $array[$i] = $arr[$num]->getName();
            $array[$i + 1] = $arr[$num]->getPicture();

        }


        $json = json_encode($array);
        echo $json;
    }

    public static function formTags()
    {

    }

    public static function findById($tableName, $id)
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT *FROM `{$tableName}` Where id= '{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        $object = ucfirst($tableName);
        $object = 'Model\\Entity\\' . ucfirst($tableName);
        $policy = (new $object())->setId($result[0]['id'])
            ->setName($result[0]['name'])
            ->setContent($result[0]['content'])
            ->setCreated($result[0]['created'])
            ->setPicture($result[0]['picture'])
            ->setTag($result[0]['tag'])
            ->setVisit($result[0]['visit']);
        $collections[] = $policy;
        return $collections;
    }

    public static function visit($tableName, $id)
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT visit FROM `{$tableName}` Where id= '{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        $policy = $result[0]['visit'];

        $collections[] = $policy;
        return $collections;
    }

    public static function addvisit($tableName, $id, $value)
    {
        global $pdo;
        $collections = [];
//die("Update `{$tableName}` set `visit`= $value where `id` = '{$id}'");
        $sql = "Update `{$tableName}` set `visit`= $value where `id` = '{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
    }

    public static function findbyTag($tag)
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT *FROM `policy` where tag like '%{$tag}%'";

        $std = $pdo->prepare($sql);
        $std->execute();

        $sql2 = "SELECT *FROM `bisness` where tag like '%{$tag}%'";
        $std2 = $pdo->prepare($sql2);
        $std2->execute();

        $sql3 = "SELECT *FROM `science` where tag like '%{$tag}%'";
        $std3 = $pdo->prepare($sql3);
        $std3->execute();

        $sql1 = "SELECT *FROM `nature` where tag like '%{$tag}%'";
        $std1 = $pdo->prepare($sql1);
        $std1->execute();


        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $result1 = $std1->fetchAll(\PDO::FETCH_ASSOC);
        $result2 = $std2->fetchAll(\PDO::FETCH_ASSOC);
        $result3 = $std3->fetchAll(\PDO::FETCH_ASSOC);
        for ($i = 0; $i <= count($result) - 1; $i++) {

            $policy = (new Policy())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);

            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result2) - 1; $i++) {

            $policy = (new Bisness())->setId($result2[$i]['id'])
                ->setName($result2[$i]['name'])
                ->setContent($result2[$i]['content'])
                ->setCreated($result2[$i]['created'])
                ->setPicture($result2[$i]['picture'])
                ->setTag($result2[$i]['tag'])
                ->setVisit($result2[$i]['visit']);

            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result3) - 1; $i++) {

            $policy = (new Science())->setId($result3[$i]['id'])
                ->setName($result3[$i]['name'])
                ->setContent($result3[$i]['content'])
                ->setCreated($result3[$i]['created'])
                ->setPicture($result3[$i]['picture'])
                ->setTag($result3[$i]['tag'])
                ->setVisit($result3[$i]['visit']);

            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result1) - 1; $i++) {

            $policy = (new Nature())->setId($result1[$i]['id'])
                ->setName($result1[$i]['name'])
                ->setContent($result1[$i]['content'])
                ->setCreated($result1[$i]['created'])
                ->setPicture($result1[$i]['picture'])
                ->setTag($result1[$i]['tag'])
                ->setVisit($result1[$i]['visit']);

            $collections[] = $policy;
        }
        $c = count($collections);
        $GLOBALS['total'] = ceil("$c" / 5);

        return $collections;


    }

    public static function checked($email, $password)
    {
        global $pdo;
        $collections = [];
        if (($email == 'admin@admin') && ($password = '123')) {
            $res = 'admin';
        } else {
            $sql = "SELECT email, password FROM `user` WHERE email= '{$email}' AND password= '{$password}'";
            $std = $pdo->prepare($sql);
            $std->execute();
            $result = $std->fetchAll(\PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                //  $array['user']=true;
                // return true;
                $res = 'user';
            }
        }
        return $res;
    }

    public static function findcomment($table_name, $news_id)
    {
        global $pdo;
        $collections = [];
        if ($table_name == 'policy') {

            $sql = "SELECT * FROM `comment` WHERE table_name= '{$table_name}' AND news_id= '{$news_id}' AND status = '1' order by like_n desc ";
        } else {
            $sql = "SELECT * FROM `comment` WHERE table_name= '{$table_name}' AND news_id= '{$news_id}' order by like_n desc";
        }
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        for ($i = 0; $i <= count($result) - 1; $i++) {
            $tests = (new Comment())->setId($result[$i]['id'])
                ->setTableName($result[$i]['table_name'])
                ->setNewsId($result[$i]['news_id'])
                ->setUserName($result[$i]['user_name'])
                ->setComments($result[$i]['comments'])
                ->setLikeN($result[$i]['like_n']);

            $collections[] = $tests;
        }

        return $collections;
    }

    public static function savecomment($table_name, $news_id, $user_name, $comments)
    {
        global $pdo;
        $collections = [];
        // die("INSERT into `comment` VALUES( ,'{$table_name}', '{$news_id}', '{$user_name}', '{$comments}', 0)");
        $sql = "INSERT into `comment` VALUES( '','{$table_name}', {$news_id}, '{$user_name}', '{$comments}', 0, 0)";
        $std = $pdo->prepare($sql);
        $std->execute();
        $sql = "SELECT * FROM `comment` WHERE table_name= '{$table_name}' AND news_id= '{$news_id}'";

        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        for ($i = 0; $i <= count($result) - 1; $i++) {
            $tests = (new Comment())->setId($result[$i]['id'])
                ->setTableName($result[$i]['table_name'])
                ->setNewsId($result[$i]['news_id'])
                ->setUserName($result[$i]['user_name'])
                ->setComments($result[$i]['comments'])
                ->setLikeN($result[$i]['like_n']);

            $collections[] = $tests;
        }

        return $collections;
    }

    public static function likeplus($id)
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT like_n FROM `comment` WHERE id='{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $a = $result[0]['like_n'];
        $a++;
        $sql = "Update `comment` set `like_n`= {$a} where `id` = '{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
    }

    public static function likeminus($id)
    {
        global $pdo;
        $collections = [];
        $sql = "SELECT like_n FROM `comment` WHERE id='{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $a = $result[0]['like_n'];
        $a--;
        $sql = "Update `comment` set `like_n`= {$a} where `id` = '{$id}'";
        $std = $pdo->prepare($sql);
        $std->execute();
    }

    public static function commenttop()
    {
        global $pdo;
        $collections = [];
        // $sql="SELECT * FROM `comment` order by like_n  desc  limit 5 ";
        $sql = "SELECT id, user_name , sum(like_n) FROM `comment` group by user_name";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        // die(var_dump($result));

        for ($i = 0; $i <= count($result) - 1; $i++) {
            $tests = (new Comment())->setId($result[$i]['id'])
                ->setTableName($result[$i]['table_name'])
                ->setNewsId($result[$i]['news_id'])
                ->setUserName($result[$i]['user_name'])
                ->setComments($result[$i]['comments'])
                ->setLikeN($result[$i]['sum(like_n)']);

            $collections[] = $tests;
        }
        //  die(var_dump($collections));

        return $collections;
    }

    public static function showtopcomment($table_name)
    {
        global $pdo;
        $collections = [];
        //die("SELECT 'comments' FROM `comment` WHERE 'user_name' = '{$user_name}' ");
        $sql = "SELECT id, table_name , sum(like_n) FROM `comment`  group by news_id limit 3";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        // die(var_dump($result));

        for ($i = 0; $i <= count($result) - 1; $i++) {
            $tests = (new Comment())->setId($result[$i]['id'])
                ->setTableName($result[$i]['table_name'])
                ->setNewsId($result[$i]['news_id'])
                ->setUserName($result[$i]['user_name'])
                ->setComments($result[$i]['comments'])
                ->setLikeN($result[$i]['sum(like_n)']);

            $collections[] = $tests;
        }
        // die(var_dump($collections));

        return $collections;
    }

    public static function addcommenttocomment($user_name, $comment_id, $comments)
    {
        global $pdo;
        $collections = [];
        // die("INSERT into `comment` VALUES( ,'{$table_name}', '{$news_id}', '{$user_name}', '{$comments}', 0)");
        $sql = "INSERT into `answer_comment` VALUES( '','{$user_name}', {$comment_id}, '{$comments}')";
        $std = $pdo->prepare($sql);
        $std->execute();
        $sql = "SELECT * FROM `answer_comment` WHERE comment_id= '{$comment_id}'";

        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        for ($i = 0; $i <= count($result) - 1; $i++) {
            $tests = (new Answer_comment())->setId($result[$i]['id'])
                ->setUserName($result[$i]['user_name'])
                ->setCommentId($result[$i]['comment_id'])
                ->setComments($result[$i]['comments']);


            $collections[] = $tests;
        }

        return $collections;
    }

    public static function findnewbyname($name)
    {
        global $pdo;
        $collections = [];
        $table_name = [];
        $sql = "SELECT *FROM `policy` where name = '{$name}'";

        $std = $pdo->prepare($sql);
        $std->execute();

        $sql2 = "SELECT *FROM `bisness` where name = '{$name}''";
        $std2 = $pdo->prepare($sql2);
        $std2->execute();

        $sql3 = "SELECT *FROM `science` where name = '{$name}'";
        $std3 = $pdo->prepare($sql3);
        $std3->execute();

        $sql1 = "SELECT *FROM `nature` where name = '{$name}'";
        $std1 = $pdo->prepare($sql1);
        $std1->execute();


        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $result1 = $std1->fetchAll(\PDO::FETCH_ASSOC);
        $result2 = $std2->fetchAll(\PDO::FETCH_ASSOC);
        $result3 = $std3->fetchAll(\PDO::FETCH_ASSOC);
        for ($i = 0; $i <= count($result) - 1; $i++) {

            $policy = (new Policy())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);
            $table_name[] = 'policy';
            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result2) - 1; $i++) {

            $policy = (new Bisness())->setId($result2[$i]['id'])
                ->setName($result2[$i]['name'])
                ->setContent($result2[$i]['content'])
                ->setCreated($result2[$i]['created'])
                ->setPicture($result2[$i]['picture'])
                ->setTag($result2[$i]['tag'])
                ->setVisit($result2[$i]['visit']);
            $table_name[] = 'bisness';
            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result3) - 1; $i++) {

            $policy = (new Science())->setId($result3[$i]['id'])
                ->setName($result3[$i]['name'])
                ->setContent($result3[$i]['content'])
                ->setCreated($result3[$i]['created'])
                ->setPicture($result3[$i]['picture'])
                ->setTag($result3[$i]['tag'])
                ->setVisit($result3[$i]['visit']);
            $table_name[] = 'science';
            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result1) - 1; $i++) {

            $policy = (new Nature())->setId($result1[$i]['id'])
                ->setName($result1[$i]['name'])
                ->setContent($result1[$i]['content'])
                ->setCreated($result1[$i]['created'])
                ->setPicture($result1[$i]['picture'])
                ->setTag($result1[$i]['tag'])
                ->setVisit($result1[$i]['visit']);
            $table_name[] = 'nature';
            $collections[] = $policy;
        }
        $c = count($collections);
        $GLOBALS['total'] = ceil("$c" / 5);
        $_GET['table_name'] = $table_name;
        return $collections;


    }

    public static function findbycretery($table_name, $time)
    {
        global $pdo;
        $collections = [];
        if (empty($table_name)) {
            $_GET['act'] = "all";
            $collections = self::findLast();
            return $collections;
        }
        if ($time == 'month') {
            $sql = "SELECT *FROM `{$table_name}` where created >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH );";
        }
        if ($time == 'week') {
            $sql = "SELECT *FROM `{$table_name}` where created >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY );"; //YEAR('created')=YEAR(NOW()) and WEEK('created',1)=WEEK(NOW(),1);";
        }
        if ($time == 'today') {
            $sql = "SELECT *FROM `{$table_name}` where created >= CURDATE();";
        }
        if (empty($time)) {
            $sql = "SELECT *FROM `{$table_name}`;";
        }
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $object = ucfirst($table_name);
        $GLOBALS['total'] = ceil(count($result) / 5);

        for ($i = 0; $i <= count($result) - 1; $i++) {

            $object = 'Model\\Entity\\' . ucfirst($table_name);

            $policy = (new $object())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);
            $collections[] = $policy;


        }
        $c = count($collections);
        $GLOBALS['total'] = ceil("$c" / 5);
//die(var_dump($collections));
        return $collections;
    }

    public static function findreklama()
    {
        global $pdo;
        $collections = [];

        $sql = "SELECT * FROM reklama  order by date desc";
        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);


        for ($i = 0; $i <= count($result) - 1; $i++) {
            $collections[$i][0] = $result[$i]['name'];
            $collections[$i][1] = $result[$i]['name_firm'];
            $collections[$i][2] = $result[$i]['price'];


        }
        $json = json_encode($collections);
        echo $json;
    }


    public static function findAllnews()
    {
        global $pdo;
        $collections = [];
        $table_name = [];
        $sql = "SELECT *FROM `policy`";

        $std = $pdo->prepare($sql);
        $std->execute();

        $sql2 = "SELECT *FROM `bisness`";
        $std2 = $pdo->prepare($sql2);
        $std2->execute();

        $sql3 = "SELECT *FROM `science`";
        $std3 = $pdo->prepare($sql3);
        $std3->execute();

        $sql1 = "SELECT *FROM `nature`";
        $std1 = $pdo->prepare($sql1);
        $std1->execute();


        $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        $result1 = $std1->fetchAll(\PDO::FETCH_ASSOC);
        $result2 = $std2->fetchAll(\PDO::FETCH_ASSOC);
        $result3 = $std3->fetchAll(\PDO::FETCH_ASSOC);
        for ($i = 0; $i <= count($result) - 1; $i++) {

            $policy = (new Policy())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setContent($result[$i]['content'])
                ->setCreated($result[$i]['created'])
                ->setPicture($result[$i]['picture'])
                ->setTag($result[$i]['tag'])
                ->setVisit($result[$i]['visit']);
            $table_name[] = 'policy';
            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result2) - 1; $i++) {

            $policy = (new Bisness())->setId($result2[$i]['id'])
                ->setName($result2[$i]['name'])
                ->setContent($result2[$i]['content'])
                ->setCreated($result2[$i]['created'])
                ->setPicture($result2[$i]['picture'])
                ->setTag($result2[$i]['tag'])
                ->setVisit($result2[$i]['visit']);
            $table_name[] = 'bisness';
            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result3) - 1; $i++) {

            $policy = (new Science())->setId($result3[$i]['id'])
                ->setName($result3[$i]['name'])
                ->setContent($result3[$i]['content'])
                ->setCreated($result3[$i]['created'])
                ->setPicture($result3[$i]['picture'])
                ->setTag($result3[$i]['tag'])
                ->setVisit($result3[$i]['visit']);
            $table_name[] = 'science';
            $collections[] = $policy;
        }

        for ($i = 0; $i <= count($result1) - 1; $i++) {

            $policy = (new Nature())->setId($result1[$i]['id'])
                ->setName($result1[$i]['name'])
                ->setContent($result1[$i]['content'])
                ->setCreated($result1[$i]['created'])
                ->setPicture($result1[$i]['picture'])
                ->setTag($result1[$i]['tag'])
                ->setVisit($result1[$i]['visit']);
            $table_name[] = 'nature';
            $collections[] = $policy;
        }
        $c = count($collections);

        $_GET['table_name'] = $table_name;
        return $collections;

    }


    public static function save($table_name, $id, $name, $content, $created, $picture, $tag, $visit)
    {
        global $pdo;

        if ($id == null) {
            $sql = "INSERT INTO `{$table_name}`(name, content, created, picture, tag, visit) VALUES ('{$name}' , '{$content}', '{$created}', '{$picture}', '{$tag}', '{$visit}')";
            $std = $pdo->prepare($sql);
            // $std=$pdo->query($sql);
            $std->execute();
        } else
            if ($id != null) {
                $i = $id;

                $sql = "UPDATE `{$table_name}` SET name= '{$name}', content= '{$content}', created= '{$created}', picture= '{$picture}', tag= '{$tag}', visit= '{$visit}' WHERE id='{$i}'";
                $std = $pdo->prepare($sql);
                // $std=$pdo->query($sql);
                $std->execute();


            }
    }


    public static function delete($table_name, $id)
    {
        global $pdo;
        $sql = "DELETE from `{$table_name}` where id={$id}";
        $std = $pdo->prepare($sql);
        // $std=$pdo->query($sql);
        $std->execute();


    }

    public static function findAllcomment()
    {
        global $pdo;
        $collections = [];

        $sql = "SELECT * FROM `comment`";

        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        for ($i = 0; $i <= count($result) - 1; $i++) {

            $tests = (new Comment())->setId($result[$i]['id'])
                ->setTableName($result[$i]['table_name'])
                ->setNewsId($result[$i]['news_id'])
                ->setUserName($result[$i]['user_name'])
                ->setComments($result[$i]['comments'])
                ->setLikeN($result[$i]['like_n'])
                ->setStatus($result[$i]['status']);

            $collections[] = $tests;

        }
        return $collections;
    }

    public static function saveCom($id, $name, $content, $created, $picture, $tag, $visit)
    {
        global $pdo;

        $sql = "UPDATE `comment` SET table_name= '{$name}', news_id= '{$content}', user_name= '{$created}', comments= '{$picture}', like_n= '{$tag}', status= '{$visit}' WHERE id='{$id}'";
        $std = $pdo->prepare($sql);
        // $std=$pdo->query($sql);
        $std->execute();
    }

    public static function deleteCom($id)
    {
        global $pdo;
        $sql = "DELETE from `comment` where id={$id}";
        $std = $pdo->prepare($sql);
        // $std=$pdo->query($sql);
        $std->execute();


    }

    public static function findAllReklama()
    {
        global $pdo;
        $collections = [];

        $sql = "SELECT * FROM `reklama`";

        $std = $pdo->prepare($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        for ($i = 0; $i <= count($result) - 1; $i++) {

            $tests = (new Reklama())->setId($result[$i]['id'])
                ->setName($result[$i]['name'])
                ->setNameFirm($result[$i]['name_firm'])
                ->setPrice($result[$i]['price'])
                ->setDate($result[$i]['date']);

            $collections[] = $tests;

        }

        return $collections;
    }

    public static function saveRekl($id, $name, $content, $created, $picture)
    {
        global $pdo;
        if ($id == null) {
            $sql = "INSERT INTO `reklama`(name, name_firm, price, date) VALUES ('{$name}' , '{$content}', '{$created}', '{$picture}')";
            $std = $pdo->prepare($sql);
            // $std=$pdo->query($sql);
            $std->execute();
        } else {

            $sql = "UPDATE `reklama` SET name= '{$name}', name_firm ='{$content}', price= '{$created}', date= '{$picture}' WHERE id='{$id}'";
            $std = $pdo->prepare($sql);
            // $std=$pdo->query($sql);
            $std->execute();
        }
    }

    public static function deleteRekl($id)
    {
        global $pdo;

            $sql = "DELETE from `reklama` where id={$id}";
            $std = $pdo->prepare($sql);
            // $std=$pdo->query($sql);
            $std->execute();

    }
    public static function color($color){
        global $pdo;
        $sql="Insert into `color` values('', '{$color}')";
        $std = $pdo->prepare($sql);
        // $std=$pdo->query($sql);
        $std->execute();



    }
    public static function lastcolor(){
        global $pdo;
        $sql="Select * from `color` order by id desc limit 1";
        $std = $pdo->prepare($sql);
        // $std=$pdo->query($sql);
        $std->execute();
        $result = $std->fetchAll(\PDO::FETCH_ASSOC);

        $color=$result[0]["name"];

        setcookie("sait_colors",$color);

        $json=json_encode($color);
        echo $json;
    }
}