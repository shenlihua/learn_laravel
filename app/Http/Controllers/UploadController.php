<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * 文件上传。
     *
     * @param  Request  $request
     * @return Response
     */
    public function upImage(Request $request,$type='file')
    {
        $path = $request->file('file')->store('public/'.$type);
        $response ['code'] = 0;
        $response ['msg'] = '上传成功';

        if($path === false){
            $response ['code'] = 1;
            $response ['msg'] = '上传失败';
        } else {
            $response ['real_path']  = Storage::url($path);
            $response ['path']  = $path;
        }
        return response()->json($response);
    }
}
