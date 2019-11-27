<?php

namespace MarieMarthe\Blog\Model;
// dans cette classe, on se connecte à la BDD

class Manager
{   
    protected $name;
    protected $config;
    protected $db;

    const FLASH_SUCCESS = 'success';
    const FLASH_ERROR = 'danger';
    const FLASH_WARNING = 'warning';
    const FLASH_INFO = 'info';
    
    public function __construct()
    {
        if (!$this->config) {
            $this->config = require 'config.php';
        }
        if (!$this->name) {
            $this->name = $this->config['Site']['name'];
        }
    }

    //Méthode de connexion à notre base de données
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=P3_TELBOISMM;charset=utf8', 'root', 'root');
        
        return $db;
    }

    public function setFlash($message, $class = 'success')
    {
        $_SESSION['Flash'] = new \stdClass();
        $_SESSION['Flash']->class = $class;
        $_SESSION['Flash']->message = $message;
    }

    public function isAdmin()
    {
        return (new AdminManager())->isAdmin();
    }

