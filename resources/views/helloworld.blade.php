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
            <input type="file" name="doc" accept=".csv,.xls,.xlsx">
            <button type="submit"> 提交 </button>
        </form>

        <form method="post" enctype="multipart/form-data" action="">
             {{ csrf_field() }}
            <input type="file" name="test"  accept=".csv,.xls,.xlsx">
            <button type="submit"> 提交test </button>
        </form>



        <?php
            foreach (array(1, 2, 3, 4) as $value) {
                echo 'value='.$value.'<br>';
            }
            echo '<br>';
            foreach (array(1, 2, 3, 4) as $key => $value) {
                echo 'key='.$key.' and value='.$value.'<br>';
            }

            $a = array(array(1,2,3),array(4,5,6),array(7,8,9),); 
            foreach($a as $another_arr) //從二維陣列取出一維陣列
            {
                foreach($another_arr as $value) //從一維陣列取出值
                {
                echo $value." ";
                }
                echo "<br>";
            }
        ?>
    </body>
</html>
