<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     * @Assert\Type("string")
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(
     *      max = 11,
     *      maxMessage = "Az adószám maximum 11 számjegyből állhat!"
     * )
     * @Assert\Type("integer")
     */
    private $taxNumber;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    private $country;

    /**
     * @ORM\Column(type="integer", length=4, nullable=false)
     * @Assert\Length(
     *      max = 4,
     *      maxMessage = "Az irányítószám maximum 4 számjegyből állhat!"
     * )
     * @Assert\Type("integer")
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    private $city;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type("string")
     */
    private $address;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getTaxNumber() {
        return $this->taxNumber;
    }

    public function setTaxNumber($taxNumber) {
        $this->taxNumber = $taxNumber;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getPostCode() {
        return $this->postCode;
    }

    public function setPostCode($postCode) {
        $this->postCode = $postCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
}