<?php
namespace Model\Entity;
class Comment
{
    private $id;
    private $table_name;
    private $news_id;
    private $user_name;
    private $comments;
    private $like_n;
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Comment constructor.
     * @param $id
     * @param $table_name
     * @param $news_id
     * @param $user_name
     * @param $comments
     * @param $like_n
     */
    public function __construct($id, $table_name, $news_id, $user_name, $comments, $like_n)
    {
        $this->id = $id;
        $this->table_name = $table_name;
        $this->news_id = $news_id;
        $this->user_name = $user_name;
        $this->comments = $comments;
        $this->like_n = $like_n;
        $this->status=0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->table_name;
    }

    /**
     * @param mixed $table_name
     */
    public function setTableName($table_name)
    {
        $this->table_name = $table_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewsId()
    {
        return $this->news_id;
    }

    /**
     * @param mixed $news_id
     */
    public function setNewsId($news_id)
    {
        $this->news_id = $news_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLikeN()
    {
        return $this->like_n;
    }

    /**
     * @param mixed $like_n
     */
    public function setLikeN($like_n)
    {
        $this->like_n = $like_n;
        return $this;
    }

}
