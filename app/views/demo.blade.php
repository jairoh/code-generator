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
      <?php if ( Session::get( 'user_id' ) ) {?> <li><a href="{{$root_path}}logout">Logout</a></li> <?php } else { ?> 
      <li><a href="{{$root_path}}login">Login</a></li> <?php } ?>
    </ul>
  </div>

      <div id="left_side_bar">

         <center>
            <div onclick="javascript:$('#dock_box').html('');" id="clear_box">
                <img src="{{$root_path}}img/trash_can.png" /><span>Clear all</span>
            </div><!--end of clear_box-->
        </center>


        <center>
        <div id="trash_box">
            <img class="trash_icon" src="{{$root_path}}img/trash_can.png">
        </div><!--end of trash_box-->
        </center>

        <div id="tags_box" class="">

            <div id="variable_box" class="droptrue"></div> <!--end of variable_box-->
            <div id="print_box" class="droptrue"> </div><!--end of print_box-->
            <div id="if_box" class="droptrue"></div><!--end of if_box-->
            <div id="else_box" class="droptrue"></div><!--end of else_box-->
            <div id="else_if_box" class="droptrue"></div><!--end of else_if_box-->
            <div id="while_box" class="droptrue"></div><!--end of while_box-->
            <div id="dowhile_box" class="droptrue"></div><!--end of dowhile_box-->
            <div id="forloop_box" class="droptrue"></div><!--end of forloop_box-->
            <div id="switch_case_box" class="droptrue"></div><!--end of switch_case_box-->

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