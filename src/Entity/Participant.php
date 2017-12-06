<?php

/**
 * Created by PhpStorm.
 * User: antoine.lefevre
 * Date: 06/12/17
 * Time: 08:59
 */
 namespace App\Entity;

 use Doctrine\ORM\Mapping as ORM;
/**
 * Class Participant
 * @ORM\Table
 * @ORM\Entity
 */
class Participant
{

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\Column(name="name",type="string")
     */
    protected $name;

    /**
     * @ORM\OneToOne(targetEntity="Participant")
     */
    protected $target;

    /**
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param mixed $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }



}