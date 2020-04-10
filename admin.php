<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
    <script>
        $(document).ready(function(){
            $.ajax({
                url:'action.php',
                method:'POST',
                data:"&action=alldata"
            }).done(function(result){
                var data=JSON.parse(result);
                // console.log(data);
                // console.log(result[1]['First name']);
                for(var i=0,len=data.length;i<len;i++){
                    for(var j=0,le=Object.keys(data[i]).length;j<le/2;j++)
                    $(".result").append("<span>"+data[i][j]+"</span>"+" ");
                    $(".result").append("<button onclick='change(\""+data[i]['S.no']+"\")'>Edit</button>");
                    $(".result").append("<br>");
                }
            })
            
        });
        function change(data){
            
            var sen="id="+data;
            console.log(sen);
            localStorage.setItem("changeId",sen);
            window.location="change.php";
                
        }
    </script>
</head>
<body>
    <div class="p-3 mb-2 bg-dark text-white"><b>Welcome Admin</b></div>
    <div class="result">

    </div>
</body>
</html>