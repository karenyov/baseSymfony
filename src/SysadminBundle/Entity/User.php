<?php

namespace SysadminBundle\Entity;

use SysadminBundle\Enum\TypeYesNo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="sys_user")
 * @ORM\Entity(repositoryClass="SysadminBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User implements AdvancedUserInterface, \Serializable {

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
     * @var string
     *
     * @ORM\Column(name="role", type="string", columnDefinition="ENUM('ROLE_ADMIN', 'ROLE_USER')", length=50)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"ROLE_ADMIN", "ROLE_USER"})
     */
    private $role;

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
        $this->role = 'ROLE_USER';
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

    function getRole() {
        return $this->role;
    }

    function setRole($role) {
        $this->role = $role;
    }

    /**
     * @return string 
     */
    public function __toString() {
        return $this->getName();
    }

    public function getRoles() {
        return array($this->role);
    }

    public function getSalt() {
        return null;
    }

    public function eraseCredentials() {
        
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function getUsername() {
        
    }

    public function isEnabled() {
        return $this->active;
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            $this->active
        ));
    }

    public function unserialize($serialized) {
        list (
                $this->id,
                $this->name,
                $this->email,
                $this->password,
                $this->active
                ) = unserialize($serialized);
    }

}
