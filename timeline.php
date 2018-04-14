<div class="container mainContainer"> 
    <h1>Timeline</h1>
    
 <!--Posts section-->   
    <div class="row">
        <div class="col-md-8">
        
            <h2>Posts For You</h2>
        
            <?php displayPosts('isFollowing');?>
            
        </div>
        
        
   <!--Search and Post Box-->     
        <div class="col-md-4">
        
        <?php displaySearch(); ?>
            <hr>
        <?php displayPostBox(); ?>    
        
        </div>
    </div>
    
    
    
    
    
    
</div>    
