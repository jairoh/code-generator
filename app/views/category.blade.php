<!DOCTYPE html>
<html >
<input type="hidden" style="display:none;" id="root_path" value="{{$root_path}}" >	

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?= $page_title ?></title>

	<script type="text/javascript" src="{{$root_path}}js/jquery.js"></script>
	<script type="text/javascript" src="{{$root_path}}js/jquery-ui.js"></script>
	<link href="{{$root_path}}css/jquery-ui.css" rel="stylesheet">

	<link href="{{$root_path}}css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>

	<link rel="stylesheet" type="text/css" href="{{$root_path}}css/jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="{{$root_path}}css/examples.css" />
    <link rel="stylesheet" type="text/css" href="{{$root_path}}css/category.css" />

	<script type="text/javascript" src="{{$root_path}}js/jquery.fullPage.js"></script>
	<script type="text/javascript" src="{{$root_path}}js/examples.js"></script>

	<script type="text/javascript" src="{{$root_path}}js/category.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				sectionsColor: ['#fff', '#32BD26', '#3498db', '#E6F599' ],
				anchors: ['home','easy', 'normal', 'hard' ],
				menu: '#menu',
				easing: 'easeOutBack'
			});

		});
	</script>

</head>
<body>



<!-- div for fixed header  -->
<div id="head" >
	<link rel="stylesheet" href="{{$root_path}}css/default.css" />
	
	<div id="main_header">
        
	        <div id="logo_box">
	        	<img src="{{$root_path}}img/CFG_logo.png" />
	        </div><!--end of logo_box-->
        
        </div><!--end of main_header-->


	<!-- NAV BAR -->
	<link rel="stylesheet" type="text/css" href="{{$root_path}}css/toolbar.css" />
	<div id="toolbar">
		<ul id="nav">
			<li><a href="{{$root_path}}home" >Home</a></li>
			<?php if ( Session::get( 'user_id' ) ) { ?><li><a href="{{$root_path}}category">Category</a></li><?php } ?>
			<li><a href="{{$root_path}}profile" >Profile[<?php echo Session::get( 'firstname' ) . " " . Session::get( 'lastname' ); ?>]</a></li>
			<li><a href="{{$root_path}}ranking" >Ranking</a></li>
			<?php if ( Session::get( 'user_type_id' ) == 1 ) { ?><li><a href="{{$root_path}}admin">Admin</a></li><?php } ?>
			<li><a href="{{$root_path}}logout">Logout</a></li>
		</ul>
	</div>
	<!-- END NAV BAR -->

</div>

<!-- ==================================================================================================================== -->

<div id="fullpage">

	<div class="section " id="section">
		<div id="category_box">
			<div id="category_holder">
				<a href="#easy">
				<div class="category easy">
					<img src="{{$root_path}}img/easy.png" />
				</div><!--end of category-->
				</a>
				<a href="#normal">
				<div class="category normal">
					<img src="{{$root_path}}img/average.png" />
				</div><!--end of category-->
				</a>
				<a href="#hard">
				<div class="category hard">
					<img src="{{$root_path}}img/difficult.png" />
				</div><!--end of category-->
				</a>
			</div><!--end of category_holder-->
		</div><!--end of category_box-->
	</div>



	<div class="section" id="section1">

		<!-- LEGEND PROGRESS BOX -->
		<div class="legend_progress_box">
			
			<table>
				<tr>
					<td>Solved:</td>
					<td>
						<div class="progress" style="width: 70%" >
						    <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Available:</td>
					<td>
						<div class="progress" style="width: 70%">
							<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Not Available:</td>
					<td>
						<div class="progress" style="width: 70%">
							<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
			</table>
			
		</div>
		<!-- END LEGEND CATEGORY PROGRESS BOX -->

		<div class="intro">
			<h1>Easy</h1>
			<div id="level_holder">
				<div class='level_opened' >
					<a class=<?php echo ( $problems_available [ 1 ] [ 1 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> onClick="proceed_to_the_problem( 1, 1 );" >1</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 1 ] [ 2 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 1 ] [ 2 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 1 ] [ 2 ] != 0 ) echo 'onClick="proceed_to_the_problem( 1, 2 );"' ?> >2</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 1 ] [ 3 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 1 ] [ 3 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 1 ] [ 3 ] != 0 ) echo 'onClick="proceed_to_the_problem( 1, 3 );"' ?> >3</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 1 ] [ 4 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 1 ] [ 4 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 1 ] [ 4 ] != 0 ) echo 'onClick="proceed_to_the_problem( 1, 4 );"' ?> >4</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 1 ] [ 5 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 1 ] [ 5 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 1 ] [ 5 ] != 0 ) echo 'onClick="proceed_to_the_problem( 1, 5 );"' ?> >5</a>
				</div><!--end of level-->
			</div><!--end of leve_holder-->
		</div>


		<!-- CATEGORY PROGRESS BOX -->
		<div class="category_progress_box">
			<div class="progress" style="width: 100%">
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 1 ] [ 1 ] == 2 )? 'success' : 'warning'; ?> progress-bar-striped"  style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 1 ] [ 2 ] == 2 )? 'success' : ( ( $problems_available [ 1 ] [ 2 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 1 ] [ 3 ] == 2 )? 'success' : ( ( $problems_available [ 1 ] [ 3 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 1 ] [ 4 ] == 2 )? 'success' : ( ( $problems_available [ 1 ] [ 4 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 1 ] [ 5 ] == 2 )? 'success' : ( ( $problems_available [ 1 ] [ 5 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
			</div>
		</div>
		<!-- END CATEGORY PROGRESS BOX -->

	</div>





<!-- ==================================================================================================================== -->




	<div class="section" id="section2">

		<!-- LEGEND PROGRESS BOX -->
		<div class="legend_progress_box">
			
			<table>
				<tr>
					<td>Solved:</td>
					<td>
						<div class="progress" style="width: 70%" >
						    <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Available:</td>
					<td>
						<div class="progress" style="width: 70%">
							<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Not Available:</td>
					<td>
						<div class="progress" style="width: 70%">
							<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
			</table>
			
		</div>
		<!-- LEGEND CATEGORY PROGRESS BOX -->


		<div class="intro">
			<h1>Average</h1>
			<div id="level_holder">
				<div class=<?php echo ( $problems_available [ 1 ] [ 5 ] == 2 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 2 ] [ 1 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 2 ] [ 1 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 1 );"' ?> >1</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 2 ] [ 2 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 2 ] [ 2 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 2 ] [ 2 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 2 );"' ?> >2</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 2 ] [ 3 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 2 ] [ 3 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 2 ] [ 3 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 3 );"' ?> >3</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 2 ] [ 4 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 2 ] [ 4 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>
						<?php if( $problems_available [ 2 ] [ 3 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 4 );"' ?> >4</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 2 ] [ 5 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 2 ] [ 4 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 2 ] [ 3 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 5 );"' ?> >5</a>
				</div><!--end of level-->
			</div><!--end of leve_holder-->
		</div>
	

		<!-- CATEGORY PROGRESS BOX -->
		<div class="category_progress_box">
			<div class="progress" style="width: 100%">
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 2 ] [ 1 ] == 2 )? 'success' : ( ( $problems_available [ 2 ] [ 1 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 2 ] [ 2 ] == 2 )? 'success' : ( ( $problems_available [ 2 ] [ 2 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 2 ] [ 3 ] == 2 )? 'success' : ( ( $problems_available [ 2 ] [ 3 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 2 ] [ 4 ] == 2 )? 'success' : ( ( $problems_available [ 2 ] [ 4 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 2 ] [ 5 ] == 2 )? 'success' : ( ( $problems_available [ 2 ] [ 5 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
			</div>
		</div>
		<!-- END CATEGORY PROGRESS BOX -->


	</div>







<!-- ==================================================================================================================== -->




	<div class="section" id="section2">

		<!-- LEGEND PROGRESS BOX -->
		<div class="legend_progress_box">
			
			<table>
				<tr>
					<td>Solved:</td>
					<td>
						<div class="progress" style="width: 70%" >
						    <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Available:</td>
					<td>
						<div class="progress" style="width: 70%">
							<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Not Available:</td>
					<td>
						<div class="progress" style="width: 70%">
							<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%"></div>
						</div>
					</td>
				</tr>
			</table>
			
		</div>
		<!-- LEGEND CATEGORY PROGRESS BOX -->

		<div class="intro">
			<h1>Difficult</h1>
			<div id="level_holder">
				<div class=<?php echo ( $problems_available [ 3 ] [ 1 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 3 ] [ 1 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>
					<?php if( $problems_available [ 3 ] [ 1 ] != 0 ) echo 'onClick="proceed_to_the_problem( 3, 1 );"' ?> >1</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 3 ] [ 2 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 3 ] [ 2 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
						<?php if( $problems_available [ 3 ] [ 2 ] != 0 ) echo 'onClick="proceed_to_the_problem( 3, 2 );"' ?> >2</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 3 ] [ 3 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 3 ] [ 3 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>>3</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 3 ] [ 4 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 3 ] [ 4 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>>4</a>
				</div><!--end of level-->

				<div class=<?php echo ( $problems_available [ 3 ] [ 5 ] != 0 )? 'level_opened' : 'level_closed' ?>>
					<a class=<?php echo ( $problems_available [ 3 ] [ 5 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>>5</a>
				</div><!--end of level-->
			</div><!--end of leve_holder-->
		</div>
	
		<!-- CATEGORY PROGRESS BOX -->
		<div class="category_progress_box">
			<div class="progress" style="width: 100%">
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 3 ] [ 1 ] == 2 )? 'success' : ( ( $problems_available [ 3 ] [ 1 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 3 ] [ 2 ] == 2 )? 'success' : ( ( $problems_available [ 3 ] [ 2 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 3 ] [ 3 ] == 2 )? 'success' : ( ( $problems_available [ 3 ] [ 3 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 3 ] [ 4 ] == 2 )? 'success' : ( ( $problems_available [ 3 ] [ 4 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
				<div class="progress-bar progress-bar-<?php echo ( $problems_available [ 3 ] [ 5 ] == 2 )? 'success' : ( ( $problems_available [ 3 ] [ 5 ] != 0 )? 'warning': 'danger' ); ?> progress-bar-striped" style="width: 20%"></div>
			</div>
		</div>
		<!-- END CATEGORY PROGRESS BOX -->

	</div>


	<!-- POP UP -->
	<div id="dialog-confirm">
		You are attempting to answer Category <b id="cat_name" >Easy</b> Level <b id="level" ></b>.
	</div>

</body>
</html>
