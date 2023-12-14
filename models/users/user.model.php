<?php

class User {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role_id;


    public function __construct($username,$email,$password,$role_id)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;

    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRoleId() {
        return $this->role_id;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }
}
