<li class="{{ Request::is('zcjy/settings/setting*') ? 'active' : '' }}">
    <a href="{!! route('settings.setting') !!}"><i class="fa fa-edit"></i><span>网站设置</span></a>
</li>
<li class="{{ Request::is('zcjy/wechat/menu*') || Request::is('zcjy/wechat/reply*') ? 'active' : '' }}">
    <a href="{!! route('wechat.menu') !!}"><i class="fa fa-edit"></i><span>微信设置</span></a>
</li>
<li class="{{ Request::is('zcjy/banners*') || Request::is('zcjy/*/bannerItems') ? 'active' : '' }}">
    <a href="{!! route('banners.index') !!}"><i class="fa fa-object-group"></i><span>横幅</span></a>
</li>

<li class="treeview @if(Request::is('zcjy/userLevels*') || Request::is('zcjy/users*')) active @endif " >
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>会员管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('zcjy/userLevels*') && !Request::get('is_delete') == true ? 'active' : '' }}">
            <a href="{!! route('userLevels.index') !!}"><i class="fa fa-edit"></i><span>会员</span></a>
        </li>

        <li class="{{ Request::get('is_delete') == true ? 'active' : '' }}">
            <a href="{!! route('userLevels.index').'?is_delete=true' !!}"><i class="fa fa-edit"></i><span>恢复会员</span></a>
        </li>

        <li class="{{ Request::is('zcjy/users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>用户</span></a>
        </li>
    </ul>
</li>

<li class="{{ Request::is('zcjy/industries*') ? 'active' : '' }}">
    <a href="{!! route('industries.index') !!}"><i class="fa fa-edit"></i><span>行业类型</span></a>
</li><li class="{{ Request::is('zcjy/projects*') ? 'active' : '' }}">
    <a href="{!! route('projects.index') !!}"><i class="fa fa-edit"></i><span>项目管理</span></a>
</li>

<li class="treeview @if(Request::is('zcjy/categories*') || Request::is('zcjy/posts*') || Request::is('zcjy/customPostTypes') || Request::is('zcjy/*/customPostTypeItems*')) active @endif " >
	<a href="#">
		<i class="fa fa-pie-chart"></i>
		<span>文章管理</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('zcjy/categories*') ? 'active' : '' }}">
		    <a href="{!! route('categories.index') !!}"><i class="fa fa-bars"></i><span>分类</span></a>
		</li>

		<li class="{{ Request::is('zcjy/posts*') ? 'active' : '' }}">
		    <a href="{!! route('posts.index') !!}"><i class="fa fa-newspaper-o"></i><span>文章</span></a>
		</li>

		</li><li class="{{ Request::is('zcjy/customPostTypes*') || Request::is('zcjy/*/customPostTypeItems*') ? 'active' : '' }}">
		    <a href="{!! route('customPostTypes.index') !!}"><i class="fa fa-calendar-plus-o"></i><span>自定义文章类型</span></a>
		</li>

	</ul>
</li>

<li class="treeview @if(Request::is('zcjy/pages*') || Request::is('zcjy/customPageTypes*') ||  Request::is('zcjy/*/pageItems*')) active @endif">
    <a href="#">
        <i class="fa fa-newspaper-o"></i>
        <span>页面管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('zcjy/pages*') ? 'active' : '' }}">
            <a href="{!! route('pages.index') !!}"><i class="fa fa-newspaper-o"></i><span>页面</span></a>
        </li>
        <li class="{{ Request::is('zcjy/customPageTypes*') ||  Request::is('zcjy/*/pageItems*')  ? 'active' : '' }}">
            <a href="{!! route('customPageTypes.index') !!}"><i class="fa fa-calendar-plus-o"></i><span>自定义页面类型</span></a>
        </li>
    </ul>
</li>


<li class="{{ Request::is('zcjy/cities*') || Request::is('zcjy/freightTems*') ? 'active' : '' }}">
            <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i><span>城市设置</span></a>
</li>

<li class="{{ Request::is('zcjy/caompanies*') ? 'active' : '' }}">
    <a href="{!! route('caompanies.index') !!}"><i class="fa fa-edit"></i><span>企业管理</span></a>
</li>

<li class="{{ Request::is('zcjy/orders*') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-edit"></i><span>订单</span></a>
</li>

<li class="{{ Request::is('zcjy/companyErrors*') ? 'active' : '' }}">
    <a href="{!! route('companyErrors.index') !!}"><i class="fa fa-edit"></i><span>企业纠错列表</span></a>
</li>

<li class="">
    <a href="javascript:;" id="refresh"><i class="fa fa-refresh"></i><span>清理缓存</span></a>
</li>