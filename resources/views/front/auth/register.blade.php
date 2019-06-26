@extends('front.partial.base')

@section('css')
    <style>
        body{
            background-color: #f4f2f3;
        }
    </style>
@endsection

@section('seo')

@endsection
	
@section('content')
<form>
    <div id="step1">
        <div class="cen_img">
            <div class="img-box">
                <img src="{{ $user->head_image }}" alt="">
            </div>
        </div>
        <div class="weui-cells weui-cells_form">

            @if(empty($user->mobile))
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" id="name" name="name" placeholder="请输入您的姓名">
                </div>
            </div>
            @endif

            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" id="tel" name="mobile"  maxlength="11" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入手机号" >
                </div>
            </div>
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label">验证码</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" name="code" pattern="[0-9]*" placeholder="请输入验证码" id="code"/>
                </div>
                <div class="weui-cell__ft">
                    <button class="weui-vcode-btn" id="getcode" onclick="sendCode()">获取验证码</button>
                </div>
            </div>
        </div>
        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary"  type="button" onclick="submit_tel()">确定</button>
        </div>
    </div>
</form>
@endsection

@section('js')
	<script type="text/javascript">
        
		 function sendCode() {
		 	console.log('send');
              if ($("#tel").val() == '') {
                layer.open({
                    content: '请输入手机号'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false; 
            }

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/sendCode',
                type: 'GET',
                data: {mobile: $('#tel').val()},
            });

            time();
        }

        function submit_tel() {
            console.log('code:'+$("#code").val());
            console.log('tel:'+$("#tel").val());
            console.log('name:'+$("#name").val());

            if ($("#code").val() == '' ||  $("#code").val().length != 4) {
                layer.open({
                content: '请输入有效验证码！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
                return false; 
            }
           if ($("#name").val() == '' ||  $("#tel").val() == '') {
                layer.open({
                    content: '请输入完整信息！'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false; 
            }
            //event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/post_mobile',
                type: 'POST',
                data:$("form").serialize(),
                success: function(data) {
                    //提示成功消息
                    if (data.code == 0) {
                    	layer.open({
                            content: '绑定成功！'
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                    
                    
                    	location.href = "/usercenter";
                    
                   
                    } else {
                       layer.open({
                            content: '手机或验证码不正确！'
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                        
                    }                   
                },
            });
        }

        var wait=60;
        function time(){
            o = $('#getcode');
            if (wait == 0) {
                o.removeAttr("disabled");   
                o.text("获取验证码");
                wait = 60;
            } else { 

                o.attr("disabled", true);
                o.text("重新发送(" + wait + ")");
                wait--;
                setTimeout(function() {
                    time()
                }, 1000)
            }
        }
	</script>
@endsection