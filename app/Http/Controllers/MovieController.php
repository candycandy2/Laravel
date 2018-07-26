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

        $filePath = 'excel.xlsx';  // method1
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
            dd($data);
        });
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

    public function upload(Request $request) {

        if ($request->isMethod('post')) {
            $file = $request->file('test');

            if (Input::hasFile('test') != true) {
                //Flash::error('Banner not provided');
                //alert('上传失败，请重试！');
                return view('welcome');

            } else if (Input::hasFile('test') == true) {
                // 文件是否上传成功
                if ($file->isValid()) {
                    echo ("got file");
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
                    //Storage::copy('', 'new/file1.jpg');
                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                    //PHP 使用 file_get_contents 接收 POST 的資料
                    echo ($realPath.$originalName.$ext );  //
                   // $this->import2($realPath);
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

        echo ("1.This".$file);
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

}
