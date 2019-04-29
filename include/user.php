<?php
/*$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=inventory_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }*/

    class User extends mysqli
    {

        function __construct()
        {
            Parent::__construct("localhost","root","","inventory_db");

            if($this->connect_error){
                $_SESSION['error']="DB Connection error: ". $this->connect_error;
               return;
            }
        }

        public function register($data)
        {
           if($data['password'] === $data['repeat_password']){

              $pass = password_hash($data['password'],PASSWORD_DEFAULT);
           }else{

               $_SESSION['error'] = "The passwords does not match.";
                return;
           }
           $token = bin2hex(random_bytes(4));
           $name = $data['firstname']." ". $data['lastname'];
           $q = "SELECT * FROM user_tbl WHERE user_email='$data[email]'";
           $run =$this->query($q);
            if( $run->num_rows>0 ){
                
                $_SESSION['error'] = "Email Already Exist";
                return;
            }else{
                $q = "INSERT INTO user_tbl(user_id,user_role_id,user_name,user_email,user_password,token,active,user_dob,user_address) 
                      VALUES('','','$name','$data[email]','$pass','$token',0,'$data[dob]','$data[address]')";
                $run =$this->query($q);
                if($run){
                    $user = $this->getuser($data['email']);
                    $_SESSION['user_id'] = $user->user_id;
                    $this->send_mail($user->user_email, $user->user_id, $token);
                    header("Location: http://localhost/IMS/active.php");
                }else{
                    $_SESSION['error'] ="Something went wrong.";
                }

            }
        }
        public function getuser($email)
        {
            $q = "SELECT * FROM user_tbl WHERE user_email='$email'";
            $run = $this->query($q);
            $row = $run->fetch_object();
            return $row;
        }
        public function send_mail($email,$id,$token)
        {
            $subject = "Account Activation Code";
            $headers = "From: test app\r\n";
            $headers .= "Reply-To: abc@abc.com \r\n";
            $headers .= "CC: abc@abc.com \r\n";
            $headers .= "MIME-Version:  1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
            $message = "<html><body>";
            $message .= "<h6>Your Activation Code</h6>";
            $message .= "<h3>". $token ."<h3>";
            $message .= "<h1> OR </h1>";
            $message .= "<h3>". $_SERVER['SERVER_NAME']. "/user/activ e.php?active=". $token. "&id=". $id . "<h3>";
            $message .= "</body></html>";

            mail($email,$subject,$message,$headers);
        }

        public function activate($id,$token)
        {
           $q ="UPDATE user_tbl SET active=1 WHERE user_id='$id' AND token='$token'";
           $run =$this ->query($q);
           if($run)
           {
               $user = $this->getuserbyid($id);
               $_SESSION['user'] = $user;
               header("Location:http://localhost/IMS/index.php");
           }else{
               $_SESSION['error']="Wrong Activation code.";
           }
        }

        public function getuserbyid($id){
             $q="SELECT * FROM user_tbl WHERE user_id='$id'";
             $run =$this->query($q);
             $row = $run->fetch_object();
             return $row;
        }
        public function auth($email, $password){
            
            $q="SELECT user_id FROM user_tbl WHERE user_email='$email' AND active=1";
            $run = $this->query($q);
            if($run->num_rows > 0){
                $row = $run->fetch_object();

                 $q="SELECT * FROM user_tbl WHERE user_id='$row->user_id'";
                 $run = $this->query($q);
                 $row = $run->fetch_object();

                 if(password_verify($password, $row->user_password))
                 {
                     $_SESSION['user'] = $row;
                     header("Location:http://localhost/IMS/index.php");
                 }else{
                     $_SESSION['error']="Password is not valid.";
                 }

            }else{
                $_SESSION['error'] ="Incorrect username or user is not active.";
            }
        }
    }
?>