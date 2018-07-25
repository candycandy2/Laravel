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


        <form method="post" enctype="multipart/form-data" >
             {{ csrf_field() }}
            <input type="file" name="picture">
            <button type="submit"> 提交 </button>
        </form>



    </body>
</html>
