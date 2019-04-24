<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=50)
   * @Assert\NotBlank()
   *
   */
  private $name;

  /**
   * @ORM\Column(type="string", length=50)
   * @Assert\NotBlank()
   *
   */
  private $email;
  
  /**
   * @ORM\Column(type="string", length=50)
   * @Assert\NotBlank()
   *
   */
  private $birthday;
  /**
   * @ORM\Column(type="string", length=50)
   * @Assert\NotBlank()
   *
   */
  private $gender;
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
  public function getEmail()
  {
    return $this->email;
  }
  /**
   * @param mixed $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }
  /**
   * @return mixed
   */
  public function getBirthday()
  {
    return $this->birthday;
  }
  /**
   * @param mixed $birthday
   */
  public function setBirthday($birthday)
  {
    $this->birthday = $birthday;
  }
  /**
   * @return mixed
   */
  public function getGender()
  {
    return $this->gender;
  }
  /**
   * @param mixed $gender
   */
  public function setGender($gender)
  {
    $this->gender = $gender;
  }
}