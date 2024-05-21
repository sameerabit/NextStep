<?php
namespace Viraj\Strange;

include 'A.php';


// use Viraj\Learner\X;
// use function Viraj\Learner\getName;

// echo getName();

// new \Viraj\Learner\X();

abstract class Animal {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    abstract public function makeSound();
}

interface Rat {
    public function makeSound();
}

interface Cricket {
    public function don();
}

class Dog extends Animal implements Rat,Cricket {
    public function makeSound() {
        return 'Woof!';
    }
    public function don() {
        return 'don!';
    }
}

class Cat extends Animal {
    public function makeSound() {
        return 'Meow!';
    }
}

$dog = new Dog('Max');

$dog = new Dog('Max');
echo $dog->don();  // Output: Woof!

$cat = new Cat('Whiskers');
echo $cat->makeSound();  // Output: Meow!