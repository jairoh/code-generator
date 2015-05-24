<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $page_title ?></title>
    
    <script type="text/javascript" src="{{$root_path}}js/jquery.js"></script>

    <link rel="stylesheet" href="{{$root_path}}css/login.css " />
    
    <link href="{{$root_path}}css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{$root_path}}js/bootstrap.min.js" ></script>


</head>

<body> 

	<div id="header_holder">
    	<div id="main_header">
        
            <div id="logo_box">
            	<img src="{{$root_path}}img/CFG_logo.png" />
            </div><!--end of logo_box-->
        
        	<table id="login_table">
            
            <?= Form::open( array('url' => 'login/do_login' ) ) ?>	
                <tr>
                    <td>E-mail Address:</td>
                    <td>Password:</td>
                </tr>
                <tr>
                    <td>
                        <span class="req" >*</span><input class="form-control" name="email" value="<?= Input::old( 'email') ?>" type="email" placeholder="Enter email">
                    </td>
                    <td>
                        <span class="req" >*</span><input type="password" name="password" class="form-control" placeholder="Enter password">
                    </td>
                    <td><button type="submit" id="login_button" class="btn btn-success" >Login</button></td>
                </tr>
                <tr>
                    <?php if ( $errors->first( 'email' ) == 'The email field is required.' || 
                                $errors->first( 'password' ) == 'The password field is required.' ): ?>
                            <td></td>
                            <td ><span class="error_text">Required fields (*)</span></td>  
                    <?php else: ?>
                            <td></td>
                            <td><?= @$errors->first( 'password', '<span class="error_text" >:message</span>' ) ?></td>
                    <?php endif; ?>

                </tr>

            <?= Form::close(); ?>

            </table>
        </div><!--end of main_header-->
    </div><!--end of header_holder-->
    
     <!-- NAV BAR -->
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
    <!-- END NAV BAR -->



    <div id="content_holder">
    	<div id="main_content">
        	
            <div id="left_content">
            	<div id="slider_holder">
                Try the <b id="c1">Code</b> <b id="f">Fragment</b> <b id="c2">Compiler</b>... <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ...and enjoy building programs!
                </div><!--end of slider_holder-->
            </div><!--end of left_content-->
            
            
            <div id="right_content">
            	
                <span id="signup_text">Sign Up</span>
                <span id="signup_text_bottom">if you don't have an account</span>
                
                <?= Form::open( array('url' => 'login/do_signup' ) ) ?>  

                	<table border="0" id="signup_table">
                    	<tr>
                        	<td colspan="3" ><span class="req" >*</span><input class="form-control" name="Firstname" value="<?= Input::old( 'Firstname') ?>" type="text" placeholder="Firstname"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" ><span class="req" >*</span><input class="form-control" name="Lastname" value="<?= Input::old( 'Lastname') ?>" type="text" placeholder="Lastname"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" ><span class="req" >*</span><input class="form-control" name="Email" value="<?= Input::old( 'Email') ?>" type="email" placeholder="Enter email"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" ><span class="req" >*</span><input class="form-control" name="Password" type="password" placeholder="Enter password"></td>
                        </tr>
                        <tr>
                            <td colspan="3" ><span class="req" >*</span><input class="form-control" name="Password_confirmation" type="password" placeholder="Confirm password"></td>
                        </tr>
                        <tr>
                            <td>
                                <label id="maleRB" >
                                    <input type="radio" name="Gender" value="1" checked> Male
                                </label>
                            </td>
                            <td>
                                <label id="femaleRB" >
                                    <input type="radio" name="Gender" value="2" > Female
                                </label>
                            </td>
                            <td>
                                <button type="submit" id="login_button" class="btn btn-success" >Sign Up</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" >
                                <?php if( count( $errors ) ): ?>
                                    
                                    <?php if ( $errors->first( 'Firstname' ) == 'The firstname field is required.' || 
                                            $errors->first( 'Lastname' ) == 'The lastname field is required.' ||
                                            $errors->first( 'Email' ) == 'The email field is required.' || 
                                            $errors->first( 'Password' ) == 'The password field is required.' ): ?>
                                        <div class="alert alert-danger" role="alert">
                                            Required fields (*)    
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $errors->first( 'Email' ); ?>
                                             <?= $errors->first( 'Password_confirmation' ); ?>    
                                        </div>
                                    <?php endif; ?>

                                    
                                <?php endif; ?>   
                                <?php if ( Session::get( 'reg_message' ) ): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= Session::get( 'reg_message' ); ?>
                                    </div> 
                                <?php endif; ?>

                            </td>
                        </tr>
                    </table>
                <?= Form::close(); ?>
            </div><!--end of right_content-->



            
        </div><!--end of main_content-->
    

    </div><!--end of content_holder-->
    
    <div id="footer_holder">
    	<div id="main_footer">
        </div><!--end of main_footer-->
    </div><!--end of footer_folder-->

     

</body>
</html>
