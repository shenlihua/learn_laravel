<?php

namespace App\Http\Controllers\admin;

use App\Brand;
use App\Category;
use App\Http\Requests\BrandVolidator;
use App\Http\Requests\categoryVolidator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //品牌---显示列表
    public function brand(Request $request)
    {
        $columns = ['id', 'name', 'logo', 'describe','sort', 'updated_at'];
        $collection = Brand::orderby('sort')->paginate(10,$columns);

        return view('admin.product.brand', [
            'collection' => $collection,
        ]);
    }
    //品牌---添加编辑操作
    public function brandAdd(Request $request, $id=0)
    {
        $columns = ['id', 'name', 'logo', 'describe','sort', 'updated_at'];
        $info = Brand::findorNew($id, $columns);
        return view('admin.product.brand-add',[
            'info'=>$info
        ]);
    }

    //品牌---编辑数据库操作
    public function brandOperate(BrandVolidator $request)
    {
        $data = $request->input();
        $id = $data['id'];
        unset($data['id']);
        if($id) {
            $brand = Brand::where('id', $id)->update($data);
        } else {
            $brand = Brand::create($data);
        }

        if ($brand!==false) {
            $response['code'] = 0;
            $response['msg']= '操作成功!';
        } else {
            $response['code'] = -1;
            $response['msg']= '操作失败!';
        }
        return response()->json($response);
    }

    //品牌---删除操作
    public function brandDel(Request $request,$id=0)
    {
        $del = Brand::where('id', $id)->delete();
        if ( $del ) {
            $response['code'] = 0;
            $response['msg'] = '删除成功!';
        } else {
            $response['code'] = 0;
            $response['msg'] = '删除失败!';
        }
        return response()->json($response);
    }

    //分类---显示列表
    public function category(Request $request)
    {
        $columns = ['id', 'name', 'logo', 'describe','sort', 'updated_at'];
        $collection = Category::withCount('cateDown')->where('pid',0)->orderby('sort')->paginate(10,$columns);
        return view('admin.product.category', [
            'collection' => $collection,
        ]);
    }
    //分类---显示下级列表
    public function categoryDownList(Request $request, $id=0)
    {
        $parent_name = Category::where('id',$id)->value('name');
        $columns = ['id', 'name', 'logo', 'describe','sort', 'updated_at'];
        $collection = Category::orderby('sort')->where('pid',$id)->paginate(10,$columns);

        return view('admin.product.category-down-list', [
            'collection' => $collection,
            'parent_name' => $parent_name,
        ]);
    }

    //分类---添加编辑操作
    public function categoryAdd(Request $request, $id=0)
    {
        //获取一级分类
        $category = Category::where('pid',0)->get(['id', 'name']);

        $columns = ['id', 'pid', 'name', 'logo', 'describe','sort', 'updated_at'];
        $info = category::findorNew($id, $columns);
        return view('admin.product.category-add',[
            'info'=>$info,
            'category'=>$category,
        ]);
    }

    //分类---编辑数据库操作
    public function categoryOperate(categoryVolidator $request)
    {
        $data = $request->input();
        $id = $data['id'];
        unset($data['id']);
        if($id) {
            $category = Category::where('id', $id)->update($data);
        } else {
            $category = category::create($data);
        }

        if ($category!==false) {
            $response['code'] = 0;
            $response['msg']= '操作成功!';
        } else {
            $response['code'] = -1;
            $response['msg']= '操作失败!';
        }
        return response()->json($response);
    }

    //分类---删除操作
    public function categoryDel(Request $request,$id=0)
    {
        $del = category::where('id', $id)->delete();
        if ( $del ) {
            $response['code'] = 0;
            $response['msg'] = '删除成功!';
        } else {
            $response['code'] = 0;
            $response['msg'] = '删除失败!';
        }
        return response()->json($response);
    }


}
