@extends('admin.layout-add')
@section('content')
  <div class="Huiform">
    <form action="{{ route('product-brand-operate') }}" method="post" id="form">
      <table class="table table-bg">
        <tbody>
        <tr>
          <th width="100" class="text-r"><span class="c-red">*</span> 品牌名称：</th>
          <td>
              <input type="text" style="width:200px" class="input-text" value="{{ $info['name'] }}" placeholder=""name="name" >
          </td>
        </tr>


        <tr>
          <th class="text-r">品牌logo：</th>
          <td>
              <!--dom结构部分-->
              <div id="uploader-demo">
                  <!--用来存放item-->
                  <div id="filePicker">选择图片</div>
                  <img id="show-image" src="{{ $info['logo']?Illuminate\Support\Facades\Storage::url($info['logo']):'###' }}" width="60px" height="60px"/>
                  <input type="hidden"  name="logo" value="{{ $info['logo'] }}"/>
              </div>
          </td>
        </tr>
        <tr>
          <th class="text-r">排序：</th>
          <td>
              <input type="number" style="width:300px" class="input-text" value="{{ $info['sort']?$info['sort']:100 }}"  name="sort">
          </td>
        </tr>
        <tr>
          <th class="text-r">简介：</th>
          <td><textarea class="input-text" name="describe" style="height:100px;width:300px;">{{$info['describe']}}</textarea></td>
        </tr>
        <tr>
          <th></th>
          <td>
              <input type="hidden" name="id" value="{{ $info['id'] }}"/>
              <button class="btn btn-success radius" type="button" id="submit"><i class="icon-ok"></i> 确定</button>
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css"  href="{{ asset('/admin/lib/webuploader/0.1.5/webuploader.css') }}"/>
    <script type="text/javascript" src="{{ asset('/admin/lib/webuploader/0.1.5/webuploader.html5only.js') }}"></script>
  <script>
      // 初始化Web Uploader
      var layer_load
      var file_path = '{{ asset('storage/')}}'
      var uploader = WebUploader.create({
          // 选完文件后，是否自动上传。
          auto: true,

          fileVal : 'file',
          method: 'POST',
          // 文件接收服务端。
          server: '{{ route('upload-image',['type'=>'brand']) }}',
          // 选择文件的按钮。可选。
          // 内部根据当前运行是创建，可能是input元素，也可能是flash.
          pick: {id:'#filePicker',multiple :false},
      });
      // 文件上传过程中创建进度条实时显示。
      uploader.on( 'uploadProgress', function( file, percentage ) {
          layer_load = layer.load(2, {time: 10*1000});
      });
      uploader.on( 'uploadSuccess', function( file , response) {
          $("#show-image").attr('src',  response['real_path'])
          $("#show-image").next().val( response['path'])
      });

      uploader.on( 'uploadError', function( file ) {
          alert('上传失败')
      });
      //处理完成
      uploader.on( 'uploadComplete', function( file ) {
          layer.close(layer_load);
          console.log(file)
      });
    $(function(){
        $("#submit").click(function(){
            $.ajax({
                url : $("#form").attr('action'),
                type: "POST",
                data : $("#form").serialize(),
                dataType : 'json',
                complete: function (XMLHttpRequest, textStatus) {
                    var responseText = eval('('+XMLHttpRequest.responseText+')')
                    layer.msg(responseText.msg)

                }
            })
        })
    })
  </script>
@endsection