@extends('admin.layouts.default')

@section('left_menu')
<div class="nav_icons">
    <ul class="sidebar_threeicons">
        <li>
            <a href="/admin">
                <i class="livicon" data-name="home" title="Home" data-loop="true" data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="livicon" data-name="users" title="Page Builder" data-loop="true" data-color="#37bc9b" data-hc="#37bc9b" data-s="25"></i>
            </a>
        </li>
        <li>
            <a href="/maintenance/employee">
                <i class="livicon" data-name="gears" title="Employee Maintenance" data-loop="true" data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
            </a>
        </li>
        <li>
            <a href="/">
                <i class="livicon" data-name="sign-out" title="Sign out" data-loop="true" data-color="#f6bb42" data-hc="#f6bb42" data-s="25"></i>
            </a>
        </li>
    </ul>
</div>
<div class="clearfix"></div>

<ul id="menu" class="page-sidebar-menu">
	<li class="active">
		<a href="/admin">
			<i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
			<span class="title">Dashboard</span>
		</a>
	</li>
	<li>
		<a href="#">
			<i class="livicon" data-name="briefcase" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
			<span class="title">Transaction</span>
		</a>
		<ul class="sub-menu">
			<li>
				<a href="#">
					<i class="fa fa-angle-double-right"></i>
					<span class="title">Manage Application</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="/manage_app/enrollee">
							<i class="fa fa-angle-double-right"></i>
							Single Application
						</a>
					</li>
					<li>
						<a href="/manage_app/genrollee">
							<i class="fa fa-angle-double-right"></i>
							Group Application
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-angle-double-right"></i>
					<span class="title">Collections</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="/collection/single">
							<i class="fa fa-angle-double-right"></i>
							Single Collection
						</a>
					</li>
					<li>
						<a href="/collection/group">
							<i class="fa fa-angle-double-right"></i>
							Group Collection
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="/students">
					<i class="fa fa-angle-double-right"></i>
					Students
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">
			<i class="livicon" data-name="hammer" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
			<span class="title">Maintenance</span>
		</a>
		<ul class="sub-menu">
			<li >
				<a href="/maintenance/ptype">
					<i class="fa fa-angle-double-right"></i>
					Program Type 
				</a>
			</li>
			<li >
				<a href="/maintenance/program">
					<i class="fa fa-angle-double-right"></i>
					Program 
				</a>
			</li>
			<li >
				<a href="/maintenance/rate">
					<i class="fa fa-angle-double-right"></i>
					Course 
				</a>
			</li>
			<li >
				<a href="{{url('/maintenance/tofficer')}}">
					<i class="fa fa-angle-double-right"></i>
					Training Officer
				</a>
			</li>
			<li >
				<a href="/maintenance/building">
					<i class="fa fa-angle-double-right"></i>
					Building 
				</a>
			</li>
			<li >
				<a href="/maintenance/floor">
					<i class="fa fa-angle-double-right"></i>
					Floor 
				</a>
			</li>
			<li >
				<a href="/maintenance/room">
					<i class="fa fa-angle-double-right"></i>
					Training Room 
				</a>
			</li>
			<li >
				<a href="/maintenance/vessel">
					<i class="fa fa-angle-double-right"></i>
					Vessel
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">
			<i class="livicon" data-name="wrench" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
			<span class="title">Utilities</span>
		</a>
		<ul class="sub-menu">
			<li >
				<a href="{{url('/maintenance/employee')}}">
					<i class="fa fa-angle-double-right"></i>
					Employee
				</a>
			</li>
			<li >
				<a href="/maintenance/position">
					<i class="fa fa-angle-double-right"></i>
					Position 
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="/enrollee">
			<i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
			<span class="title">Queries</span>
		</a>
	</li>
</ul>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>Dashboard</h1>
</section>
@endsection	