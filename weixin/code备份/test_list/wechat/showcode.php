<!doctype html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
    <script src="jquery_all.js"></script>
    <title>Document</title>
    <style>
        img{
            width: 250px;
            height: 250px;
        }
         #mybody div{
              letf:50px;
              height: 200px;
              float:left;
         }
    </style>
</head>
<body>
    <div id="mybody">
         <div ><span class="user"></span>用户数：<span class="num"></span><img src = "" alt = ""></div>
         <div ><span class="user"></span>用户数：<span class="num"></span><img src = "" alt = ""></div>
         <div ><span class="user"></span>用户数：<span class="num"></span><img src = "" alt = ""></div>
    </div>

</body>
<script>
    var num =0;
    $(function(){
        $.ajax({
            url:'connect_sql.php?ope=init',
            success:function(res) {
                var res=($.parseJSON( res ))['data'];
                console.log(res);
                $('img').each(function(i,obj){
                    $(obj).attr('src',res[i]['img']);
                });
                $('.user').each(function(i,obj){
                    $(obj).html(res[i].name);
                })
                $('.num').each(function(i,obj){
                    $(obj).html(res[i].num);
                })
               setInterval(function(){
                  $.ajax({
                      url:'connect_sql.php?ope=up',
                      success:function(res) {
                          var res=($.parseJSON( res ))['data'];
                          console.log(res);
                          $('.num').each(function(i,obj){
                              $(obj).html(res[i].num);
                          })
                      }
                  })
              },1000);
            }
         })
    })
    // if(num<1){
    //     var times = setInterval(function(){
    //         $.ajax({
    //             url:'gethtml.php',
    //             success:function(res) {
    //                 var res=($.parseJSON( res ))['data'];
    //                 var div =$('.code');
    //                 console.log(res);
    //                 div.each(function(i,obj){
    //                     $(obj).html("<b>"+res.name+"(用户数："+res.num+")</b><img src = '"+res.img+"'>");
    //                 })
    //
    //             }
    //         })
    //     },2000);
    //  clearInterval(times);


</script>
</html>