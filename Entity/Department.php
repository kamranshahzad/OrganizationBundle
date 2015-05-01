<?php
namespace Cogilent\OrganizationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="departments")
 * @ORM\Entity()
 */
class Department
{
    /**
    * @var integer
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=150 , nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="departments")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     * @var type
     */
    private $organization;



    public function getId(){
        return $this->id;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }


    public function setOrganization(Organization $organization){
        $this->organization = $organization;
    }

    public function getOrganization(){
        return $this->organization;
    }


}//@
