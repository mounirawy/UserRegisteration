<?php
class RegisterDAAdmin{
    private $db;
    
    public function startconnection(){
        $this->db = mysqli_connect('127.0.0.1:3307',"root",'','usermanagement') or die("could not connect");
    }
    public function add_admin_DB($firstname,$lastname,$email,$password,$age,$gender){   
        
             ///insert the user to db 
        if($this->check_dublicate_register($email)){
            return 0;
        }
            if(isset($_POST['registeradmin_form'])){
             $query = "INSERT INTO admin(FirstName,LastName,Email,Password,Age,Gender) VALUES ('$firstname','$lastname','$email','$password','$age','$gender')";
             $result = mysqli_query($this->db,$query);
}
             $query2 = "select ID from admin where Email = '$email'";
             $result2 = mysqli_query($this->db,$query2);

             $row = mysqli_fetch_assoc($result2);
            if(!empty($row)){
                return $row['ID'];
                /*session_start();
                $_SESSION['Login_User'] = $row['ID'];
                header('Location:RegisterFormUser.php?id='.$row['ID']);*/
            }
    }
    
    public function check_dublicate_register($email){
        //check if email has registered before 
         $query = "select * from admin where Email = '$email' limit 1";

         $result = mysqli_query($this->db,$query);
         $admin = mysqli_fetch_assoc($result);

         if($admin){
             return true; //registered before
              }
        return false;

              //////////
    }
    
    
    
}


?>