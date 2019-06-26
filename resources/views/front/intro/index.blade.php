@extends('front.partial.base')

@section('css')
	<link href="https://cdn.bootcss.com/Swiper/4.0.1/css/swiper.min.css" rel="stylesheet">
@endsection

@section('seo')

@endsection
	
@section('content')
<div class="container">
	<div class="about_title">
        <h3 class="about">
            企业介绍
            <div>ABOUT US</div>
        </h3>
  	</div>
  	<div class="banner">
  		<img src="{{asset('images/banner_intro.jpg')}}" alt="" style="display:block;max-width:100%;height:auto;">
  	</div>
  	<article class="weui-article">
        <section>
            <h3>企业名称</h3>
            <p>
                我们的使命是提供创新、可信赖盈利的互联网解决方案，我们是一家为客户提供有营销效果的互联解决性营销、微信开发、品牌网站建设以及网络营销服务。供创新、可信赖。
            </p>
        </section>
        <section>
            <p>
                我们的使命是提供创新、可信赖盈利的互联网解决方案，我们是一家为客户提供有营销效果的互联解决性营销、微信开发、品牌网站建设以及网络营销服务。供创新、可信赖。
            </p>
        </section>
    </article>
    <div class="about_title">
        <h3 class="about">
            联系我们
            <div>CONTACT US</div>
        </h3>
  	</div>
  	<div id="map">
  	</div>
  	<ul class="contact_intro">
		<li >
			<span style="background:url('{{asset('images/tel.png')}}') no-repeat left center;background-size: 1.05rem 1.05rem;">电话:15912341234</span>
		</li>
		<li >	
			<span style="background:url('{{asset('images/loca.png')}}') no-repeat left center;background-size: 1.05rem 1.05rem;">地点:湖北省武汉市洪山区</span>
		</li>
		<li >
			<span style="background:url('{{asset('images/qq.png')}}') no-repeat left center;background-size: 1.05rem 1.05rem;">QQ:9123456</span>
		</li>
	</ul>
</div>
@endsection

@section('js')
	<script type="text/javascript" src="http://api.map.baidu.com/api?ak=8rLnHDQaTGgjZr1eQe531ttGPCOl8TYF&v=1.0&services=false"></script>
	<script type="text/javascript">
	    //创建和初始化地图函数：
	    function initMap() {
	        createMap();//创建地图
	        setMapEvent();//设置地图事件
	        // addMarker();//向地图中添加marker
	    }

	    //创建地图函数：
	    function createMap() {
	        var map = new BMap.Map("map");//在百度地图容器中创建一个地图
	        var point = new BMap.Point(114.367876,30.53);//定义一个中心点坐标
	        map.centerAndZoom(point, 13);//设定地图的中心点和坐标并将地图显示在地图容器中
	        window.map = map;//将map变量存储在全局
	    }

	    //地图事件设置函数：
	    function setMapEvent() {
	        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
	        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
	        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
	        map.enableKeyboard();//启用键盘上下左右键移动地图
	    }

	    //地图控件添加函数：
	    // function addMapControl() {
	    //     //向地图中添加缩放控件
	    //     var ctrl_nav = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
	    //     map.addControl(ctrl_nav);
	    //     //向地图中添加缩略图控件
	    //     var ctrl_ove = new BMap.OverviewMapControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1 });
	    //     map.addControl(ctrl_ove);
	    //     //向地图中添加比例尺控件
	    //     var ctrl_sca = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
	    //     map.addControl(ctrl_sca);
	    // }

	    //标注点数组
	    var markerArr = [{ title: " 我在珞南街广埠屯社区", content: "附近>",point:"114.367876|30.53", isOpen: 1, icon: { w: 21, h: 26, l: 0, t: 0, x: 6, lb: 5 } }
	    ];
	    //创建marker
	    function addMarker() {
	        for (var i = 0; i < markerArr.length; i++) {
	            var json = markerArr[i];
	            var p0 = json.point.split("|")[0];
	            var p1 = json.point.split("|")[1];
	            var point = new BMap.Point(p0, p1);
	            var iconImg = createIcon(json.icon);
	            var marker = new BMap.Marker(point, { icon: iconImg });
	            var iw = createInfoWindow(i);
	            var label = new BMap.Label(json.title, { "offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20) });
	            marker.setLabel(label);
	            map.addOverlay(marker);
	            label.setStyle({
	                borderColor: "#808080",
	                color: "#333",
	                cursor: "pointer"
	            });

	            (function () {
	                var index = i;
	                var _iw = createInfoWindow(i);
	                var _marker = marker;
	                _marker.addEventListener("click", function () {
	                    this.openInfoWindow(_iw);
	                });
	                _iw.addEventListener("open", function () {
	                    _marker.getLabel().hide();
	                })
	                _iw.addEventListener("close", function () {
	                    _marker.getLabel().show();
	                })
	                label.addEventListener("click", function () {
	                    _marker.openInfoWindow(_iw);
	                })
	                if (!!json.isOpen) {
	                    label.hide();
	                    _marker.openInfoWindow(_iw);
	                }
	            })()
	        }
	    }
	    //创建InfoWindow
	    function createInfoWindow(i) {
	        var json = markerArr[i];
	        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
	        return iw;
	    }
	    //创建一个Icon
	    function createIcon(json) {
	        var icon = new BMap.Icon("http://api.map.baidu.com/img/markers.png", new BMap.Size(json.w, json.h), { imageOffset: new BMap.Size(-json.l, -json.t), infoWindowOffset: new BMap.Size(json.lb + 5, 1), offset: new BMap.Size(json.x, json.h) })
	        return icon;
	    }

	    initMap();//创建和初始化地图
	</script>
@endsection