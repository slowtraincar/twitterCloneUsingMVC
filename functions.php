
<?php

//Set Cookie
    session_start();


//Get into db
    $link = mysqli_connect("server", "username", "password", "database");

//Error getting in
    if(mysqli_connect_error()) {
        
        print_r (mysqli_connect_error());
        exit();
    }
//Logging out unsets cookie
    if ($_GET['function'] == "logout") {
        
        session_unset();
    }

//Convert time into "two minutes ago" etc   
    function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
    
    }


//Display posts public/followed
    function displayPosts($type) {
        
        global $link;
        
 //Display public posts       
        if ($type == 'public'){
            
            $whereClause = "";
            
//Display Followed posts            
        }else if ($type == 'isFollowing'){
            
            $query = "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id']);
            $result = mysqli_query($link, $query);
       
            $whereClause = "";
                
              while ($row = mysqli_fetch_assoc($result)){
            
                  if ($whereClause == "") $whereClause = "WHERE"; 
                  else $whereClause.= " OR";
                  $whereClause.= " userid = ".$row['isFollowing'];
                  
            }
 
//User post history            
        } else if ($type == 'yourposts'){
            
            echo $whereClause = "WHERE userid = ". mysqli_real_escape_string($link, $_SESSION['id']);

            
            
//Search with partial results function            
        } else if ($type == 'search') {
            
             echo '<p>Showing results for "'. mysqli_real_escape_string($link, $_GET['q']).'" :</p>';
            
             $whereClause = "WHERE posts LIKE  '%". mysqli_real_escape_string($link, $_GET['q'])."%'";
            
        } else if (is_numeric($type)) {
            
            
//Search results for user           
            $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $type)." LIMIT 1";
                $userQueryResult = mysqli_query($link, $userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);
            
            echo "<h2>".mysqli_real_escape_string($link, $user['email'])."'s posts </h2>";
            
            $whereClause = "WHERE userid = ". mysqli_real_escape_string($link, $type);
            
        }
        
        $query = "SELECT * FROM posts ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
        
        $result = mysqli_query($link, $query);
        
        
 
//Message if there are no posts to display        
        if (mysqli_num_rows($result) == 0) {
            
            echo "There are no posts to display.";
            
        } else {
            
            
 
//Display posts limit to most recent ten            
            while ($row = mysqli_fetch_assoc($result)) {
                
                $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                $userQueryResult = mysqli_query($link, $userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);
                
          
                
                
//Post Contruct
                
                
                
//User w/name link to profile               
                echo "<div class= 'post'><p><a href='?page=publicprofiles&userid=".$user['id']."'>".$user['email']."</a></p>";
//Post content                
                echo "<p>".$row['posts']."</p>";
//Time                
                echo "<p> <span class ='time'>".time_since(time() - strtotime($row['datetime']))." ago</span></p>";
//Follow toggle                 
                echo "<p><a class='toggleFollow' data-userId='".$row['userid']."'>";

                $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ". mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);
                
                
//unfollow        
            if(mysqli_num_rows($isFollowingQueryResult) > 0) {
                
               echo "Unfollow";
//Follow                
            } else {
                
                echo "Follow";
            }
                
                
                echo "</a></p></div>";
                
            }
            
        }
        
    }

//Search box response

    function displaySearch() {
        
        echo '<form class="form-row align-items-center"> 
                <div class="col-auto">
                  <input type="hidden" name="page" value="search">
                  <input type="text" name="q" class="form-control mb-2" id="search" placeholder="Search">
                </div>
                <div class="col-auto">
                  <button class="btn btn-danger text-white mb-2">Search Posts</button>
                </div>
              </form>';
        
    }

//Post Response

    function displayPostBox(){
        if ($_SESSION['id'] > 0){
            
            echo '<div id="postSuccess" class= "alert alert-secondary">You posted it!</div>
                  <div id= "postFail" class= "alert alert-danger"></div>
                  
                  <div class="form-row align-items-center" id="postBox"> 
                    <div class="col-auto">
                      <textarea class="form-control mb-2" id="postContent"></textarea>
                    </div>
                    
                    <div class="col-auto">
                      <button id= "postItButton" class="btn btn-danger text-white mb-2">Post It!</button>
                    </div>
                  </div>';
            }
        }

//Show public profiles
    function displayUsers(){
        
        global $link;
        
        $query = "SELECT * FROM users LIMIT 10";
        
        $result = mysqli_query($link, $query);
                
            while ($row = mysqli_fetch_assoc($result)) {
                
                echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
        
            }
        }
    
?>
