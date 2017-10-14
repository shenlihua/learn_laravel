/**
 * Created by Administrator on 2017/10/11.
 */
//删除操作
function data_del(obj, url){
    layer.confirm('是否删除该条数据',function(){
        $.post(url,function(result){
            layer.msg(result.msg)
            if(!result.code){
                $(obj).parents('tr').remove()
            }
        })
    })
}

