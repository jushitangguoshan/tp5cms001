<!doctype html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
    <title>深圳远东it学院</title>
    <style>
    </style>
</head>
<body>
    <form action = "">
        <table border="0">
            <tr>
                <td>头像：<img src = <?=$res['headimgurl']?> alt = "" style="width: 100px;height: 100px;"></td>
            </tr>
            <tr>
                <td>  用户: <input type = "text" value=<?=$res['nickname']?>></td>
            </tr>
             <tr>
                <td>  国家：<input type = "text" value=<?=$res['country']?>></td>
            </tr>
             <tr>
                <td> 性别：<input type = "text" value=<?=($res['sex']==1 ? "男" : "女")?>></td>
            </tr>
        </table>
    </form>
</body>
</html>