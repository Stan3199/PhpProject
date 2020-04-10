<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .sign-in,.sign-up,.admin{
            display:none;
        }
    </style>
    <script>
        $(document).ready(function(){
            
            $.ajax({
                url:'action.php',
                method:'POST',
                data:"&action=checkCookie"
            }).done(function(result){
                var data=JSON.parse(result);
                $("#lemail").val(data.email);
                $("#lpassword").val(data.password);
            })
            $("#Register").click(function(event){
                event.preventDefault();
                let data=$("#sign-up").serialize();
                console.log(data);
                $.ajax({
                    url:'action.php',
                    method:'POST',
                    data: data+'&action=register'
                }).done(function(result){
                    console.log(result);
                })
            })
            $("#log-in").click(function(event){
                event.preventDefault();
                let data=$('#sign-in').serialize();
                console.log(data);
                $.ajax({
                    url:'action.php',
                    method:'POST',
                    data: data+'&action=login'
                }).done(function(result){
                    console.log(result)
                    var data=JSON.parse(result);
                    if(data.status==0) console.log(data.msg);
                    else window.location="login.php";
                })
            })
            $("#ad-sub").click(function(event){
                event.preventDefault();
                var data=$("#admin").serialize();
                // console.log(data);
                $.ajax({
                    url:'action.php',
                    method:'POST',
                    data:data+"&action=admin"
                }).done(function(result){
                    console.log(result);
                    var data=JSON.parse(result);
                    if(data.status==1){
                        window.location="admin.php";
                    }
                })
            })
        });
    </script>
</head>
<body>
    <div class="p-3 mb-2 bg-dark text-white"><b>Welcome To Website</b></div>
    <div class="container">
        <a href="#" onclick="$('.sign-in').show();$('.sign-up').hide();$('.admin').hide();"><span class="login" id="login">Sign In</span></a>
        <a href="#" onclick="$('.sign-up').show();$('.sign-in,.admin').hide();"><span class="signup" id="signup">Sign Up</span></a>
        <a href="#" onclick="$('.admin').show();$('.sign-in,.sign-up').hide()"><span class="adm" id="adm">Admin Login</span></a>
        <span class='sign-in'>
            <form id="sign-in" action="" method="POST">
              <input type="text" id="lemail" name="lemail" placeholder="Enter your name"><br>
              <input type="text" id="lpassword" name="lpassword" placeholder="Enter your password"><br>
              <input type="checkbox" id="rememberMe" name="rememberMe"><span>Remember Me</span><br>
              <input type="submit" id="log-in" name="submit_1" value="submit">
            </form>
          </span>
          <span class='sign-up'>
            <form id="sign-up" action="" method="POST">
              <input type="text" id="fname" name="fname" placeholder="Enter your name"><br>
              <input type="text" id="lname" name="lname" placeholder="Enter your last name"><br>
              <input type="text" id="email" name="email" placeholder="Enter your email"><br>
              <input type="text" id="password" name="password" placeholder="Enter your password"><br>
              <input type="text" id="contact" name="contact" placeholder="Enter your contact number"><br> 
              <input type="submit" id="Register" name='submit_2' value="submit">
            </form>
          </span>
          <span class='admin'>
            <form id="admin" action ="" method ="POST">
              <input type="text" name="adid" placeholder="Enter your email"><br>
              <input type="password" name="adpass" placeholder="Enter your password"><br>
              <input type="submit" id="ad-sub" name="adsub" value="Submit">
            </form>
          </span>
    </div>
</body>
</html>