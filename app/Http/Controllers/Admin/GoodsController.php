<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Goods;
use App\Http\Requests\GoodsVolidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller
{
    //商品列表
    public function goodsList()
    {
        $columns = ['id', 'name', 'in_money', 'price', 'stock', 'intro',
            'cate_id', 'brand_id', 'status', 'sort', 'updated_at'
        ];
        $collection = Goods::with(['goodsCate','goodsBrand'])->orderby('sort')->paginate(10,$columns);
//        dump($collection);
        return view('admin.product.goods-list',[
            'collection' => $collection,
        ]);
    }

    //添加商品
    public function goodsAdd(Request $request,$id=0)
    {
        $category = Category::with('cateDown')->where('pid',0)->orderby('sort')->get(['id','name']);
        $info = Goods::with('goodsImages')->findorNew($id);

        return view('admin.product.goods-add',[
            'category' => $category,
            'info' => $info,
        ]);
    }
    //添加和编辑商品操作
    public function goodsOperate(GoodsVolidator $request)
    {
        $data = $request->input();
        $goods_images = [];
        if(isset($data['images'])){
            $goods_images = $data['images'];
            unset($data['images']);
        }
        $images = [];
        foreach ($goods_images as $vo) {
            $images[] = [
                'path'  =>  $vo,
            ];
        }
        if ( $data['id'] ) {
            $exits_img = isset($data['img_id']) ? $data['img_id'] : [];
            unset($data['img_id']);
            $goods = Goods::find( $data['id'] );
            //更新数据
            $goods->update($data);
            //删除不存在的图片
            $goods->goodsImages()->whereNotIn('id', $exits_img)->delete();
            $img = $goods->goodsImages()->createMany($images);
        } else {
            $goods = Goods::create($data);
            $img = $goods->goodsImages()->createMany($images);
        }

        if($img===false){
            $response['code'] = -1;
            $response['msg'] = '操作失败';
        } else {
            $response['code'] = 0;
            $response['msg'] = '操作成功';
        }
        return response()->json($response);
    }

    //删除商品操作
    public function goodsDel(Request $request, $id=0)
    {
        $bool = Goods::where('id', $id)->delete();
        if($bool){
            $response['code'] = 0;
            $response['msg'] = '删除成功';
        } else {
            $response['code'] = -1;
            $response['msg'] = '删除失败';
        }
        return response()->json($response);
    }
}
