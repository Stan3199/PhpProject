<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
    <script>
        $(document).ready(function(){
            console.log(localStorage.getItem("changeId"));
            sen=localStorage.getItem("changeId");
                $.ajax({
                    url:'action.php',
                    method:'POST',
                    data:sen+"&action=display"
                }).done(function(result){
                    var data=JSON.parse(result);
                    console.log(result);
                    for (let [key, value] of Object.entries(data)){
                        $("#red").append(key+"<input type='text' name="+key+" id="+key+" value="+value+">"+"<br>");
                    };
                })
                $(".change").click(function(event){
                    event.preventDefault();
                    var data=$("#red").serialize();
                    console.log(data);
                    $.ajax({
                        url:'action.php',
                        method:'POST',
                        data:data+"&action=end"
                    }).done(function(result){
                        console.log(result);
                    });
                });
        });
    </script>
</head>
<body>
    <div class="result">
        <form id="red" action="" method="POST">
        
        </form>
        <input type="submit" class="change" name="changecheck" value="Submit">
    </div>
    
</body>
</html>