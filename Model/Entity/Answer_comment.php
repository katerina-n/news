<?php
namespace Model\Entity;
class Answer_comment{
    private $id;
    private $user_name;
    private $comment_id;
    private $comments;

    /**
     * Answer_comment constructor.
     * @param $id
     * @param $user_name
     * @param $comment_id
     * @param $comments
     */
    public function __construct($id, $user_name, $comment_id, $comments)
    {
        $this->id = $id;
        $this->user_name = $user_name;
        $this->comment_id = $comment_id;
        $this->comments = $comments;
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
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * @param mixed $comment_id
     */
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
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

}
