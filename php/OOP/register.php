<?php


$name = $_REQUEST['name'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];


interface Person
{

    public function speak();
    public function dance();
    public function sing();
}

class Local implements Person
{
    private $name;
    private $address;
    private $birthday;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function speak()
    {
        echo 'Sinhala';
    }
    public function dance()
    {
        echo 'udarata';
    }
    public function sing()
    {
        echo 'mal waran';
    }
}


class Foreigner extends Local implements Person
{

    private $country;
    private $preAddress;

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function speak()
    {
        echo 'English';
    }
    public function dance()
    {
        echo 'bale';
    }
    public function sing()
    {
        echo 'Acapella';
    }
}

abstract class X
{
    public abstract function dance();
}

$person1 = new Local();
$person1->setName($name);
$person1->setAddress($address);
$person1->setBirthday($birthday);

var_dump($person1->getName(), $person1->sing());

echo '<br>';

$foreigner1 = new Foreigner();
$foreigner1->setName('John');
$foreigner1->setAddress('Colombo');
$foreigner1->setBirthday('2000-10-10');
$foreigner1->setCountry('England');

var_dump($foreigner1->sing());

$xx = new X();

die;
