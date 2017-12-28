<?php

namespace model\dao;
require_once('/configs/Config.php');
use \PDO;
use config\Config;
/**
 * Description of Connexion
 *
 * @author Joel
 */
class Connexion {
 
	
    private static $instance = null;
	
    private function __construct() {}
	
    public static function getInstance(){
        if(self::$instance == null) {
            self::$instance = new PDO(
                    "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . "", Config::DB_USER, Config::DB_PWD);
        }
        return self::$instance;
    }
        
    public static function close() {
        self::$instance = null;
    }
}
