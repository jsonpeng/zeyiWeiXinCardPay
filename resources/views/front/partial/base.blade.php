
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<html class="no-js" style="font-size: 40px;">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{!! getSettingValueByKeyCache('name') !!}</title>
        @yield('seo')
        <link rel="shortcut icon" href="{!! getSettingValueByKeyCache('logo') !!}">
        <script type="text/javascript">
            if (/Android (\d+\.\d+)/.test(navigator.userAgent)) {
                var version = parseFloat(RegExp.$1);
                if (version > 2.3) {
                    var phoneScale = parseInt(window.screen.width) / 640;
                    document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi, user-scalable=no">');
                } else {
                    document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
                }
            } else {
                document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
            }
         
            window.alert = function(name){
            var iframe = document.createElement("IFRAME");
            iframe.style.display="none";
            iframe.setAttribute("src", 'data:text/plain,');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
            }

            //alert('xxx');
        </script>

        <link rel="stylesheet" href="{{asset('css/weui.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
   
        <script type="text/javascript" src="{{ asset('vendor/bootcss/js/jquery.min.js') }}"></script>
        @yield('css')
        
    </head>
    <body >
        
        @yield('content')
        
        @if(!(Request::is('*/create') || Request::is('*/edit') || Request::is('*/company_detail') || Request::is('*/memberLevelup') || Request::is('*/member'))) 
            @include('front.partial.footer')
        @endif 

        <script>
            $(document).ready(function() {

                var src=$('.weui-bar__item_on img').attr('src');
                if(src==undefined){
                    return false;
                }
                else{
                    var a=src.lastIndexOf('/')+1;
                    var b=src.slice(a, src.length);
                   
                    src=src.replace(b,'light_'+b);
                    $('.weui-bar__item_on img').attr('src',src);
                }
                
            });
        </script>
     
        <script type="text/javascript" src="{{ asset('vendor/bootcss/js/jquery-weui.min.js') }}"></script>
        <!--前端页数分配-->
        <script type="text/javascript">
        var front_take='{!! getFrontDefaultPage() !!}';
        //获取图片方向
        function getPhotoOrientation(img) {
             var orient;
             EXIF.getData(img, function () {
                   orient = EXIF.getTag(this, 'Orientation');
             });
             return orient;
        }
        </script>
        
        <!--无限滚动加载-->
        <script src="{{ asset('vendor/jquery.endless-scroll-1.3.js') }}"></script>

        <!--图片上传-->
        <script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>

        @yield('js')
        
        <script src="{{asset('js/nowrap.js')}}"></script>
  
        <!--  layui   -->
        {{-- <!-- <script src="{{ asset('vendor/layui/layui.js') }}"></script> --> --}}
        <script src="{{ asset('vendor/layer/mobile/layer.js') }}"></script>
        <!-- 图片缓加载 -->
        <script src="{{ asset('vendor/jquery.lazyload.js') }}"></script>
        
        <!-- ajax操作 -->
        <script src="{{ asset('js/ajax.js') }}"></script>
        <script>
            $("img.lazy").lazyload({effect: "fadeIn"});
        </script>

    </body>
</html>
