<div class="fixed-bottom text-center">
    <footer>
        <p>&copy; Doug A. Carter 2018</p>
    </footer>
</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>








<!-- Button trigger modal -->

 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalTitle">Log In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" id="loginAlert"></div>
        <form>
            <input type="hidden" id="loginActive" name="loginActive" value="1">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="stayloggedin">
            <label class="form-check-label" for="stayloggedin">Stay Logged In</label>
          </div>
        </form>    
      </div>
      <div class="modal-footer">
          <a id="toggleLogin">Dont have an account? Sign Up!</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="loginSignupButton">Login</button>
      </div>
    </div>
  </div>
</div>


<!--Toggle login/signup and log out button-->
<script>
    $("#toggleLogin").click(function(){
        
        if ($("#loginActive").val() == "1") {
            
            $("#loginActive").val("0");
            $("#loginModalTitle").html("Sign Up");
            $("#loginSignupButton").html("Sign Up");
            $("#toggleLogin").html("Already have an account? Login!");
            
        }else{
            
            $("#loginActive").val("1");
            $("#loginModalTitle").html("Login");
            $("#loginSignupButton").html("Login");
            $("#toggleLogin").html("Don't have an account? Sign Up!");
                
        }
    })
    
    $("#loginSignupButton").click(function(){
        
        $.ajax({
            type: "POST",
            url:"actions.php?action=loginSignup",
            data:"email=" + $("#email").val() + 
                 "&password=" + $("#password").val() + 
                 "&loginActive=" + $("#loginActive").val(),
            success: function(result){
                if (result == "1"){
                    
                   window.location.assign ("http://socialformediamakers-com.stackstaging.com/");
                
                } else{
                    
                    $("#loginAlert").html(result).show();
                    
                    
                }
            }
        })
    })
    
    $(".toggleFollow").click(function(){
   
        var id= $(this).attr("data-userId");
        
        $.ajax({
            type: "POST",
            url:"actions.php?action=toggleFollow",
            data:"userId=" + id,  
            success: function(result){
                
                if(result == "1"){
                
                    $("a[data-userId='" + id + "']").html("Follow");
                
                } else if(result == "2"){
                
                    $("a[data-userId='" + id + "']").html("Unfollow");
                
                }
            }
        })
    })
    
    
    $("#postItButton").click(function(){
        
        $.ajax({
            type: "POST",
            url:"actions.php?action=postIt",
            data:"postContent=" + $("#postContent").val(),  
            success: function(result){
                
                if (result == "1"){
                    $("#postSuccess").show();
                    $("#postFail").hide();
                    
                }else if (result != ""){
                    
                    $("#postFail").html(result).show();
                    $("#postSuccess").hide();
                }
            
        }
    })
    
})
</script>
  </body>
</html>

