<!DOCTYPE html>

<html>
    <head>
        <title>Hello~ 2</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
        </style>
    </head>
    <body>

        <div class="container">
            <div class="content">
                <div class="title">hello candy's world~</div>
                    <div id ="excelTest">
                    </div>
            </div>
        </div>



         <form action="./testgetform" method="post">
        　<input type="text" name="name" >
        　<input type="submit" name="Send" value="送出表單">
        </form>

        <?php
            echo ("got file");
            if ($_POST) {
                echo "姓名" . $_POST["name"];
            }
?>

    </body>
</html>
