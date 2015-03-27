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
      <td colspan="3" ><b>Manage [Easy Problems]</b></td>
    </tr>
    <tr>
      <td><b>Level</b></td>
      <td><b>Description</b></td>
      <td></td>
    </tr>

    <?php foreach( $easy_problems as $problem ): ?>
    <tr>
      <td><b>{{$problem->level}}</b></td>
      <td>{{$problem->description}}</td>
      <td><button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></button></td>
    </tr>
    <?php endforeach; ?>


  </table>

  




  <table class="problem_list table" >
    <tr class="tr_blue" >
      <td colspan="3" ><b>Manage [Average Problems]</b></td>
    </tr>

    <tr>
      <td><b>Level</b></td>
      <td><b>Description</b></td>
      <td></td>
    </tr>

    <?php foreach( $average_problems as $problem ): ?>
    <tr>
      <td><b>{{$problem->level}}</b></td>
      <td>{{$problem->description}}</td>
      <td></td>
    </tr>
    <?php endforeach; ?>


  </table>

  

  <!-- Edit user modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h5 class="modal-title" id="myModalLabel">Update <span>Easy</span> Problem Level <span>1</span> </h5>
        </div>
        <div class="modal-body">
          
          <table class="table table-user-information">
            
            <tr>
              <td>
                For hint keywords, wrap the text with: <br />
                <vs>variable(s)</vs> = <b><?= htmlentities( "<vs>...</vs>" )?></b> <br />
                <ps>print statement(s)</ps> = <b><?= htmlentities( "<ps>...</ps>" )?></b> <br />
                <cond>conditional statement(s)</cond> = <b><?= htmlentities( "<cond>...</cond>" )?></b> <br />
                <ws>while statement(s)</ws> = <b><?= htmlentities( "<ws>...</ws>" )?></b> <br /> 
                <dws>do while statement(s)</dws> = <b><?= htmlentities( "<dws>...</dws>" )?></b> <br />
                <fls>for loop statement(s)</fls> = <b><?= htmlentities( "<fls>...</fls>" )?></b> <br />
                <ss>switch statement(s)</ss> = <b><?= htmlentities( "<ss>...</ss>" )?></b> <br />

                <br>
                To add a nextline, put <b><?= htmlentities( "<br>" )?></b>
              </td>
            </tr>

            <tr>
             <td><textarea id="text_area_problem_descrp" ></textarea></td>
            </tr>

          </table>

          <div id="update_errors" ></div>

        </div>
        

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update_password_btn" >Save changes</button>
          </div>


      </div>
    </div>
  </div>
  <!-- End edit user modal -->



@stop