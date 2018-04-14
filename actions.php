<?php

    include("functions.php");


//Check if user is signing in or signing up and validate form is filled out
    if ($_GET['action'] == "loginSignup"){
        
        $error = "";
        
//enter email error        
        if (!$_POST['email']) {
            
            $error= "An email address is required.";
            
 //enter password error           
        } else if (!$_POST['password']) {
            
            $error= " A password is required.";

//incomplete email address error        
        } else if (filter_var($_POST['email'],
                   FILTER_VALIDATE_EMAIL)=== false) {
  
                $error = " Please enter a valid email address.";
        }
            if ($error != ""){
                
              echo $error;
              exit();
        }
//Signing up with email aready in use error                
        if ($_POST['loginActive'] == "0"){
            
            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) > 0) $error = "That email address is already taken :O ";
            
            else{
                
 //Successful info entered to sign up and sign up complete               
                $query = "INSERT INTO users (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email'])."', '". mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (mysqli_query($link, $query)){
                    
                     $_SESSION['id'] = mysqli_insert_id($link);
                    
                    $query = "UPDATE users SET password = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE id = ".$_SESSION['id']." LIMIT 1"; 
                        
                        mysqli_query($link, $query);
        
                    echo 1;
                                     
                } else{
                    
// Error completing signup, probably DB issue                    
                    $error = "couldn't create user - please try again later";
                }
            }
        } else {
            
//Sign in successful            
            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            
            $row = mysqli_fetch_assoc($result); 
                
                if ($row['password'] == md5(md5($row['id']).$_POST['password'])){
                    
                    echo 1;
                    
                    $_SESSION['id'] = $row['id'];
                    
                } else {
                    
//Bad login credentials                    
                    $error = "Could not find that username/password combination. Please try again.";
                }
            
        }
        
        if ($error != ""){
                
              echo $error;
              exit();
        }
    }
//Toggle follow and unfollow into DB

    if ($_GET['action'] == 'toggleFollow'){
        
         $query = "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ". mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";
            $result = mysqli_query($link, $query);
        
        
//unfollow        
            if(mysqli_num_rows($result) > 0) {
                
               $row = mysqli_fetch_assoc($result);  
                
               mysqli_query($link, "DELETE FROM isFollowing WHERE id = ". mysqli_real_escape_string($link, $row['id'])." LIMIT 1");    
                
                echo "1";
                
            } else {
                
//Follow                
               mysqli_query($link, "INSERT INTO isFollowing (follower, isFollowing) VALUES (". mysqli_real_escape_string($link, $_SESSION['id']).", ". mysqli_real_escape_string($link, $_POST['userId']).")");
                
                echo "2";
                
            }
    }

//Post 
    
    if ($_GET['action'] == 'postIt'){
        
             if(!$_POST['postContent']){
                    
                    echo "Your post is empty!";
                 
                } else if (strlen($_POST['postContent']) > 140){
                 
                 echo "Your post is too long.";
                 
             } else{
                 
                 mysqli_query($link, "INSERT INTO posts (`posts`, `userid`,`datetime` ) VALUES ('". mysqli_real_escape_string($link, $_POST['postContent'])."',". mysqli_real_escape_string($link, $_SESSION['id']).", NOW())");
                 
                 echo "1";
             }
    }
?>
