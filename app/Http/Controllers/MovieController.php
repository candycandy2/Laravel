<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

//candy 20180724
class MovieController extends Controller//add
{
    public function showMovie() {
        //return '@電影controller'. $id;
        return 'movie';
        /*$movies= DB::select('SELECT * FROM ');
    print_r($movies);
    return View::make('movies.index')->with('movies,$movies');
     */
    }

    public function showTab() {
        $movies = \DB::select('select * from movie');
        var_dump($movies);
    }

    public function import() {

        $filePath = 'excel.xlsx'; // method1
        //'storage/exports/'.iconv('UTF-8', 'GBK', '学生成绩').'.xls';
        Excel::load($filePath, function ($reader) {
            //method1
            // $reader->dump();
            //method2
            //$data = $reader->all();
            //dd($data);
            //method3
            $data = $reader->toArray();
            dd($data);
        });
    }

    public function import2($path) {
        $filePath = $path;
        // $filePath = 'excel.xlsx';  // method1
        //'storage/exports/'.iconv('UTF-8', 'GBK', '学生成绩').'.xls';
        Excel::load($filePath, function ($reader) {
            //method1
            // $reader->dump();
            //method2
            //$data = $reader->all();
            //dd($data);
            //method3
            $data = $reader->toArray();
            //  dd("1import2+"$data);

            $this->originalFile($data); //test 　20180727
        });
    }

    public function originalFile($a) {
        // $a = array(array(1, 2, 3), array(4, 8, 6), array(7, 8, 9));
        dd($a);

        // $this->curlGetData();
        //[Test 1]
        /*
        $a = array(
        "number" => 1.0,
        "name" => "AA",
        "score" => 100.0,
        "test" => 1.0,
        );

        foreach ($a as $vals) {
        echo $vals;
        echo "//77測試<br>";
        }
         */

//[Test 2]
      
        foreach ($a as $another_arr) //從二維陣列取出一維陣列
        {   //echo "<br>2 dime ".$another_arr;
        foreach ($another_arr as $value) //從一維陣列取出值
        {echo "<br>";
             echo $value;
        //echo $value['name'];
        }
        echo "<br>";
        }
       
//[Test 3 要換excel檔]
/*
        foreach ($a as $k => $val) {
           // echo"NAME:";
           echo $val['name']."<br>";
           // echo"-----";

           //  echo"-----";
        }
*/
        /*

        foreach ($data as $vals) {
        echo "A: $vals[0]; B: $vals[1]\n";
        }
         */

        //$valuedata = $value;
        //     echo  $valuedata;
        // dd($data);//show

    }

/*
public function iconUpload()
{
//view("helloworld");

$file = Input::file('excel.xlsx');
//        $extension = $file->getClientOriginalExtension();
$name = Input::file('excel.xlsx')->getClientOriginalName();
//        $file_name = strval(time()).str_random(5).'.'.$extension;

$destination_path = public_path().'/user-upload/';

if (Input::hasFile('user_icon_file')) {
$upload_success = $file->move($destination_path, $file_name);
echo "img upload success!";
} else {
echo "img upload failed!";
}

$user_obj = Auth::user();
$user_obj->user_icon = $file_name;
$user_obj->save();

return view("helloworld");
}
 */

    public function curlGetData() {

        $this->Datainsert();

        echo "testcurl==============";
        //        [CURL]
        /*
        $ch = curl_init("https://tw.yahoo.com/");

        $ch = curl_init("https://laravel.com/docs/5.2/responses");

        // print_r(curl_getinfo($ch));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch); //跑不動? 20180730

        curl_close($ch);
        //phpinfo();
         */

        /*
        $file = fopen("out.html", 'w'); //開啟檔案
        fwrite($file, $output); //寫入檔案
        fclose($file);
         */
/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://www.lorempixel.com/");
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec($ch);

curl_close($ch);

echo $output; //輸出傳回值
echo "testcurl==============";
 */
        $url = "http://www.lorempixel.com/";
        $curlPing = curl_init($url);
        curl_setopt($curlPing, CURLOPT_TIMEOUT, 0);
        curl_setopt($curlPing, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curlPing, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curlPing);
     //   \Debugbar::info(curl_getinfo($curlPing));
        print_r(curl_getinfo($curlPing));
        $httpCode = curl_getinfo($curlPing, CURLINFO_HTTP_CODE);
        echo $httpCode;
        echo "testcurl==============";

        if (curl_errno($curlPing)) {
            echo 'Curl error: ' . curl_error($curlPing);
        }
        curl_close($curlPing);
        return view("helloworld");
    }

    public function upload(Request $request) {

        if ($request->isMethod('post')) {
            $file = $request->file('doc');

            if (Input::hasFile('doc') != true) {
                //Flash::error('Banner not provided');
                //alert('上传失败，请重试！');
                return view('welcome');

            } else if (Input::hasFile('doc') == true) {
                // 文件是否上传成功
                if ($file->isValid()) {
                    echo ("<br>got file<br>");
                    // 获取文件相关信息
                    $originalName = $file->getClientOriginalName(); // 文件原名
                    echo ($originalName);

                    $ext = $file->getClientOriginalExtension(); // 扩展名 副檔名
                    $realPath = $file->getRealPath(); //临时文件的绝对路径
                    echo ($realPath);
                    $type = $file->getClientMimeType(); // image/jpeg

                    // 上传文件
                    $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                    // echo ("<br>20180731<br>".file_get_contents($realPath) );
                    //亂碼
                    //PHP 使用 file_get_contents 接收 POST 的資料
                    echo ($realPath . $originalName . $ext); //

                    $this->import2($realPath); //open 20180730
                    // $this->originalFile($data);
                    // var_dump("這".$bool);
                }
            }
        }
        return view("helloworld");
    }

    public function index() {
        return view("helloworld");
    }

    public function showUploadFile(Request $request) {
        $file = $request->file('test');

        echo ("1.This" . $file);
        var_dump($file);
        //D:\INSTALL\tmp\phpC3FF.tmpFile Name: person.xlsx
        //Display File Name
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: ' . $file->getMimeType();

        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
        return view("helloworld");
    }

    public function Datainsert() {
        \DB::table('movie')->insert(
            ['title' => 'Ironman', 'value' => 2, 'price' => 5000]
        );
    }

}
