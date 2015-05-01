<?php
namespace Cogilent\OrganizationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="locations")
 * @ORM\Entity()
 */
class Location
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(name="type",type="string", columnDefinition="ENUM('office', 'field')")
     */
    private $type;


    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public function getType(){
        return $this->type;
    }


}//@