@extends('admin.layout-add')
@section('content')
    <div class="page-container">
        <form action="{{ route('goods-operate') }}" method="post" class="form form-horizontal" id="form">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品分类：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select class="select" name="cate_id" style="width: 200px;">
                        <option value="0">--请选择分类--</option>
                        @foreach($category as $vo)
                            <option value="{{ $vo['id'] }}" {{ $info['cate_id']==$vo['id']?'selected':'' }}>{{ $vo['name'] }}</option>
                            @foreach($vo['cateDown'] as $ch)
                                <option value="{{ $ch['id'] }}" {{ $info['cate_id']==$ch['id']?'selected':'' }}>&nbsp;&nbsp;{{ $ch['name'] }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$info['intro']}}" placeholder="" id="" name="name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简略标题：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea class="input-text" name="intro" style="height:100px;width:300px;" maxlength="200">{{$info['intro']}}</textarea>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>进价：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="number" style="width:200px" class="input-text" value="{{ $info['in_money'] }}" placeholder=""name="in_money" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>售价：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="number" style="width:200px" class="input-text" value="{{ $info['price'] }}" placeholder=""name="price" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">库存：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="number" style="width:200px" class="input-text" value="{{ $info['stock']?$info['stock']:0 }}" placeholder=""name="stock" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">图片上传：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="test2">多图片上传</button>
                        <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                            预览图：
                            <div class="layui-upload-list" id="demo2">
                                @foreach($info->goodsImages as $img)
                                <div class="layui-upload-block">
                                    <p class="layui-upload-del">X</p>
                                    <img src="{{ Storage::url($img->path) }}"  class="layui-upload-img">
                                    <input type="hidden" name="img_id[]" value="{{ $img->id }}"/>
                                </div>
                                @endforeach
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"></script>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <input type="hidden" name="id" value="{{ $info['id'] }}"/>
                    <button class="btn btn-primary radius" id="submit" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <style>
        .layui-upload-block {display: inline-block}
        .layui-upload-block .layui-upload-del {    position: absolute;width: 20px;height: 20px;background: red;text-align: center;color: white;cursor: pointer;}
        .layui-upload-img{width: 92px; height: 92px; margin: 0 10px 10px 0;}
    </style>
    <script type="text/javascript" src="{{ asset('/admin/lib/layui-v2.1.5/layui/layui.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin/lib/layui-v2.1.5/layui/css/layui.css') }}" />
    <script type="text/javascript" src="{{ asset('/admin/lib/ueditor/1.4.3/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/lib/ueditor/1.4.3/ueditor.all.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js') }}"></script>
  <script>
      //文件上传路径
      var server_route = '{{ route('upload-image',['type'=>'goods']) }}';

      var ue = UE.getEditor('editor',{
          toolbars: [
            ['fullscreen', 'source', 'undo', 'redo', 'bold', 'justifyleft', 'justifyright', 'justifycenter', 'justifyjustify', 'simpleupload', 'insertimage'],
            ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
          ],
      });
      var layer_load;
      layui.use('upload', function(){
          var upload = layui.upload;
          //多图片上传
          upload.render({
              elem: '#test2'
              ,url: server_route
              ,multiple: true
              ,before: function(obj){
                  //加载暑假
                  layer_load = layer.load(2, {time: 10*1000});
              }
              ,done: function(res, index, upload){
                  layer.close(layer_load)
                  //上传完毕
                  var upload_html = '<div class="layui-upload-block">'+
                      '<p class="layui-upload-del">X</p>'+
                      '<img src="'+ res.real_path +'"  class="layui-upload-img">'+
                      '<input type="hidden" name="images[]" value="'+ res.path +'"/>'+
                      '</div>'
                  $('#demo2').append(upload_html)
              }
          });
      });

      $(function(){
          $("form").on('click','.layui-upload-del',function(){
              $(this).parent().remove()
          })
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