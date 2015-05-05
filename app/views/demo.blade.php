@extends( 'layout/default' )
	

@section( 'includes' )
    <script type="text/javascript" src="{{$root_path}}js/jquery.js"></script>
    <script type="text/javascript" src="{{$root_path}}js/jquery-ui.js"></script>
    <link href="{{$root_path}}css/jquery-ui.css" rel="stylesheet">

    <script type="text/javascript" src="{{$root_path}}js/popup.js"></script>
    <link rel="stylesheet" type="text/css" href="{{$root_path}}css/popup.css" />

    <!-- DRAG SCRIPTS -->
    <script type="text/javascript" src="{{$root_path}}js/drag.js"></script>
    <link rel="stylesheet" type="text/css" href="{{$root_path}}css/drag.css">
    <!-- END DRAG SCRIPTS -->


    <!-- TRANSLATE SCRIPTS -->
    <script type="text/javascript" src="{{$root_path}}js/script.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/generate.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/TranslateTags.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/CorsRequest.js" ></script>
    <!-- END TRANSLATE SCRIPTS -->


    <link rel="stylesheet" type="text/css" href="{{$root_path}}google-code-prettify/prettify.css">
    <script type="text/javascript" src="{{$root_path}}google-code-prettify/prettify.js" ></script>


    <!-- GRAMMAR SCRIPTS -->
    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/grammar_check.js" ></script>

    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/lexical_analysis_scripts/lexical_analyzer.js" ></script>

    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/syntax_analysis_scripts/var_dec_syntax_analyzer.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/syntax_analysis_scripts/cond_stmt_syntax_analyzer.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/syntax_analysis_scripts/print_stmt_syntax_analyzer.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/syntax_analysis_scripts/rep_stmt_syntax_analyzer.js" ></script>

    <script type="text/javascript" src="{{$root_path}}js/demo_grammar_scripts/type_checking_scripts/type_check.js" ></script>
    <!-- END GRAMMAR SCRIPTS -->

    <!-- OWN CSS AND JS-->
    <link rel="stylesheet" href="{{$root_path}}css/round.css">
    
    <link rel="stylesheet" type="text/css" href="{{$root_path}}css/demo.css" >
    <script type="text/javascript" src="{{$root_path}}js/demo.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/logout_script.js"></script>
@stop

@section( 'content' )
  <input type="hidden" style="display:none;" id="root_path" value="{{$root_path}}" >  
  <link rel="stylesheet" type="text/css" href="{{$root_path}}css/toolbar.css" />
  <div id="toolbar">
    <ul id="nav">
      <li><a href="{{$root_path}}home" >Home</a></li>
      <li><a href="{{$root_path}}demo" >Demo</a></li>
      <?php if ( Session::get( 'user_id' ) ) { ?><li><a href="{{$root_path}}category">Category</a></li><?php } ?>
      <?php if ( Session::get( 'user_id' ) ) {?> <li><a href="{{$root_path}}profile" >Profile[<?php echo Session::get( 'firstname' ) . " " . Session::get( 'lastname' ); ?>]</a></li> <?php } ?>
      <?php if ( Session::get( 'user_id' ) ) {?> <li><a href="{{$root_path}}ranking" >Ranking</a></li> <?php } ?>
      <?php if ( Session::get( 'user_type_id' ) == 1 ) { ?><li><a href="{{$root_path}}admin">Admin</a></li><?php } ?>
      <?php if ( Session::get( 'user_id' ) ) {?> <li><a href="#" onClick="do_logout();" >Logout</a></li> <?php } else { ?> 
      <li><a href="{{$root_path}}login">Login</a></li> <?php } ?>
    </ul>
  </div>

    <div id="left_side_bar">
        <center>
            <div onclick="javascript:$('#dock_box').html('');" id="clear_box">
                <img src="{{$root_path}}img/trash_can.png" />
                Clear all
            </div><!--end of clear_box-->
        </center>
        <center>
        <div id="trash_box">
            <img class="trash_icon" src="{{$root_path}}img/trash_can.png">
        </div><!--end of trash_box-->
        </center>

        <div id="tags_box" class="">


        <div id="variable_box" class="droptrue">
            <div id="upper_tag_holder">
            <div class="tag_holder">
                <div class="variable_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    Variable
                </div><!--end of variable_icon-->
                <div class="variable" datatype="" identifier="" val=""  id="test_variable"   onMouseUp="get_drop_id(this);">Variable</div><!--end of variable-->
                <br/>
            </div><!--end of tag_holder-->
            </div>
        </div> <!--end of variable_box-->
           

        <div id="println_box" class="droptrue"> 
            <div id="upper_tag_holder">      
            <div class="tag_holder">
                <div class="println_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    println
                </div><!--end of println_icon-->
                <div class="println" val=""  style="background:#0C9;">println()</div endprint><!--end of print-->
                <br/>
            </div><!--end of tag_holder-->
            </div>
        </div><!--end of println_box-->


        <div id="print_box" class="droptrue"> 
            <div id="upper_tag_holder">      
            <div class="tag_holder">
                <div class="print_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    print
                </div><!--end of println_icon-->
                <div class="print" val=""  style="background:#0C9;">print()</div endprint><!--end of print-->
                <br/>
            </div><!--end of tag_holder-->
            </div>
        </div><!--end of print_box-->

            
         

        <div id="if_box" class="droptrue">
            <div id="upper_tag_holder">
            <div  class="tag_holder test">

                <div class="if_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    if
                </div><!--end of if_icon-->

                <div class="if" condition="null==null" id="jomarie" >
                    <div class="upper_box if_upper_box">
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="if_label">if</a></td>
                                <td valign="middle">
                                    <div class="statement_left" >Null</div>
                                </td>
                                <td>
                                    <select class="statement_operator" onChange="add_condition();"> 
                                        <option>==</option>
                                        <option>!=</option>
                                        <option>></option>
                                        <option><</option>
                                        <option>>=</option>
                                        <option><=</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="statement_right" >Null</div>
                                </td>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortables" class="insert_tags insert_tags100 droptrue">

                        </div><!--end of insert_tags-->

                    <div class="bottom_box if_bottom_box"></div><!--end of bottom_box-->
                </div>
                <div class="endif"></div>


                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of if_box-->



        <div id="else_box" class="droptrue">
            <div id="upper_tag_holder">
            <div  class="tag_holder test">

                <div class="if_icon tag_icon">
                     <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    else
                </div><!--end of if_icon-->

                <div class="else"  id="jomarie" >
                    <div class="upper_box else_upper_box">
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="else_label">else</a></td>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortable" class="insert_tags insert_tags100 droptrue">

                        </div><!--end of insert_tags-->

                    <div class="bottom_box else_bottom_box"></div><!--end of bottom_box-->
                </div>
                <div class="endif"></div>


                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of else_box-->





        <div id="else_if_box" class="droptrue">
            <div id="upper_tag_holder">
            <div  class="tag_holder test">
                <div class="elseif_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    else if
                </div><!--end of if_icon-->
                <div class="elseif" condition="null==null" id="jomarie" >
                    <div class="upper_box else_if_upper_box">
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="if_label elseif_label">else if</a></td>
                                <td valign="middle">
                                    <div class="statement_left" >Null</div>
                                </td>
                                <td>
                                    <select class="statement_operator" onChange="add_condition();"> 
                                        <option>==</option>
                                        <option>!=</option>
                                        <option>></option>
                                        <option><</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="statement_right" >Null</div>
                                </td>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortable" class="insert_tags insert_tags100 droptrue">

                        </div><!--end of insert_tags-->

                    <div class="bottom_box else_if_bottom_box"></div><!--end of bottom_box-->
                </div>
                <div class="endif"></div>


                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of else_if_box-->




        <div id="while_box" class="droptrue">
            <div id="upper_tag_holder">
            <div  class="tag_holder test">

                <div class="while_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    while
                </div><!--end of if_icon-->

                <div class="while if" condition="null==null">
                    <div class="upper_box while_upper_box">
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="while_label">while</a></td>
                                <td valign="middle">
                                    <div class="statement_left" >Null</div>
                                </td>
                                <td>
                                    <select class="statement_operator" onChange="add_condition();"> 
                                        <option>==</option>
                                        <option>!=</option>
                                        <option>></option>
                                        <option><</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="statement_right" >Null</div>
                                </td>
                            </tr>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortable" class="insert_tags insert_tags100 droptrue">

                        </div><!--end of insert_tags-->

                    <div class="bottom_box while_bottom_box"></div><!--end of bottom_box-->
                </div>
                <div class="endwhile"></div>


                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of while_box-->



        <div id="dowhile_box" class="droptrue">
            <div id="upper_tag_holder">
            <div  class="tag_holder test">

                <div class="dowhile_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    do while
                </div><!--end of if_icon-->

                <div class="dowhile if">
                    <div class="upper_box dowhile_upper_box">
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="dowhile_label">do</a></td>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortable" class="insert_tags insert_tags100 droptrue">

                        </div><!--end of insert_tags-->

                    <div class="bottom_box dowhile_bottom_box">
                         <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="dowhile_label">while</a></td>
                                <td valign="middle">
                                    <div class="statement_left" >Null</div>
                                </td>
                                <td>
                                    <select class="statement_operator" onChange="add_condition();"> 
                                        <option>==</option>
                                        <option>!=</option>
                                        <option>></option>
                                        <option><</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="statement_right" >Null</div>
                                </td>
                            </tr>
                            </tr>
                        </table>
                    </div><!--end of bottom_box-->
                </div>
                <div class="enddowhile" condition="null==null"></div>


                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of dowhile_box-->



        <div id="forloop_box" class="droptrue">
            <div id="upper_tag_holder">
            <div  class="tag_holder test">

                <div class="forloop_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                  for loop
                </div><!--end of if_icon-->

                <div class="forloop" condition="int x = 0; x < 0; x++;" id="">
                    <div class="upper_box forloop_upper_box">
                        <table border="0" cellpadding="0" cellspacing="0" class="forloop_table">
                            <tr>
                                <td style="padding-right:15px;"><a class="forloop_label">for</a></td>
                                <td>Repeat</td>
                                <td><a class="forloop_field" id="" onclick="">0</a></td>
                                <td>times</td>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortable" class="insert_tags insert_tags100 droptrue">

                        </div><!--end of insert_tags-->

                    <div class="bottom_box forloop_bottom_box"></div><!--end of bottom_box-->
                </div>
                <div class="endforloop"></div>


                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of forloop_box-->



        <div id="switch_case_box" class="droptrue">
            <div id="upper_tag_holder">
            <div class="tag_holder">
                <div class="switch_case_icon tag_icon">
                    <div class="instruction">
                        ?
                        <div class="instruction_box">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                        </div><!--end of instruction_box-->
                    </div><!--end of instruction-->
                    switch case
                </div><!--end of switch_case_icon-->
                 <div class="switch" param="null" datatype="null" id="switch1">
                    <div class="upper_box switch_upper_box" onclick="show_popup('#switch_variable_box','Variable'); get_switch_case_id(1);" id="switch_case1">
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                            <tr>
                                <td><a class="switch_label">switch()</a></td>
                            </tr>
                        </table>
                    </div><!--end of upper_box-->
                    <br/>
                        <div id="sortable" class="insert_tags insert_tags1 droptrue">
                            <div class="switch_case_holder droptrue" id="switch_case_holder1">

                            </div><!--end of switch_case_holder-->
                            <div class="tag_holder">
                                        <div class="casedefault">
                                                    <div class="upper_box case_default_upper_box">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">
                                                            <tr>
                                                                <td><a class="else_label">default</a></td>
                                                            </tr>
                                                        </table>
                                                    </div><!--end of upper_box-->

                                                    <br/>
                                                    <div id="sortable" class="insert_tags insert_tags100 droptrue">
                                                       
                                                    </div><!--end of insert_tags-->

                                                    <div class="bottom_box case_default_bottom_box"></div><!--end of bottom_box-->
                                                </div><!--end of case-->
                                                <div class="endcasedefault"></div>
                                             <br/>
                                </div><!--end of tag_holder-->
                        </div><!--end of insert_tags-->
                    <div class="bottom_box switch_bottom_box"></div><!--end of bottom_box-->
                </div><!--end of switch-->
                <div class="endswitch"></div>
                <br/>
                <div class="add_case_box" title="Add case" onclick="add_case(1);">
                    +
                </div><!--end of add_case_box-->
                <br/>
            </div><!--end of tag_holder-->
        </div>
        </div><!--end of switch_case_box-->







            
          

        </div><!--end of tags_box-->
    </div><!--end of left_side_bar-->


    <div id="dock_box" class="droptrue"></div><!--end of dock_box-->

    <div id="generated_code_box">
      <div id="generate_here"></div>
    </div><!--end of generated_code_box-->


    <button type="button" id="generate_button" class="hard generate_btn" onClick="generateCode(); executeCode();" ><a>Execute Code</a><img src="{{$root_path}}img/play.png" /></button>

    <div id="output_box"></div><!--end of output_box-->

    <?php include(app_path().'/includes/round_modal.php'); ?>
  


@stop