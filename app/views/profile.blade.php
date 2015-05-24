@extends( 'layout/default' )
	

@section( 'includes' )
  <link href="{{$root_path}}css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>

  
  <script type="text/javascript" src="{{$root_path}}js/category.js"></script>
  <script src="{{$root_path}}js/profile_script.js"></script>
  <link rel="stylesheet" type="text/css" href="{{$root_path}}css/profile.css" />
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


	
  <div class="container">
      <div class="row">
          <div class="col-md-5  toppad  pull-right col-md-offset-3 "></div>
          
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
              
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <table width="100%" >
                          <tr>
                          <td><?= $user_info->firstname . " " . $user_info->lastname ?></td>
                          <td></td>
                          </tr>
                      </table>
                     
                  </div>
                  
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-md-3 col-lg-3 " align="center"> <img class="user_img" alt="User Pic" src="{{$root_path}}img/default-user-image.png" class="img-circle"> </div>

                          <div class=" col-md-9 col-lg-9 "> 
                              <table class="table table-user-information">
                                  <tbody>
                                      <tr>
                                          <td>Lastname</td>
                                          <td><?= $user_info->lastname ?></td>
                                      </tr>
                                      <tr>
                                          <td>Firstname</td>
                                          <td><?= $user_info->firstname ?></td>
                                      </tr>
                                      <tr>
                                          <td>E-mail Address</td>
                                          <td><a href="mailto:<?= $user_info->email_address ?>"><?= $user_info->email_address ?><a></td>
                                      </tr>
                                      <tr>
                                          <td>Gender</td>
                                          <td><?= ( $user_info->gender_id == 1 )? "Male" : "Female" ?></td>
                                      </tr>
                                  </tbody>
                              </table>

                          </div>

                      </div>

                  </div>

                  <div class="panel-footer">
                      <a href="mailto:jairohtuada@gmail.com" data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                      <span class="pull-right">
                          <button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></button>
                      </span>
                  </div>


                  <div class="panel-heading">
                      Stages Accomplished: 
                  </div>
                  
                  <div class="panel-body stages_comp_box">
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

                      <div class="level_holder easy_holder">
                        
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








                      <div class="level_holder average_holder">
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
                              <?php if( $problems_available [ 2 ] [ 4 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 4 );"' ?> >4</a>
                          </div><!--end of level-->

                          <div class=<?php echo ( $problems_available [ 2 ] [ 5 ] != 0 )? 'level_opened' : 'level_closed' ?>>
                            <a class=<?php echo ( $problems_available [ 2 ] [ 4 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?> 
                              <?php if( $problems_available [ 2 ] [ 5 ] != 0 ) echo 'onClick="proceed_to_the_problem( 2, 5 );"' ?> >5</a>
                          </div><!--end of level-->     

                      </div><!--end of leve_holder-->


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





                      <div class="level_holder difficult_holder">
                          <div class=<?php echo ( $problems_available [ 3 ] [ 1 ] != 0 )? 'level_opened' : 'level_closed' ?>>
                            <a class=<?php echo ( $problems_available [ 3 ] [ 1 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>>1</a>
                          </div><!--end of level-->

                          <div class=<?php echo ( $problems_available [ 3 ] [ 2 ] != 0 )? 'level_opened' : 'level_closed' ?>>
                            <a class=<?php echo ( $problems_available [ 3 ] [ 2 ] == 2 )? 'level_solved_num' : 'level_unsolved_num' ?>>2</a>
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

              </div>
          </div>
      </div>
  </div>







  <!-- Edit user modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
        </div>
        <div class="modal-body">
          
          <table class="table table-user-information">
            <tbody>
              <tr>
                <td>Lastname</td>
                <td><input class="form-control" name="lastname" id="update_ln" value="<?= $user_info->lastname ?>" placeholder="Enter lastname"></td>
              </tr>
              <tr>
                <td>Firstname</td>
                <td><input class="form-control" name="firstname" id="update_fn" value="<?= $user_info->firstname ?>" placeholder="Enter firstname"></td>
              </tr>
              <tr>
                <td>E-mail Address</td>
                <td><input class="form-control" name="email" id="update_email" value="<?= $user_info->email_address ?>" placeholder="Enter E-mail address"></td>
              </tr>
              <tr>
                <td>Gender</td>
                <td>
                  <label id="maleRB" >
                      <input type="radio" name="update_gender" value="1" <?= ( $user_info->gender_id == 1 )? "checked" : "" ?> > Male
                  </label>
                  <label id="femaleRB" >
                      <input type="radio" name="update_gender" value="2" <?= ( $user_info->gender_id == 2 )? "checked" : "" ?> > Female
                  </label> 
                </td>
              </tr>
            </tbody>
          </table>

          <div id="update_errors" ></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="update_profile_btn" >Save changes</button>
        </div>

        <table class="table table-user-information">
            <tbody>
             <tr>
                <td>New Password</td>
                <td>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                </td>
              </tr>
              <tr>
                <td>Confirm New Password</td>
                <td>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Enter password">
                </td>
              </tr>
            </tbody>
          </table>

          <div id="update_pass_errors" ></div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update_password_btn" >Save changes</button>
          </div>


      </div>
    </div>
  </div>
  <!-- End edit user modal -->


  <!-- POP UP -->
  <div id="dialog-confirm">
    You are attempting to answer Category <b id="cat_name" >Easy</b> Level <b id="level" ></b>.
  </div>

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