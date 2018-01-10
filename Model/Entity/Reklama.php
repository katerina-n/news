<?php
namespace Model\Entity;
class Reklama{
    private $id;
    private $name;
    private $name_firm;
    private $price;
    private $date;

    /**
     * Reklama constructor.
     * @param $id
     * @param $name
     * @param $name_firm
     * @param $price
     * @param $date
     */
    public function __construct($id, $name, $name_firm, $price, $date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->name_firm = $name_firm;
        $this->price = $price;
        $this->date = $date;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameFirm()
    {
        return $this->name_firm;
    }

    /**
     * @param mixed $name_firm
     */
    public function setNameFirm($name_firm)
    {
        $this->name_firm = $name_firm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

}
