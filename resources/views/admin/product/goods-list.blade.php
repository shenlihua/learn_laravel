@extends('admin.layout')

@section('c-gray')
	<span class="c-gray en">&gt;</span> 产品管理
	<span class="c-gray en">&gt;</span> 商品列表
@endsection

@section('content')

	<div class="cl pd-5 bg-1 bk-gray mt-10">
		<span>
			<a href="javascript:;" onclick="layer_show_full('添加商品','{{ route('goods-add') }}')" class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 添加商品
			</a>
		</span>

	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
			<tr class="text-c">
				<th width="30">序号</th>
				<th width="120">商品名称</th>
				<th width="70">分类</th>
				<th width="70">品牌</th>
				<th width="50">进价</th>
				<th width="50">售价</th>
				<th width="50">库存</th>
				<th width="80">状态</th>
				<th width="80">排序</th>
				<th width="120">操作时间</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			@foreach($collection as $key=>$item)
				<tr class="text-c">
					<td>{{ $key+1 }}</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->goodsCate ? $item->goodsCate->name : '' }}</td>
					<td>{{ $item->goodsBrand ? $item->goodsBrand->name : '' }}</td>
					<td>{{ $item->in_money }}</td>
					<td>{{ $item->price }}</td>
					<td>{{ $item->stock }}</td>
					<td>{{ $item->status }}</td>
					<td>{{ $item->sort }}</td>
					<td>{{ $item->updated_at }}</td>
					<td class="f-14 product-brand-manage">
						<a style="text-decoration:none" onClick="layer_show_full('编辑商品','{{ route('goods-add',['id'=>$item->id]) }}')" href="javascript:;" title="编辑">
							编辑
						</a>
						<a style="text-decoration:none" class="ml-5" onClick="data_del(this, '{{ route('goods-del',['id'=>$item->id]) }}')" href="javascript:;" title="删除">
							删除
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>

@endsection

@section('script')

@endsection