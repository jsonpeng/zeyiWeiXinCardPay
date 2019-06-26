<header class='head_nav_met_16_3 met-head navbar-fixed-top' m-id='11' m-type='head_nav'>
	<div id="header" class="header-fixed" >
		<div class="container">
			<ul class="head-list p-l-0">
				<li class="left tel">
					<img src="{{asset('images/1517470616.jpg')}}" alt="">
					<span>您好，欢迎您访问信息科技有限公司官方网站，信息科技值得您信赖!</span>
					<em></em>
				</li>
				<li class="right">
					<ul>
						<li>
							<img src="{{asset('images/1517470364.png')}}">
							<span>全国服务热线：027-87550409</span>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<nav class="navbar navbar-default box-shadow-none head_nav_met_16_3">
		<div class="container">
			<div class="row">
				<div class="navbar-header pull-xs-left">
					<a href="/" class="met-logo vertical-align block pull-xs-left p-y-5" >
						<div class="vertical-align-middle">
						<img src="{{asset('images/logo-black.png')}}"></div>
					</a>
				</div>
				<!-- logo -->
				<button type="button" class="navbar-toggler hamburger hamburger-close collapsed p-x-5 head_nav_met_16_3-toggler" data-target="#head_nav_met_16_3-collapse" data-toggle="collapse">
				<span class="sr-only"></span>
				<span class="hamburger-bar"></span>
				</button>
				<!-- 导航 -->
				<div class="collapse navbar-collapse navbar-collapse-toolbar pull-md-right p-0" id="head_nav_met_16_3-collapse">
					<ul class="nav navbar-nav navlist">
						<li class='nav-item'>
							<a href="/" title="网站首页" class="nav-link
								{{Request::is('/') ? 'active' : ''}}
							">网站首页</a>
						</li>
						<li class="nav-item dropdown m-l-0">
							<a
								href="/page/intro"
								target='_self' title="关于我们"
								class="nav-link dropdown-toggle {{Request::is('page/intro') ? 'active' : ''}}"
								data-toggle="dropdown" data-hover="dropdown"
								>
							关于我们</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-bullet two-menu">
								<a href="/page/intro" target='_self' title="公司简介" class='dropdown-item hassub '>公司简介</a>
								<a href="/page/zuzhijiegou" target='_self' title="组织架构" class='dropdown-item hassub '>组织架构</a>
								<a href="/page/culture" target='_self' title="企业文化" class='dropdown-item hassub '>企业文化</a>
								<a href="/page/contact" target='_self' title="联系我们" class='dropdown-item hassub '>联系我们</a>
							</div>
						</li>
						<li class='nav-item m-l-0'>
							<a href="/cat/product" target='_self' title="产品&解决方案" class="nav-link {{Request::is('cat/product') ? 'active' : ''}}">产品&解决方案</a>
						</li>
						<li class="nav-item dropdown m-l-0">
							<a
								target='_self' title="服务与支持"
								class="nav-link dropdown-toggle"
								data-toggle="dropdown" data-hover="dropdown"
								>
							服务与支持</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-bullet two-menu">
								<a href="/cat/service" target='_self' title="使用帮助" class='dropdown-item hassub '>使用帮助</a>
								<a href="/cat/download" target='_self' title="下载中心" class='dropdown-item hassub '>下载中心</a>
							</div>
						</li>
						<li class='nav-item m-l-0'>
							<a href="/cat/case" target='_self' title="客户案例" class="nav-link {{Request::is('cat/case') ? 'active' : ''}}">客户案例</a>
						</li>
						<li class="nav-item dropdown m-l-0">
							<a
								href="/cat/news"
								target='_self'  title="新闻资讯"
								class="nav-link dropdown-toggle {{Request::is('cat/news') ? 'active' : ''}}"
								data-toggle="dropdown" data-hover="dropdown"
								>
							新闻资讯</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-bullet two-menu">
								<a href="/cat/news" target='_self' title="公司新闻" class='dropdown-item hassub '>公司新闻</a>
								<a href="/cat/news" target='_self' title="行业资讯" class='dropdown-item hassub '>行业资讯</a>
								<a href="/cat/news" target='_self' title="媒体报道" class='dropdown-item hassub '>媒体报道</a>
							</div>
						</li>
						<li class='nav-item m-l-0'>
							<a href="/page/contact" target='_self' title="联系我们" class="nav-link {{Request::is('page/contact') ? 'active' : ''}}">联系我们</a>
						</li>
					</ul>
				</div>
				<!-- 导航 -->
			</div>
		</div>
	</nav>
</header>