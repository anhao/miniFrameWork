<?php

class upload extends Base
{
    public function index()
    {
        $data = [];
        FrameWork::view('upload', $data);
    }

    public function up()
    {
        $file = $_FILES['file'];
        $name = $file['name'];//文件名
        $error=$file['error'];//文件错误码
        $size = $file['size'];//文件大小
        $tmp_name = $file['tmp_name'];//临时文件
        $max_file_size=10*1024*1024;//最大文件大小
        $path = 'static/upload/';
        $type=$file['type'];
        $uptype = [
            'image/png',
            'imgage/jpg',
            'image/jpeg',
            'image/gif'
        ];
        //检查删除目录是否存在
        if(!is_dir($path)){
            mkdir($path,0775,true);
        }
        //检查临时文件是否存在
        if(!is_uploaded_file($tmp_name)){
            exit(json(['code'=>1,'msg'=>'文件不存在']));
        }
        //j检查文件大小
        if($size>$max_file_size){
            exit(json(['code'=>'1','msg'=>'文件太大']));
        }
        //检查文件类型
        if(!in_array($type,$uptype)){
            exit(json(['code'=>1,'msg'=>'文件类型错误']));
        }
        if(file_exists($path.$name)){
            exit(json(['code'=>'1','msg'=>'文件已存在']));
        }
        if($error==0){
            //iconv 处理编码 将utf8 转换成gbk
            if(move_uploaded_file($tmp_name,iconv('utf-8','gbk',$path.$name))){
                exit(json(['code'=>0,'msg'=>'上传成功','data'=>'/'.$path.$name]));
            }else{
                exit(json(['code'=>1,'msg'=>'上传失败']));
            }
        }else{
            exit(json(['code'=>0,'msg'=>'上传失败','data'=>$file]));
        }
    }

}

?>