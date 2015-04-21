<?php clearstatcache(); //clear cache ?>

@extends( 'layout/default' )

<input type="hidden" style="display:none;" id="root_path" value="{{$root_path}}" >	


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
    <script type="text/javascript" src="{{$root_path}}js/generate.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/TranslateTags.js" ></script>
	<script type="text/javascript" src="{{$root_path}}js/CorsRequest.js" ></script>
    <!-- END TRANSLATE SCRIPTS -->


    <link rel="stylesheet" type="text/css" href="{{$root_path}}google-code-prettify/prettify.css">
	<script type="text/javascript" src="{{$root_path}}google-code-prettify/prettify.js" ></script>


    <!-- GRAMMAR SCRIPTS -->
    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/grammar_check.js" ></script>

    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/lexical_analysis_scripts/lexical_analyzer.js" ></script>

    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/syntax_analysis_scripts/var_dec_syntax_analyzer.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/syntax_analysis_scripts/cond_stmt_syntax_analyzer.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/syntax_analysis_scripts/print_stmt_syntax_analyzer.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/syntax_analysis_scripts/rep_stmt_syntax_analyzer.js" ></script>

    <script type="text/javascript" src="{{$root_path}}js/grammar_scripts/type_checking_scripts/type_check.js" ></script>
    <!-- END GRAMMAR SCRIPTS -->

    <!-- OWN CSS AND JS-->
    <link rel="stylesheet" type="text/css" href="{{$root_path}}css/round.css">
    <script type="text/javascript" src="{{$root_path}}js/round.js" ></script>
    <script type="text/javascript" src="{{$root_path}}js/problems_syntax_restrictions.js" ></script>
@stop

@section( 'content' )
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



    <table class="problem_table" >
        <tr>
             <td colspan="2" ><kbd class="no_equivalence" >{{$problem_category_descrp}}: Level {{$level}}</kbd></td>
        </tr>
        <tr>
            <td colspan="2" >
                <div id="question_box">
                    <kbd class= <?= ( $problem_category_id == 1 )? 'easy' : ( ( $problem_category_id == 2 )? 'average' : 'hard' ); ?> >Problem Description:</kbd> 
                    <blockquote><a><?= $problem_description ?><a></blockquote>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="problem_status_box" ><kbd class=<?= ( $problem_category_id == 1 )? 'easy' : ( ( $problem_category_id == 2 )? 'average' : 'hard' ); ?> >Problem Status:</kbd> <b></b></div>
            </td>
            <td>
                <b>1 Programmer's Cup <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> = <code>5pts</code></b>
            </td>
        </tr>
        <tr>
            <td>
                <div id="attempts_box"><kbd class= <?= ( $problem_category_id == 1 )? 'easy' : ( ( $problem_category_id == 2 )? 'average' : 'hard' ); ?> >No. of Attempts:</kbd> <b class="no_attempts" ></b></div>
            </td>
            <td>
                <kbd class="no_equivalence" >Attempt(s) Points Equivalence:</kbd>
                <code>1</code> = 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" /> 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />

                <code>2</code> = 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />

                <code>3</code> = 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />

                <code>4</code> = 
                <img class="programmers_trophy" src="{{$root_path}}img/programmers_trophy.png" title="Programmer's Cup" />
               

            </td>
        </tr>
    </table>



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

    <input type="hidden" id="user_id" value="<?= $user_id; ?>" />
    <input type="hidden" id="prob_id" value="<?= $problem_id; ?>" />
    <input type="hidden" id="e_structure" value="<?= $expected_structure; ?>" />
    <input type="hidden" id="e_output" value="<?= $expected_output; ?>" />
    <input type="hidden" id="problem_category_id" value="{{$problem_category_id}}" />

    <div id="dock_box" class="droptrue"></div><!--end of dock_box-->

    <div id="generated_code_box">
    	<div id="generate_here"></div>
    </div><!--end of generated_code_box-->


    <button type="button" id="generate_button" class="<?= ( $problem_category_id == 1 )? 'easy' : ( ( $problem_category_id == 2 )? 'average' : 'hard' ); ?> generate_btn" onClick="generateCode(); executeCode(); show_problem_status();" ><a>Execute Code</a><img src="{{$root_path}}img/play.png" /></button>

    <div id="output_box"></div><!--end of output_box-->
    


<?php include(app_path().'/includes/round_modal.php'); ?>


<!-- POP UP -->
<div id="dialog-confirm">
    Proceed to <b id="cat_name" >Easy</b> Level <b id="level" ></b>?
</div>
<div id="dialog-error">
    <code>Sorry! You haven't met the requirements.</code>
</div>

@stop