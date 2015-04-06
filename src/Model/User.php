<?php
namespace API\Model;
use PDO;

class User
{
    protected $username;
    protected $password;
    
    /*
    * @param string $username
    * @param string $password
    */
    function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = md5($password);
        
    }
    
    /*
    * @return boolean
    */
    public static function exists($username)
    {
        $exists = FALSE;
        try
        {
            $dbh = new PDO('sqlite:'.User::getApp()->sqliteFile);
            $sql = "SELECT username from users where username=:username";
        
            $statement = $dbh->prepare($sql);
            $statement->execute(array(':username'=>$username));
            $exists = (bool)$statement->fetch();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $exists;
    }
    
    /*
    * @return mixed?
    */
    public static function getApp()
    {
        return \Slim\Slim::getInstance();
    }
    
    /*
    * @return boolean
    */
    public function save()
    {
        $success = FALSE;
        
        $sql = "INSERT INTO users (username,password) values(:username,:password";
        if(User::exists($this->username))
        {
            $sql = "UPDATE users SET username=:username, password=:password WHERE username=:username";
        }
        
        try
        {
            $dbh = new PDO('sqlite:'.User::getApp()->sqliteFile);
            $statement = $dbh->prepare($sql);
            $success = $statement->execute(array(
                ':username' => $this->username,
                ':password' => $this->password
            ));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
        return $success;
        
    }
}