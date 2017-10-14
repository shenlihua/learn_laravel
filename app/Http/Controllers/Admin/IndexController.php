<?php
namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginVolidator;
use App\Nodes;

class IndexController extends Controller
{
    //用户登录
    public function login()
    {
        return view('admin.index.login');
    }

    //用户登录操作
    public function loginAction(LoginVolidator $request)
    {
        $data = $request->input();
        $columns = ['id','account','password','name'];
        $info = Admin::where('account',$data['account'])->first($columns);
        if (!empty($info) && $info['password']== encrypted_password($data['password'])) {//登录成功
            $response['code'] = 0;
            $response['msg'] = '登录成功!';
            $response['url'] = route('index');

            session(['auth' => [
                'uid' => $info['id'],
                'name' => $info['name'],
            ]]);
        } else {//登录失败
            $response['code'] = 1;
            $response['msg'] = '用户名或密码不正确!';
        }
        return response()->json($response);
    }

    //后台展示页面
    public function index()
    {
        $columns = ['id','name','route','param','icon'];
        $nodes = Nodes::with('childNodes')
            ->where([
                ['status',1],
                ['pid',0]
            ])
            ->orderBy('sort','asc')
            ->get($columns);
        return view('admin.index.index',[
            'nodes' => $nodes
        ]);
    }

    //
}