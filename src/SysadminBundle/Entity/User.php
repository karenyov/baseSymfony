<?php

namespace SysadminBundle\Entity;

use SysadminBundle\Enum\TypeYesNo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="sys_user")
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
     * @Assert\Length(min = "2",max = "255", 
     * minMessage = "Your name must be at least {{ limit }} characters length",
     * maxMessage = "Your name cannot be longer than {{ limit }} characters length"
     * ) 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=90)
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.", checkMX = true )
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=90)
     * @Assert\NotBlank
     * @Assert\Length(min = "6", max = "40",
     * minMessage = "Your password must be at least {{ limit }} characters length",
     * maxMessage = "Your password cannot be longer than {{ limit }} characters length"
     * )
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
