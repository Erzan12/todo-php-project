<?php

class User {
    private $name;
    private $email;

    public function __construct($name, $email){
        $this->name = $name;
        $this->email = $email;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
}
$user = new User("John Doe", " do.earljan@gmail.com");
echo $user->getName();
echo $user->getEmail();

