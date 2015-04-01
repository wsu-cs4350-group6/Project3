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
    public function authenticate($username, $password)
    {
        try
        {
            $this->connect();
            $sql = "SELECT username,password from users where username='$username'";
            $statement = $this->dbh->query($sql);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            
            $row = $statement->fetch();
            
            if($row['password'] === md5($password))
            {
                return TRUE;
            }
            
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
        return FALSE;
    }
}
