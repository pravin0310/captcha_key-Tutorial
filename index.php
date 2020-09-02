<html>  
    <head>  
        <title>How to Implement Google reCaptcha in PHP Form</title>  
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>  
    <body>  
        <div class="container" style="width: 600px">
             <br />
             
             <h3 align="center">How to Implement Google reCaptcha in PHP Form</a></h3><br />
             <br />
          <div class="panel panel-default">
          <div class="panel-heading">Register Form</div>
          <div class="panel-body">
               
            <form metod="post" id="captcha_form">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                          <label>First Name <span class="text-danger">*</span></label>
                          <input type="text" name="first_name" id="first_name" class="form-control" />
                          <span id="first_name_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                          <label>Last Name <span class="text-danger">*</span></label>
                          <input type="text" name="last_name" id="last_name" class="form-control" />
                          <span id="last_name_error" class="text-danger"></span>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="text" name="email" id="email" class="form-control" />
                    <span id="email_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" />
                    <span id="password_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="Enter your captcha key"></div>
                    <span id="captcha_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                    <input type="submit" name="register" id="register" class="btn btn-info" value="Register" />
                    </div>
        </form>
               
          </div>
    </div>
  </div>
    </body>  
</html>

<script>
//script using send file and get captcha key
$(document).ready(function(){

 $('#captcha_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"mailsend.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function()
   {
    $('#register').attr('disabled','disabled');
   },
   success:function(data)
   {
    $('#register').attr('disabled', false);
    if(data.success)
    {
     $('#captcha_form')[0].reset();
     $('#first_name_error').text('');
     $('#last_name_error').text('');
     $('#email_error').text('');
     $('#password_error').text('');
     $('#captcha_error').text('');
     grecaptcha.reset();
     alert('Form Successfully validated');
    }
    else
    {
     $('#first_name_error').text(data.first_name_error);
     $('#last_name_error').text(data.last_name_error);
     $('#email_error').text(data.email_error);
     $('#password_error').text(data.password_error);
     $('#captcha_error').text(data.captcha_error);
    }
   }
  })
 });

});
</script>
