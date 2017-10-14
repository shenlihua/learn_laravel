<aside class="Hui-aside">
	@foreach( $nodes as $vo)
		<div class="menu_dropdown bk_2">
			<dl id="{{ $vo->route }}">
				<dt><i class="Hui-iconfont">&#xe616;</i> {{ $vo->name }}<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
				<dd>
					<ul>
						@foreach($vo->childNodes as $ch)
							<li><a data-href="{{ '/'.$ch->route }}" data-title="资讯管理" href="javascript:void(0)">{{ $ch->name }}</a></li>
						@endforeach
					</ul>
				</dd>
			</dl>
		</div>
	@endforeach
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>