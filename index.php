
<?php 
  include("include/content-header.php");
  if(!isset($_SESSION['user'])){

      header("Location:http://localhost/IMS/login.php");

  }else{
        if((time() - $_SESSION['last_time']) > 60){

          header("Location:http://localhost/IMS/logout.php");
        }else{
  
 
            include("include/navbar.php"); 
            include("include/bodycontent.php");
            include("include/content-footer.php");
             

        
      
        }}?>
</body>

</html>
