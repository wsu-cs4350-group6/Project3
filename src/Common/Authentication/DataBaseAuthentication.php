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
    
    protected $dbEngine;
    protected $dbh;
    protected $dbHost = 'localhost';
    protected $dbName = 'cs4350';
    protected $dbUser = 'cs4350';
    protected $dbPassword = 'cs4350';
    
    /*
    *   @param string database engine - MySQL or SQLite
    */
    function __construct($engine)
    {
        $this->dbEngine = $engine;
    }
    
    /*
    *   connect to database
    */
    private function connect()
    {
        if($this->dbEngine === 'sqlite')
        {
            $this->dbh = new PDO('sqlite:'.__DIR__ . '/../../../data/cs4350.sqlite');
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
        $exists = FALSE;
        try
        {
            $this->connect();
            $sql = "SELECT username from users where username='$username'";
            $statement = $this->dbh->query($sql);
            $exists = (bool) $statement->fetch();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
        return $exists;
    }
    /*
    *   @param string $username
    *   @param string $password
    *   @return int returns the response codes
    */
    public function authenticate($username, $password)
    {
        $responseCode = 403;
        if($this->userExists($username))
        {
            $responseCode = 401;
            try
            {
                $this->connect();
                $sql = "SELECT username,password from users where username='$username'";
                $statement = $this->dbh->query($sql);
                $statement->setFetchMode(PDO::FETCH_ASSOC);
            
                $row = $statement->fetch();
            
                if($row['password'] === md5($password))
                {
                    $responseCode = 200;
                }
            
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        return $responseCode;
    }
}
