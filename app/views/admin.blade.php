@extends( 'layout/default' )
	

@section( 'includes' )
  <link href="{{$root_path}}css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>

  <link href="{{$root_path}}css/admin.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/admin.js" ></script>
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
      <li><a href="#" onClick="do_logout();" >Logout</a></li>
    </ul>
  </div>

  <!-- EASY PROBLEMS -->
  <table class="problem_list table" >
    <tr class="tr_green" >
      <td colspan="3" class="prob_title" ><b>Manage [Easy Problems]</b></td>
    </tr>
    <tr>
      <td><b>Level</b></td>
      <td><b>Description</b></td>
      <td></td>
    </tr>

    <?php foreach( $easy_problems as $problem ): ?>
    <tr>
      <td><b>{{$problem->level}}</b></td>
      <td><p id="prob_{{$problem->problem_id}}" >{{$problem->description}}</p></td>
      <td><button type="button" data-target="#editProbModal" onClick="feed_problem_details( 'Easy', {{$problem->problem_id}}, {{$problem->level}} );" data-toggle="modal" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></button></td>
    </tr>
    <?php endforeach; ?>


  </table>
  <!-- END EASY PROBLEMS -->

  

  <!-- AVERAGE PROBLEMS -->
  <table class="problem_list table" >
    <tr class="tr_blue" >
      <td colspan="3" class="prob_title" ><b>Manage [Average Problems]</b></td>
    </tr>

    <tr>
      <td><b>Level</b></td>
      <td><b>Description</b></td>
      <td></td>
    </tr>

    <?php foreach( $average_problems as $problem ): ?>
    <tr>
      <td><b>{{$problem->level}}</b></td>
      <td><p id="prob_{{$problem->problem_id}}" >{{$problem->description}}</p></td>
      <td><button type="button" data-target="#editProbModal" onClick="feed_problem_details( 'Average', {{$problem->problem_id}}, {{$problem->level}} );" data-toggle="modal" class="btn btn-xs btn-warning "><i class="glyphicon glyphicon-edit"></i></button></td>
    </tr>
    <?php endforeach; ?>


  </table>
  <!-- END AVERAGE PROBLEMS -->

   <!-- DIFFICULT PROBLEMS -->
  <table class="problem_list table" >
    <tr class="tr_yellow" >
      <td colspan="3" class="prob_title" ><b>Manage [Difficult Problems]</b></td>
    </tr>

    <tr>
      <td><b>Level</b></td>
      <td><b>Description</b></td>
      <td></td>
    </tr>

    <?php foreach( $difficult_problems as $problem ): ?>
    <tr>
      <td><b>{{$problem->level}}</b></td>
      <td><p id="prob_{{$problem->problem_id}}" >{{$problem->description}}</p></td>
      <td><button type="button" data-target="#editProbModal" onClick="feed_problem_details( 'Difficult', {{$problem->problem_id}}, {{$problem->level}} );" data-toggle="modal" class="btn btn-xs btn-warning "><i class="glyphicon glyphicon-edit"></i></button></td>
    </tr>
    <?php endforeach; ?>


  </table>
  <!-- END DIFFICULT PROBLEMS -->

  

  <!-- Edit problem description modal -->
  <div class="modal fade" id="editProbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h5 class="modal-title" id="myModalLabel">Update <span id="cat" >Easy</span> Problem Level <span id="level" >1</span> </h5>
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

            <tr>
              <td>
                Restore default description: 
                <button type="button" onClick="restore_default_descrip();" class="btn btn-success btn-sm glyphicon glyphicon-repeat"  ></button>
              </td>
            </tr>
          </table>



          <div id="update_errors" ></div>

        </div>
        

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onClick="update_problem_descrip();" >Save changes</button>
          </div>


      </div>
    </div>
  </div>
  <!-- End edit problem description modal -->

    <div id="footer_holder">
    <div id="main_footer">
      <p>
        BSCS IV Thesis Project <br>
        College of Computer Studies <br>
        Foundation University <br>
        Dumaguete City <br>
        E-mail: <a href="mailto:fucs2014@gmail.com">fucs2014@gmail.com</a> <br>
        -- <br>
        All Rights Reserved. <br>
        © 2014-2015 Thesis Project
      </p>
    </div><!--end of main_footer-->
    </div><!--end of footer_folder-->

@stop