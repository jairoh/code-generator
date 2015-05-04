<style>
    * {
        font-size: 13px;
        font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
    } 
</style>
    

    <div id="statement_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td><button onClick="close_box(); show_popup('#statement_variable_box','Variable');">Variable</button></td>
                <td><button onClick="close_box(); show_popup('#input_statement_box','Input');">Input</button></td>
            </tr>
        </table>
       
    </div><!--end of statement_box-->


    <div id="variable_option_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td><button onClick="close_box(); show_popup('#var_dec_box','Variable');">Declare variable</button></td>
                <td><button onClick="close_box(); show_popup('#reuse_variable_box','Choose variable');">Reuse variable</button></td>
            </tr>
        </table>
       
    </div><!--end of variable_option_box-->
    
    
    <div id="statement_variable_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>List of variables:</td>
                <td>
                    <select class="suggested_var">
                        <option>Var 1</option>
                        <option>Var 2</option>
                        <option>Var 3</option>
                    </select>
                </td>
            </tr>
        </table>
        
         <center>
            <div id="box_button_holder">
            <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
            <button id="suggested_var_button" onClick="add_var_statement(); close_box();">Ok</button>
            <button onClick="close_box(); show_popup('#statement_box','Choose');">Cancel</button>
            </div><!--end of box_button_holder-->
        </center>
       
    </div><!--end of statement_variable_box-->




    <div id="reuse_variable_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>List of variables:</td>
                <td>
                    <select class="suggested_var">
                        <option>Var 1</option>
                        <option>Var 2</option>
                        <option>Var 3</option>
                    </select>
                </td>
            </tr>
        </table>
        
         <center>
            <div id="box_button_holder">
            <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
            <button id="suggested_var_button" onClick="reuse_variable(); close_box();">Ok</button>
            <button onClick="close_box(); show_popup('#variable_option_box','Variable option');">Cancel</button>
            </div><!--end of box_button_holder-->
        </center>
       
    </div><!--end of reuse_variable_box-->



    <div id="switch_variable_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>List of variables:</td>
                <td>
                    <select class="switch_suggested_var">
                        <option>Var 1</option>
                        <option>Var 2</option>
                        <option>Var 3</option>
                    </select>
                </td>
            </tr>
        </table>
        
         <center>
            <div id="box_button_holder">
            <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
            <button id="suggested_var_button" onClick="add_switch_parameter(); close_box();">Ok</button>
            <button onClick="close_box();">Cancel</button>
            </div><!--end of box_button_holder-->
        </center>
       
    </div><!--end of switch_variable_box-->



    <div id="input_case_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>Value:</td>
                <td><input class="input_case_val" type="text" onkeyup="close_enter(event.keyCode,'#add_case_button');" /></td>
            </tr>
        </table>
         <center>
        <div id="box_button_holder">
        <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
        <button id="add_case_button" onClick="add_case_value();">Ok</button>
        <button onClick="close_box();">Cancel</button>
        </div><!--end of box_button_holder-->
        </center>
    </div><!--end of input_case_box-->




     <div id="forloop_value_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>Value:</td>
                <td><input class="forloop_value" type="text" onkeyup="close_enter(event.keyCode,'#forloop_button');" /></td>
            </tr>
        </table>
         <center>
        <div id="box_button_holder">
        <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
        <button id="forloop_button" onClick="add_forloop_value();">Ok</button>
        <button onClick="close_box();">Cancel</button>
        </div><!--end of box_button_holder-->
        </center>
    </div><!--end of forloop_box-->



    
    
    <div id="input_statement_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>Data Type:</td>
                <td>
                    <select class="input_statement_type" onchange="statement_option(this.value);">
                        <option>int</option>
                        <option>double</option>
                        <option>String</option>
                        <option>char</option>
                        <option>boolean</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Value:</td>
                <td id="statement_val_holder">
                    <input class="input_statement_val" type="text" onkeyup="close_enter(event.keyCode,'#input_type_button');" />
                    <select style="display:none;" class="input_statement_val_option"><option>true</option><option>false</option></select>
                </td>
            </tr>
        </table>
         <center>
        <div id="box_button_holder">
        <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
        <button id="input_type_button" onClick="add_input_statement();">Ok</button>
        <button onClick="close_box(); show_popup('#statement_box','Choose');">Cancel</button>
        </div><!--end of box_button_holder-->
        </center>
    </div><!--end of input_statement_box-->




        <div id="forloop_statement_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>Variable name:</td>
                <td>
                    <input maxLength="2" class="forloop_var_name" type="text" />
                </td>
            </tr>
            <tr>
                <td>Value:</td>
                <td>
                    <input class="forloop_var_value" type="text" onkeyup="close_enter(event.keyCode,'#input_type_button');" />
                </td>
            </tr>
        </table>
         <center>
        <div id="box_button_holder">
        <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
        <button id="input_type_button" onClick="add_forloop_value();">Ok</button>
        <button onClick="close_box();">Cancel</button>
        </div><!--end of box_button_holder-->
        </center>
    </div><!--end of forloop_statement_box-->


    <div id="forloop_compare_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td><button onClick="close_box(); show_popup('#forloop_variable_box','Variable'); count_forloop_variable();">Variable</button></td>
                <td><button onClick="close_box(); show_popup('#forloop_input_box','Enter integer value');">Input</button></td>
            </tr>
        </table>
       
    </div><!--end of forloop_compare_box-->



    <div id="forloop_input_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>Value:</td>
                <td id="statement_val_holder">
                    <input class="forloop_input_val" type="text" onkeyup="close_enter(event.keyCode,'#input_type_button');" />
                </td>
            </tr>
        </table>
         <center>
        <div id="box_button_holder">
        <img style="display:none;" src="images/loadingtransparent.gif" />
        <button id="input_type_button" onClick="add_forloop_input();">Ok</button>
        <button onClick="close_box(); show_popup('#forloop_compare_box','Choose');">Cancel</button>
        </div><!--end of box_button_holder-->
        </center>
    </div><!--end of input_statement_box-->



    <div id="forloop_variable_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>List of variables:</td>
                <td id="td">
                    <select class="forloop_suggested_var">
                        <option>Var 1</option>
                        <option>Var 2</option>
                        <option>Var 3</option>
                    </select>
                </td>
            </tr>
        </table>
        
         <center>
            <div id="box_button_holder">
            <img style="display:none;" id="" src="images/loadingtransparent.gif" />
            <button id="suggested_var_button" onClick="add_forloop_compare(); close_box();">Ok</button>
            <button onClick="close_box(); show_popup('#forloop_compare_box','Choose');">Cancel</button>
            </div><!--end of box_button_holder-->
        </center>
       
    </div><!--end of statement_variable_box-->

    
    
    
    
    <div id="var_dec_box" class="popup_box">
        <table class="popup_table">
            <tr>
                <td>Data Type:</td>
                <td>
                    <select class="var_dec_type" onchange="select_var_dec(this.value);">
                        <option>int</option>
                        <option>double</option>
                        <option>String</option>
                        <option>char</option>
                        <option>boolean</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Variable name:</td>
                <td><input class="var_dec_name" maxlength="2" type="text" /></td>
            </tr>
            <tr>
                <td>Value:</td>
                <td id="var_dec_val_holder"><input class="var_dec_val" type="text" /></td>
            </tr>
        </table>
         <center>
        <div id="box_button_holder">
        <img style="display:none;" id="load_add_account" src="images/loadingtransparent.gif" />
        <button onClick="declare_variable(); close_box();">Ok</button>
        <button onClick="close_box();">Cancel</button>
        </div><!--end of box_button_holder-->
        </center>
    </div><!--end of var_dec_box-->

<!--END OF MODAL-->