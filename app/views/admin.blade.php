@extends( 'layout/default' )
	

@section( 'includes' )
  <link href="{{$root_path}}css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>

  <link href="{{$root_path}}css/admin.css" rel="stylesheet">
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

  <table class="problem_list table" >
    <tr class="tr_green" >
      <td colspan="2" ><b>Easy Problems</b></td>
    </tr>
    <tr>
      <td>Level</td>
      <td>Description</td>
    </tr>

    <?php foreach( $easy_problems as $problem ): ?>
    <tr>
      <td>{{$problem->level}}</td>
      <td>{{$problem->description}}</td>
    </tr>
    <?php endforeach; ?>


  </table>

  




  <table class="problem_list table" >
    <tr class="tr_blue" >
      <td colspan="2" ><b>Average Problems</b></td>
    </tr>

    <tr>
      <td>Level</td>
      <td>Description</td>
    </tr>

    <?php foreach( $average_problems as $problem ): ?>
    <tr>
      <td>{{$problem->level}}</td>
      <td>{{$problem->description}}</td>
    </tr>
    <?php endforeach; ?>


  </table>

  

@stop