<?php

namespace SysadminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * S => SIM/N => NÃO
     * 
     * @ORM\Column(name="active", type="string", columnDefinition="enum('S', 'N')")
     */
    private $active;

    function __construct() {
        $this->active = 'S';
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

    function setActive(\enum $active) {
        $this->active = $active;
    }

    /**
     * @return string 
     */
    public function __toString() {
        return $this->getName();
    }
}
