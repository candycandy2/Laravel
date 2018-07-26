<!DOCTYPE html>

<html>
    <head>
        <title>Hello~ 2</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
        </style>
    </head>
    <body>
        <form action="" method="get">
                {{ csrf_field() }}
                姓名：<input type="text" name="name"/><br>
                性別：<input type="radio" name="sex" value="male"/>男
                <input type="radio" name="sex" value="female"/>女
                <br><input type="submit" value="送出"/>
        </form>

        <?php
        if($_GET){
            echo $_GET['name'].", ".$_GET['sex'];
        }
         if ($_POST) {
                echo "姓名" . $_POST["name"];
            }
        ?>
    </body>
</html>
