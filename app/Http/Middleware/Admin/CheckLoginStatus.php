<?php

namespace App\Http\Middleware\Admin;

use Closure;

class CheckLoginStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        echo rawurldecode($request->path());exit;
        //无需验证的操作
        $no_need_action = 'admin/login';
//        dump($request->getMethod());exit;
        //跳过不必验证的连接
        if(
            $request->getMethod()=='GET' &&
            !$request->is($no_need_action) &&
            !$request->session()->has('auth')
        ) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
