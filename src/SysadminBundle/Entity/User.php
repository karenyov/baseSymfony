<?php

namespace SysadminBundle\Entity;

use SysadminBundle\Enum\TypeYesNo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SysadminBundle\Repository\UserRepository")
 */
class User extends \AppBundle\Entity\LogAbstract {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=90)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=90)
     * @Assert\Email
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=90)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @var enum
     * 
     * Y => YES/N => NO
     * 
     * @ORM\Column(name="active", type="TypeYesNo", nullable=false)
     * @DoctrineAssert\Enum(entity="SysadminBundle\Enum\TypeYesNo") 
     */
    private $active;

    function __construct() {
        $this->active = TypeYesNo::TYPE_YES;
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getActive() {
        return $this->active;
    }

    function setActive($active) {
        $this->active = $active;
    }

    /**
     * @return string 
     */
    public function __toString() {
        return $this->getName();
    }

}
