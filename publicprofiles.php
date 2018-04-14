<div class="container mainContainer"> 
    <h1>Home</h1>
    
 <!--Posts section-->   
    <div class="row">
        <div class="col-md-8">
            
            <?php if ($_GET['userid']) { ?>
    
            <?php displayPosts($_GET['userid']); ?>
            
            <?php } else { ?>
        
            <h2>Active Users</h2>
        
            <?php displayUsers(); ?>
            
            <?php } ?>
            
        </div>
        
        
   <!--Search and Post Box-->     
        <div class="col-md-4">
        
        <?php displaySearch(); ?>
            <hr>
        <?php displayPostBox(); ?>    
        
        </div>
    </div>
    
    
    
    
    
    
</div>    
