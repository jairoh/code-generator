<!DOCTYPE html>

<html>
<input type="hidden" style="display:none;" id="root_path" value="{{$root_path}}" >	

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?= $page_title ?></title>

	<script type="text/javascript" src="{{$root_path}}js/jquery.js"></script>
	<script type="text/javascript" src="{{$root_path}}js/jquery-ui.js"></script>
	<link href="{{$root_path}}css/jquery-ui.css" rel="stylesheet">

	<link href="{{$root_path}}css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>
</head>
<body>

	<!-- div for fixed header  -->
<div id="head" >
	<link rel="stylesheet" href="{{$root_path}}css/default.css" />
	<!-- header_holder-->
	<div id="header_holder">
		<div id="main_header">
	    
	    <div id="logo_box">
	    	<img src="{{$root_path}}img/CFG_logo.png" />
	    </div><!--end of logo_box-->
	    
	    	<table id="login_table">
	        
	        </table>
	    </div><!--end of main_header-->
	</div><!--end of header_holder-->


	<!-- NAV BAR -->
	<link rel="stylesheet" type="text/css" href="{{$root_path}}css/toolbar.css" />
	<div id="toolbar">
		<ul id="nav">
			<li><a href="{{$root_path}}home" >Home</a></li>
			<?php if ( Session::get( 'user_id' ) ) {?> <li><a href="{{$root_path}}profile" >Profile[<?php echo Session::get( 'firstname' ) . " " . Session::get( 'lastname' ); ?>]</a></li> <?php } ?>
			<?php if ( Session::get( 'user_id' ) ) {?> <li><a href="{{$root_path}}ranking" >Ranking</a></li> <?php } ?>
			<?php if ( Session::get( 'user_type_id' ) == 1 ) { ?><li><a href="{{$root_path}}admin">Admin</a></li><?php } ?>
			<?php if ( Session::get( 'user_id' ) ) {?> <li><a href="{{$root_path}}logout">Logout</a></li> <?php } else { ?> 
			<li><a href="{{$root_path}}login">Login</a></li> <?php } ?>
			
		</ul>
	</div>
	<!-- END NAV BAR -->

</div>


</body>
</html>