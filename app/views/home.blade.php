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

    <link href="{{$root_path}}css/home.css" rel="stylesheet">
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


	<!-- BANNER BOX -->
	<div id="banner_box">

	</div>
	<!-- END BANNER BOX -->

	<table class="three_col_box">
		<tr>


			<td>
				<h3 class="case" >What is this all about?</h3>

				A web-based application that guides students in learning basic java programming.

				<br><br>
				There are predefined problems designed to allow the users to use branching statements (e.g. <span class="cond">if</span>-<span class="cond">else</span>, nested <span class="cond">if</span>-<span class="cond">else</span>, <span class="switch">switch</span>) and loop statements (e.g. <span class="while">while</span>, <span class="do_while">do-while</span>, <span class="for">for</span>). Tags and identifiers used in constructing the program are all predefined. A code fragment is generated based on the tags compiled by the user thus, changes to the code fragment is not permitted unless the tags are modified.
			</td>
			

			<td>
				<h3><span class="var">Problems</span>, <span class="switch"><i>what do you mean?</i></span></h3>
				There are three (3) categories ― <span class="easy">Easy</span>, <span class="ave">Average</span>, and <span class="diff">Difficult</span>. Each category has five (5) levels that must be solved correctly in order for the user to proceed to the next level. One programmer’s cup is equivalent to five (5) points and first attempt is equivalent to four (4) programmer’s cup. Second attempt is equivalent to three (3) programmer’s cup so on until the fourth attempt which is equivalent to only one (1) programmer’s cup. Further attempts has no longer programmer’s cup but the problem has to be solved to proceed.
			</td>
			
			<td>
				<h3><span class="while">Contributors</span></h3>
				
			</td>

		</tr>
	</table>


	<table class="three_col_box scope_main_box">
		<tr>


			<td >
				<div id="easy_box">Category Easy</div>
					<table class="scope_box" >
						<tr>
							<td>5 levels</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td><span class="var" >Variable</span> declarations</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td><span class="print">Print</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ><b>Conditional statements:</b></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(a) <span class="cond" >if</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(b) <span class="cond" >else</span> statements </td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(c) <span class="cond" >else</span>-<span class="cond" >if</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(d) <span class="switch" >switch</span>-<span class="case">case</span> statements </td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td></span>Nested conditional statements</td>
							<td><span class="error" >X</td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ><b>Repetition Statements:</b></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(a) <span class="while" >while</span> statements</td>
							<td><span class="error" >X</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(b) <span class="do_while" >do</span>-<span class="do_while" >while</span> statements</td>
							<td><span class="error" >X</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(c) <span class="for" >for</span>-<span class="for" >loop</span> statements</td>
							<td><span class="error" >X</span></td>
						</tr>
					</table>

			</td>
			

			<td >
				<div id="ave_box">Category Average</div>
					<table class="scope_box" >
						<tr>
							<td>5 levels</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td><span class="var" >Variable</span> declarations</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td><span class="print">Print</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ><b>Conditional statements:</b></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(a) <span class="cond" >if</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(b) <span class="cond" >else</span> statements </td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(c) <span class="cond" >else</span>-<span class="cond" >if</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(d) <span class="switch" >switch</span>-<span class="case">case</span> statements </td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td></span>Nested conditional statements</td>
							<td><span class="check" >√</td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ><b>Repetition Statements:</b></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(a) <span class="while" >while</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(b) <span class="do_while" >do</span>-<span class="do_while" >while</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(c) <span class="for" >for</span>-<span class="for" >loop</span> statements</td>
							<td><span class="error" >X</span></td>
						</tr>
					</table>
			</td>
			
			<td >
				<div id="diff_box">Category Difficult</div>
				<table class="scope_box" >
						<tr>
							<td>5 levels</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td><span class="var" >Variable</span> declarations</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td><span class="print">Print</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ><b>Conditional statements:</b></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(a) <span class="cond" >if</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(b) <span class="cond" >else</span> statements </td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(c) <span class="cond" >else</span>-<span class="cond" >if</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(d) <span class="switch" >switch</span>-<span class="case">case</span> statements </td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td></span>Nested conditional statements</td>
							<td><span class="check" >√</td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ></td>
						</tr>
						<tr>
							<td colspan="2" ><b>Repetition Statements:</b></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(a) <span class="while" >while</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(b) <span class="do_while" >do</span>-<span class="do_while" >while</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
						<tr>
							<td>&emsp;&emsp;(c) <span class="for" >for</span>-<span class="for" >loop</span> statements</td>
							<td><span class="check" >√</span></td>
						</tr>
					</table>
			</td>

		</tr>
	</table>

</div>


</body>
</html>