<?php

  session_start();
  session_destroy();
  header("Location:http://localhost/IMS/login.php");

 ?>