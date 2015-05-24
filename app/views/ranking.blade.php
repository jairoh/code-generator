@extends( 'layout/default' )


@section( 'includes' )
  <link href="{{$root_path}}css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>

  <link href="{{$root_path}}css/ranking.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/ranking.js" ></script>
  <script type="text/javascript" src="{{$root_path}}js/logout_script.js"></script>
@stop


@section( 'content' )
	<input type="hidden" style="display:none;" id="root_path" value="{{$root_path}}" >	
	<link rel="stylesheet" type="text/css" href="{{$root_path}}css/toolbar.css" />
	<div id="toolbar">
		<ul id="nav">
			<li><a href="{{$root_path}}home" >Home</a></li>
			<?php if ( Session::get( 'user_id' ) ) { ?><li><a href="{{$root_path}}category">Category</a></li><?php } ?>
			<li><a href="{{$root_path}}profile" >Profile[<?php echo Session::get( 'firstname' ) . " " . Session::get( 'lastname' ); ?>]</a></li>
			<li><a href="{{$root_path}}ranking" >Ranking</a></li>
			<?php if ( Session::get( 'user_type_id' ) == 1 ) { ?><li><a href="{{$root_path}}admin">Admin</a></li><?php } ?>
			<li><a href="#" onClick="do_logout();">Logout</a></li>
		</ul>
	</div>




	<table class="user_lists table" >
		<tr class="tr_green" >
			<td colspan="5" ><b>Category: Easy</b></td>
		</tr>
		<tr>
			<td colspan="2" ><b>1 Programmer's Cup <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> = <code>5pts</b></td>
			<td colspan="1" ></td>
			<td colspan="2" >
				<button type="button" id="pick_week" class="easy generate_btn">Pick a Week</button>
				<div class="week-picker"></div> <b><code>{{$date}}</code></b>
			</td>
		</tr>
		<tr>
			<td><b>Level</b></td>
			<td colspan="5" >
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Top 5 Users</b>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<?php foreach( $easy_level_top_students as $problem ): ?>
			<tr>
				<td ><b><span class="no_equivalence">{{$problem->problem_id}}</span></b></td>
				<?php if( ! count( $problem->top_students ) ) { echo "<td colspan='5' >No students</td>"; } ?>
				<?php foreach ( $problem->top_students as $students ): ?> 
					<td>
						

						<table>
							<tr >
								<td rowspan="4" >
									<img class="user_img" alt="User Pic" src="{{$root_path}}img/default-user-image.png" class="img-circle">
								</td>
							</tr>
							<tr>
								<td>
									<kbd class="easy_name" >{{$students->full_name}}</kbd> 
								</td>
							</tr>
							<tr>
								<td>
									<code>{{$students->no_attempts}} attempt(s)</code>
								</td>
							</tr>
							<tr>
								<td>
									<?php 
										if ( $students->no_attempts == 1 ) $n = 4;
										else if ( $students->no_attempts == 2 ) $n = 3;
										else if ( $students->no_attempts == 3 ) $n = 2;
										else if ( $students->no_attempts == 4 ) $n = 1;
										else $n = 0;
										for( $i = 0; $i < $n; $i++ ) { ?>
											<img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
									<?php } ?>
								</td>
							</tr>
						</table>
						
						
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>



	<table class="user_lists table" >
		<tr class="tr_blue" >
			<td colspan="5" ><b>Category: Average</b></td>
		</tr>
		<tr>
			<td colspan="2" ><b>1 Programmer's Cup <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> = <code>5pts</b></td>
			<td colspan="1" ></td>
			<td colspan="2" >
			</td>
		</tr>
		<tr>
			<td><b>Level</b></td>
			<td colspan="5" >
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Top 5 Users</b>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<?php foreach( $average_level_top_students as $problem ): ?>
			<tr>
				<td ><b><span class="no_equivalence">{{$problem->problem_id - 5}}</span></b></td>
				<?php if( ! count( $problem->top_students ) ) { echo "<td colspan='5' >No students</td>"; } ?>
				<?php foreach ( $problem->top_students as $students ): ?> 
					<td>
						

						<table>
							<tr >
								<td rowspan="4" >
									<img class="user_img" alt="User Pic" src="{{$root_path}}img/default-user-image.png" class="img-circle">
								</td>
							</tr>
							<tr>
								<td>
									<kbd class="average" >{{$students->full_name}}</kbd>
								</td>
							</tr>
							<tr>
								<td>
									<code>{{$students->no_attempts}} attempt(s)</code>
								</td>
							</tr>
							<tr>
								<td>
									<?php 
										if ( $students->no_attempts == 1 ) $n = 4;
										else if ( $students->no_attempts == 2 ) $n = 3;
										else if ( $students->no_attempts == 3 ) $n = 2;
										else if ( $students->no_attempts == 4 ) $n = 1;
										else $n = 0;
										for( $i = 0; $i < $n; $i++ ) { ?>
											<img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
									<?php } ?>
								</td>
							</tr>
						</table>
						
						
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>



	<table class="user_lists table" >
		<tr class="tr_yellow" >
			<td colspan="5" ><b>Category: Difficult</b></td>
		</tr>
		<tr>
			<td colspan="2" ><b>1 Programmer's Cup <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> = <code>5pts</b></td>
			<td colspan="1" ></td>
			<td colspan="2" >
			</td>
		</tr>
		<tr>
			<td><b>Level</b></td>
			<td colspan="5" >
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Top 5 Users</b>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="glyphicon glyphicon-arrow-right"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<?php foreach( $dificult_level_top_students as $problem ): ?>
			<tr>
				<td ><b><span class="no_equivalence">{{$problem->problem_id - 10}}</span></b></td>
				<?php if( ! count( $problem->top_students ) ) { echo "<td colspan='5' >No students</td>"; } ?>
				<?php foreach ( $problem->top_students as $students ): ?> 
					<td>
						

						<table>
							<tr >
								<td rowspan="4" >
									<img class="user_img" alt="User Pic" src="{{$root_path}}img/default-user-image.png" class="img-circle">
								</td>
							</tr>
							<tr>
								<td>
									<kbd class="difficult" >{{$students->full_name}}</kbd>
								</td>
							</tr>
							<tr>
								<td>
									<code>{{$students->no_attempts}} attempt(s)</code>
								</td>
							</tr>
							<tr>
								<td>
									<?php 
										if ( $students->no_attempts == 1 ) $n = 4;
										else if ( $students->no_attempts == 2 ) $n = 3;
										else if ( $students->no_attempts == 3 ) $n = 2;
										else if ( $students->no_attempts == 4 ) $n = 1;
										else $n = 0;
										for( $i = 0; $i < $n; $i++ ) { ?>
											<img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
									<?php } ?>
								</td>
							</tr>
						</table>
						
						
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>

	<div id="footer_holder">
		<div id="main_footer">
			<p>
				BSCS IV Thesis Project <br>
				College of Computer Studies <br>
				Foundation University <br>
				Dumaguete City, Philippines <br>
				Follow: <a href="https://www.facebook.com/groups/138258766332157/" target="_blank" ><img src="{{$root_path}}img/fb-icon.png" width="20px" ></a> 
						<a href="https://twitter.com/jairohtuada" target="_blank" ><img src="{{$root_path}}img/twitter-icon.png" width="23https://twitter.com/jairohtuadap target="_blank" x" ></a> <br>
				-- <br>
				All Rights Reserved. <br>
				© 2014-2015 Thesis Project
			</p>
		</div><!--end of main_footer-->
    </div><!--end of footer_folder-->
    
@stop

