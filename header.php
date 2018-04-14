<!doctype html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
      
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">  
    <title>S4MM</title>
  </head>
    
    <body>
        
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
        <a class="navbar-brand" href="http://socialformediamakers-com.stackstaging.com"><b>S4MM</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=timeline">Your Timeline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=yourposts">Your Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?page=publicprofiles">Public Profile</a>
                </li>
                
            </ul>
            <div class="form-inline my-2 my-lg-0">
                
                <?php if ($_SESSION['id']){ ?>
                
                <a class="btn btn-dark text-white my-2 my-sm-0" href="?function=logout">Log Out</a>
    
                <?php } else { ?>
                
                <button class="btn btn-dark text-white my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">Login / SignUp</button>
                
                <?php } ?>
            </div>
        </div>
    </nav>
