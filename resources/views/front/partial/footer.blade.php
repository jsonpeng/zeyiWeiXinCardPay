<div class="weui-tabbar">
    <a href="/" class="weui-tabbar__item  {{Request::is ('/') ? 'weui-bar__item_on' : ''}}">
        <img src="{{asset('images/host.png')}}" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="/projects/3/pro" class="weui-tabbar__item {{Request::is ('projects/*/pro') ? 'weui-bar__item_on' : ''}}">
        <img src="{{asset('images/news.png')}}" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">项目展示</p>
    </a>
    <a href="/projects/3/com" class="weui-tabbar__item {{Request::is ('projects/*/com') ? 'weui-bar__item_on' : ''}}">
        <img src="{{asset('images/beifen.png')}}" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">需求展示</p>
    </a>
    <a href="/usercenter" class="weui-tabbar__item {{Request::is ('usercenter/*') || Request::is ('usercenter') || Request::is ('auth/*') ? 'weui-bar__item_on' : ''}}">
        <img src="{{asset('images/me.png')}}" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">个人中心</p>
    </a>
</div>


