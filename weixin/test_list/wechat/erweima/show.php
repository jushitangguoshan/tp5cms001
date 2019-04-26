<?php
require_once "WxApp.php";
$img = new WxApp();
?>
<!doctype html>
<html lang = "en">
<head>
     <meta charset = "UTF-8">
     <meta name = "viewport" content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
     <script src = "jquery_all.js"></script>
     <style>
          img{
               width: 300px;
               height: 300px;
          }
     </style>
     <title>Document</title>
</head>
<body>
<span id="qrscene_11">用户数：0</span><img src = "<?= $img->createTemporaryQrcodeById(11); ?>" alt = "">
<span id="qrscene_22">用户数：0</span><img src = "<?= $img->createTemporaryQrcodeById(22); ?>" alt = "">
<span id="qrscene_33">用户数：0</span><img src = "<?= $img->createTemporaryQrcodeById(33); ?>" alt = "">
<script>
     $(function(){
          setInterval(function(){
              $.ajax({
                  url:'../wechatConnect.php',
                  success:function(res) {
                      console.log(res);
                      if(res!=''){
                          $('span').text("用户数：0");
                          for(var i=0; i<res.length; i++){
                              $('#'+res[i].scene).text("用户数："+res[i].num);
                          }
                      }else{
                          $('span').text("用户数：0");
                      }
                  }
              })

          },2000)
     })
     
</script>
</body>
</html>
