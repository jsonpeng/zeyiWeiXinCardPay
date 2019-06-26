@section('js')
<script src="{{ asset('js/select.js') }}"></script>
<script src="{{ asset('js/exif.js') }}"></script>
<script type="text/javascript">
	var types='project_images';
	//提交
	$('.submit_btn').click(function(e) {
		/* Act on the event */
		//项目名称
		
		var name=$('input[name=name]').val();
		var tel=$('input[name=mobile]').val();
		var price=$('input[name=money]').val();
		var form_attr=$(this).data('formattr');
		var redirect_url=$(this).data('redirecturl');
		var url=$(this).data('url');
		console.log(tel.length);
		if(name=='' || name==null){
			layer.open({
			    content: '请填写项目名称'
			    ,skin: 'msg'
			    ,time: 2 //2秒后自动关闭
			});
	        return false;
		}
		console.log(tel);
		
		if(tel.length!=11){
			layer.open({
			    content: '手机号码长度有误'
			    ,skin: 'msg'
			    ,time: 2 //2秒后自动关闭
			 });
	        return false;
		}
		
		if(price==null || price==''){
			layer.open({
			    content: '请填写项目金额'
			    ,skin: 'msg'
			    ,time: 2 //2秒后自动关闭
			 });
	        return false;
		}
		var info=$('.weui-textarea').val();
		if(info==null || info==''){
			layer.open({
			    content: '请填写项目信息'
			    ,skin: 'msg'
			    ,time: 2 //2秒后自动关闭
			 });
	        return false;
		}
		/*传了图片
		if($('.uploads_box').length>0){
		var _status=false;
		 $('.uploads_box').each(function(){
		 	var status=$(this).find('.zhezhao').data('status');
		 	if(status=='none'){
		 		alert('图片还在上传中,请在等等');
		 		_status=true
		 		return false;
		 	}
		 });

		 if(_status){
		 	return false;
		 }
		 
		}
		*/
		$('.shade').css('display', 'block');
		     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                type:"GET",
                data:$("#form_"+form_attr).serialize(),
                success: function(data) {
                  if (data.code == 0) {
	                    layer.open({
						    content: data.message
						    ,skin: 'msg'
						    ,time: 2 //2秒后自动关闭
						 });
                      $('.shade').css('display', 'none');
                    setTimeout(function(){
                        location.href=redirect_url;
                    },500); 
                  }else{
                  	$('.shade').css('display', 'none');
                      layer.open({
					    content: data.message
					    ,skin: 'msg'
					    ,time: 2 //2秒后自动关闭
					 });
                    //layer.msg(data.message, {icon: 5});
                  }
                },
            }); 
	});

	  //统计字数
	  $(".weui-textarea").on('blur keyup input',function(){  
            var text=$(this).val();  
            var counter=text.length;  
            $(this).parent().find('span').text(counter);  
        });  

</script>
<script src="{{ asset('js/uploads.js') }}"></script>
@endsection