<!doctype html>
<html>
<head>
	<title><?= $page_title ?></title>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" href="{{$root_path}}css/default.css" />
	
	<script type="text/javascript" src="{{$root_path}}js/jquery.js"></script>
    <script type="text/javascript" src="{{$root_path}}js/jquery-ui.js"></script>
    
    <link rel="stylesheet" type="text/css" href="{{$root_path}}css/jquery-ui.css" />

	@yield( 'includes' )

</head>
<body>

	<div id="header_holder">
    	<div id="main_header">
        
	        <div id="logo_box">
	        	<img src="{{$root_path}}img/CFG_logo.png" />
	        </div><!--end of logo_box-->
        
        </div><!--end of main_header-->
    </div><!--end of header_holder-->
	
	@yield( 'content' )


	<div id="footer_holder">
    	<div id="main_footer">
        </div><!--end of main_footer-->
    </div><!--end of footer_folder-->

     
	

</body>
</html>