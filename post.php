<?php
    
    
    require_once("dbtools.inc.php");
    $author = $_POST["author"];
    $subject = $_POST["subject"];
    $text = $_POST["text"];
    $time = date("Y-m-d H:i:s");
    
    $link = create_connection();
    $sql = "SELECT * FROM users";
    $result = execute_sql($link,"Portfolio_2",$sql);
    
    $cid = mysqli_num_rows($result) + 1;
    
    $sql = "INSERT INTO users(id,author,subject,context,date) VALUES($cid,'$author','$subject','$text','$time')";
    //echo $sql;
    $result = execute_sql($link,"Portfolio_2",$sql);
    
        
    mysqli_close($link);
    
    header("location:index.php");
    exit();
    
    
    
        
    
    
?>