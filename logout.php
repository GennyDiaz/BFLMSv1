<?php
session_start();
if(session_destroy()){
echo "<script>
        localStorage.clear();
      </script>";
      
header("Location: login.php");
}
?>