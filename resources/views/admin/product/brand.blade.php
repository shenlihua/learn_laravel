@extends('admin.layout')

@section('c-gray')
	<span class="c-gray en">&gt;</span> 产品管理
	<span class="c-gray en">&gt;</span> 品牌管理
@endsection

@section('content')

	<div class="cl pd-5 bg-1 bk-gray mt-10">
		<span>
			<a href="javascript:;" onclick="layer_show('添加品牌','{{ route('product-brand-add') }}')" class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 添加品牌
			</a>
		</span>

	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
			<tr class="text-c">
				<th width="70">序号</th>
				<th width="200">LOGO</th>
				<th width="120">品牌名称</th>
				<th>排序</th>
				<th>操作时间</th>
				<th width="100">操作</th>
			</tr>
			</thead>
			<tbody>
			@foreach($collection as $key=>$item)
				<tr class="text-c">
					<td>{{ $key+1 }}</td>
					<td><img src="{{ Storage::url($item->logo) }}" width="50px" height="50px"></td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->sort }}</td>
					<td>{{ $item->updated_at }}</td>
					<td class="f-14 product-brand-manage">
						<a style="text-decoration:none" onClick="layer_show('编辑品牌','{{ route('product-brand-add',['id'=>$item->id]) }}')" href="javascript:;" title="编辑">
							编辑
						</a>
						<a style="text-decoration:none" class="ml-5" onClick="data_del(this, '{{ route('product-brand-del',['id'=>$item->id]) }}')" href="javascript:;" title="删除">
							删除
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ $collection->links() }}
	</div>

@endsection

@section('script')

@endsection