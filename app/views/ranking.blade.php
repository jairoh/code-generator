@extends( 'layout/default' )


@section( 'includes' )
  <link href="{{$root_path}}css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>

  <link href="{{$root_path}}css/ranking.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/ranking.js" ></script>

@stop


@section( 'content' )
	<input type="hidden" style="display:none;" id="root_path" value="{{$root_path}}" >	
	<link rel="stylesheet" type="text/css" href="{{$root_path}}css/toolbar.css" />
	<div id="toolbar">
		<ul id="nav">
			<li><a href="{{$root_path}}category" >Home</a></li>
			<li><a href="{{$root_path}}profile" >Profile[<?php echo Session::get( 'firstname' ) . " " . Session::get( 'lastname' ); ?>]</a></li>
			<li><a href="{{$root_path}}ranking" >Ranking</a></li>
			<?php if ( Session::get( 'user_type_id' ) == 1 ) { ?><li><a href="{{$root_path}}admin">Admin</a></li><?php } ?>
			<li><a href="{{$root_path}}logout">Logout</a></li>
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
			<td colspan="5" ><b>Top 5 Users</b></td>
		</tr>
		<?php foreach( $easy_level_top_students as $problem ): ?>
			<tr>
				<td ><b>{{$problem->problem_id}}</b></td>
				<?php if( ! count( $problem->top_students ) ) { echo "<td colspan='5' >No students</td>"; } ?>
				<?php foreach ( $problem->top_students as $students ): ?> 
					<td>
						

						<table>
							<tr >
								<td rowspan="4" >
									<img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50" class="img-circle">
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
			<td colspan="5" ><b>Top 5 Users</b></td>
		</tr>
		<?php foreach( $average_level_top_students as $problem ): ?>
			<tr>
				<td ><b>{{$problem->problem_id - 5}}</b></td>
				<?php if( ! count( $problem->top_students ) ) { echo "<td colspan='5' >No students</td>"; } ?>
				<?php foreach ( $problem->top_students as $students ): ?> 
					<td>
						

						<table>
							<tr >
								<td rowspan="4" >
									<img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50" class="img-circle">
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


	<pre>
		<?php 
			//print_r( $easy_level_top_students );
		?>
	</pre>
	

@stop

