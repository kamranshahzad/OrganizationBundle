<?php
namespace Cogilent\OrganizationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cogilent\UserBundle\Entity\User;


/**
 * @ORM\Table(name="organization")
 * @ORM\Entity()
 */
class Organization
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
     * @ORM\Column(name="title", type="string", length=50 , nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=150 , nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Department", mappedBy="organization", cascade={"persist"})
     * @var type
     */
    private $departments;


    /**
     * @ORM\ManyToOne(targetEntity="Cogilent\UserBundle\Entity\User", inversedBy="organizations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var type
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Cogilent\ContactsBundle\Entity\Employee", mappedBy="user", cascade={"persist"})
     * @var type
     */
    private $employees;

    public function __construct(){
        $this->departments = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }

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



    public function getDepartments(){
        return $this->departments;
    }

    public function addDepartments(Department $departments){
        $this->departments[] = $departments;
        $departments->setOrganization($this);
    }

    public function setDepartment(Department $departments){
        $this->departments = $departments;
        foreach ($departments as $dept){
            $dept->setOrganization($this);
        }
    }

    public function addDepartment(Department $departments){
        $this->departments[] = $departments;
        return $this;
    }

    public function removeDepartment(Department $departments){
        $this->departments->removeElement($departments);
    }

    public function setUser(User $user){
        $this->user = $user;
    }

    public function getUser(){
        return $this->user;
    }

}//@
