<?php
class User
{
    private $db; 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    //public function register($fname,$lname,$uname,$umail,$upass)
    //{
    //   try
    //   {
    //       $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
    //       $stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass) 
    //                                                   VALUES(:uname, :umail, :upass)");
              
    //       $stmt->bindparam(":uname", $uname);
    //       $stmt->bindparam(":umail", $umail);
    //       $stmt->bindparam(":upass", $new_password);            
    //       $stmt->execute(); 
   
    //       return $stmt; 
    //   }
    //   catch(PDOException $e)
    //   {
    //       echo $e->getMessage();
    //   }    
    //}
 
    public function login($uname,$upass)
    {
       try
       {
//Prepare an SQL statement with named parameters
          $stmt = $this->db->prepare("SELECT * FROM users WHERE uid=:uname LIMIT 1");
          $stmt->execute(array(':uname'=>$uname));
//Fetches the next row from a result set | returns an array indexed by column name as returned in your result set
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC); 
          if($stmt->rowCount() > 0)
          {
             if($upass = $userRow['password'])
             {               
                setcookie("ha_dist_id", $uname, time()+3600);	
	            setcookie("ha_dist_role", $role, time()+3600);
              	$lastlogin=date("Y.m.d", time());
	            $timeUpdate="UPDATE users SET last_login='$lastlogin' WHERE uid='$uname'";
	            $conn->exec($timeUpdate);
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_COOKIE['ha_dist_id']))
      {
         return true;
      }
      else return false;
   }
 
   public function redirect($url)
   {
       header("Location: $url"); //Send a raw HTTP header
   }
 
   public function logout()
   {
        setcookie("ha_dist_id", "", time()-3600);
        unset($_COOKIE['ha_dist_id']);
        setcookie("ha_dist_role", "", time()-3600);
        unset($_COOKIE['ha_dist_role']);
        return true;
   }
}
?>