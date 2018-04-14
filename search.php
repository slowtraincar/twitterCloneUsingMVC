<div class="container mainContainer"> 
    <h1>Home</h1>
    
 <!--Posts section-->   
    <div class="row">
        <div class="col-md-8">
        
            <h2>Search Results</h2>
        
            <?php displayPosts('search');?>
            
        </div>
        
        
   <!--Search and Post Box-->     
        <div class="col-md-4">
        
        <?php displaySearch(); ?>
            <hr>
        <?php displayPostBox(); ?>    
        
        </div>
    </div>
    
    
    
    
    
    
</div>    
