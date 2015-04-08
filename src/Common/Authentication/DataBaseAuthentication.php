<?php
/**
 * File name: DataBaseAuthentication.php
 *
 * Project: Project1
 *
 * PHP version 5
 *
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace API\Common\Authentication;

use API\Model\User;
use PDO;

class DataBaseAuthentication implements IAuthentication 
{
    /**
     * Function authenticate
     *
     * @param string $username
     * @param string $password
     * @return mixed
     *
     * @access public
     */

    protected $env;
    protected $sqlite;
    protected $mysql;
    protected $dbEngine;
    protected $dbh;
    protected $dbHost;
    protected $dbName;
    protected $dbUser;
    protected $dbPassword;
    
    /*
    *   @param string database engine - MySQL or SQLite
    */
    function __construct($engine, $env)
    {
        $this->dbEngine = $engine;
        $this->env = $env;
        $this->sqlite = $env['config']['app']['sqlite'];
        $this->dbHost = $env['config']['app']['mysql']['host'];
        $this->dbName = $env['config']['app']['mysql']['name'];
        $this->dbUser = $env['config']['app']['mysql']['user'];
        $this->dbPassword = $env['config']['app']['mysql']['password'];
    }
    
    /*
    *   connect to database
    */
    private function connect()
    {
        if($this->dbEngine === 'sqlite')
        {
            $this->dbh = new PDO('sqlite:' . $this->sqlite);
            return;
        }
        if($this->dbEngine === 'mysql')
        {
            $this->dbh = new PDO('mysql:dbname='.$this->dbName.';host='.$this->dbHost,$this->dbUser,$this->dbPassword);
            return;
        }
        
    }
    /*
    *   @param string $username
    *   @return boolean
    */
    public function userExists($username)
    {
        return User::exists($username);
    }
    /*
    *   @param string $username
    *   @param string $password
    *   @return int returns the response codes
    */
    public function authenticate($username, $password)
    {
        $responseCode = 401;
        $body = '';

        if(!$this->userExists($username)) {
            $body = array('UserNotFound' => '/register');
            return array('status' => $responseCode, 'body' => $body);
        }
        try
        {
            $this->connect();
            $sql = "SELECT id,username,password from users where username=:username";
            $statement = $this->dbh->prepare($sql);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $row = $statement->fetch();

            if($row['password'] !== md5($password))
            {
                $body = array('InvalidCredentials' => 'Invalid username:password');
                return array('status' => $responseCode, 'body' => $body);
            }
            $responseCode = 200;
            $body = array('Location' => '/user/'.$row['id']);
            return array('status' => $responseCode, 'body' => $body);

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
