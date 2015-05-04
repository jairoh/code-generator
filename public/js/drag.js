// JavaScript Document

var statement_id = "";
var if_tag_id = "";
var if_id = "";
var if_statement = "";
var variable_id = "";
var print_tag_id = "";
var switch_case_id = "";
var case_self_id = "";
var current_switch_type = "";
var forloop_text_id = "";
var forloop_value_id = "";
var forloop_this = "";
var while_id = "";//for dowhile and while


$(function(){
	
	
	
	
	
});



function close_enter(keyCode, click_id){
	if(keyCode==13){
		alert();
		$(click_id).click();
	}
}



function get_print_id(THIS){
	print_tag_id = THIS;
	count_variable();

	$('#input_type_button').attr("onclick","add_print_value(); close_box();");
	$('#suggested_var_button').attr("onclick","add_var_print(); close_box();");


	$('.input_statement_type').val(0);
	$('.input_statement_val').val('');

	show_popup('#statement_box','');

}//end of get_print_id

function add_print_value(){

	var type = $('.input_statement_type').val();
	var val = $('.input_statement_val').val();
	
	if(type=="String"){
		$(this.print_tag_id).attr('val', '\"' + val + '\"' );
		$(this.print_tag_id).text('println("'+val+'")');
	}
	else if(type=="int"||type=="double"||type=="long"||type=="float"||type=="boolean"){
		$(this.print_tag_id).attr('val', val );
		$(this.print_tag_id).text($(this.print_tag_id).attr('class')+'('+val+')');
		
	}
	else if(type=="char"){
		$(this.print_tag_id).attr('val', "\'" + val + "\'" );
		$(this.print_tag_id).text($(this.print_tag_id).attr('class')+"('"+val+"')");
	}

	$(this.print_tag_id).attr("datatype",type);
	
	save_structure();
	
}//end of add_print_value



function print_current_val(){
	
	var print_datatype = $(this.print_tag_id).attr("datatype");
	var print_val = $(this.print_tag_id).attr('val');

	if(print_datatype=="String"){
		print_val = print_val.replace(/"/g,"");
	}
	else if(print_datatype=="char"){
		print_val = print_val.replace(/'/g,"");
	}

	$('.input_statement_type').val(print_datatype);
	$('.input_statement_val').val(print_val);
	
}//end


function add_var_print(){
	var var_name = $('.suggested_var').val();
	$(this.print_tag_id).attr('val', var_name );
	$(this.print_tag_id).text("println("+var_name+")");

	save_structure();

}//end of add_var_print

function get_drop_id(id){
	//alert(id);
}//end of get_drop_id


function count_variable(){
	var suggested_var = "";
	$('#dock_box .variable').each(function(index, element) {
		if($(this).attr('identifier')){
			suggested_var+="<option>"+$(this).attr('identifier')+"</option>";
    	}
		$(this).attr('onclick',"show_popup('#var_dec_box','Variable'); get_variable_id(this);");


    });
	
	$('.suggested_var').html(suggested_var);

	
}//end of count_variable


function count_forloop_variable(){

	var forloop_suggested_var = "";
	$('#dock_box .variable').each(function(index, element) {

		//suggest int type only for forloop variable
		if($(this).attr('datatype')=='int'){
			forloop_suggested_var+="<option>"+$(this).attr('identifier')+"</option>";
		}

    });


	//get all the parent forloop variables
	$(this.forloop_this).parents('.forloop').each(function(){
		forloop_suggested_var+="<option>"+$('.statement_left:first', this).text().split(" ")[0]+"</option>";
	});

	$('.forloop_suggested_var').html(forloop_suggested_var);



}//end function

function count_switch_variable(){
	var suggested_var = "";
	$('#dock_box .variable').each(function(){
		if($(this).attr('datatype')=='String'){
			suggested_var += "<option  datatype='String' value='"+$(this).attr('identifier')+"'>( String ) "+$(this).attr('identifier')+"</option>";
		}
		if($(this).attr('datatype')=='int'){
			suggested_var += "<option datatype='int' value='"+$(this).attr('identifier')+"'>( int ) "+$(this).attr('identifier')+"</option>";
		}
		if($(this).attr('datatype')=='char'){
			suggested_var += "<option datatype='char' value='"+$(this).attr('identifier')+"'>( char ) "+$(this).attr('identifier')+"</option>";
		}
	});

	
	$('.switch_suggested_var').html(suggested_var);

	 inherit_var_datatype();


}//end of count_switch_variable

function count_print(){

	$('#dock_box .println').each(function(){
		$(this).attr('onclick','get_print_id(this);  print_current_val();');
	});

	$('#dock_box .print').each(function(){
		$(this).attr('onclick','get_print_id(this);  print_current_val();');
	});
}//end of count_print



function count_if(){
	var count=1;

	$('#dock_box .if').each(function(){
		$(this).attr("id","if_id"+count);


		if($(this).attr("class")=="while if"){
			$(".bottom_box",this).attr("onclick","get_while_id("+count+");");

			$(".while_bottom_box .while_counter_var",this).attr("id","while_counter_var"+count);
			$(".while_bottom_box .while_counter_operator",this).attr("id","while_counter_operator"+count);
			$(".while_bottom_box .while_counter_by",this).attr("id","while_counter_by"+count);
		}

		if($(this).attr("class")=="dowhile if"){
			$(".dowhile_upper_box",this).attr("onclick","get_while_id("+count+");");
			$(".dowhile_bottom_box",this).attr("onclick","get_while_id("+count+");");

			$(".dowhile_upper_box .while_counter_var",this).attr("id","while_counter_var"+count);
			$(".dowhile_upper_box .while_counter_operator",this).attr("id","while_counter_operator"+count);
			$(".dowhile_upper_box .while_counter_by",this).attr("id","while_counter_by"+count);
			
		}



		$(".upper_box",this).attr("onclick","get_if_id("+count+");");
		$(".statement_operator",this).attr("class","statement_operator statement_operator"+count);

		//left statement
		$(".statement_left",this).attr('onclick',"show_popup('#statement_box','Choose'); get_statement_id('.statement_left"+count+"',"+count+",'left'); count_variable();");
		$(".statement_left",this).attr('class','statement_left statement_left'+count);

		//right statement
		$(".statement_right",this).attr('onclick',"show_popup('#statement_box','Choose'); get_statement_id('.statement_right"+count+"',"+count+",'right'); count_variable();");	
		$(".statement_right",this).attr('class','statement_right statement_right'+count);

		count++;
	});

	/*
	count = 1;
	$('#dock_box .statement_left').each(function(){
		$(this).attr('onclick',"show_popup('#statement_box','Choose'); get_statement_id('.statement_left"+count+"',"+count+",'left'); count_variable();");
		$(this).attr('class','statement_left statement_left'+count);
		count++;
	});

	count=1;
	$('#dock_box .statement_right').each(function(){
		$(this).attr('onclick',"show_popup('#statement_box','Choose'); get_statement_id('.statement_right"+count+"',"+count+",'right'); count_variable();");	
		$(this).attr('class','statement_right statement_right'+count);
	count++;
	});


	*/

}//end of count_if


function count_forloop(){
	var count = 1;
	$('#dock_box .forloop').each(function(){
		$(this).attr('id','forloop'+count);
		$('#forloop'+count+' .forloop_field').attr('id','forloop_field'+count);
		$('#forloop'+count+' .forloop_field').attr('onclick',"show_popup('#forloop_value_box','Repeat value'); get_forloop_id('#forloop"+count+"','#forloop_field"+count+"');");
		count++;
	});
}//end of count_forloop


function get_while_id(id){
	this.if_tag_id = "#if_id"+id;
	this.while_id = id;
	this.if_id = id;
}//end 


function get_if_id(id){
	this.if_tag_id = "#if_id"+id;
	this.if_id = id;
}//end get_if_id


function get_statement_id(THIS, if_id, if_statement){
	this.if_statement = if_statement;
	this.statement_id = THIS;
	this.if_tag_id = "#if_id"+if_id;
	this.if_id = if_id;
	if($(this.if_tag_id).attr("class")=="while if"||$(this.if_tag_id).attr("class")=="dowhile if"){
		this.while_id = if_id;
		//alert(if_id);
	}


	$('#input_type_button').attr("onclick","add_input_statement(); close_box();");
	$('#suggested_var_button').attr("onclick","add_var_statement(); close_box();");

	$('.input_statement_type').val(0);
	$('.input_statement_val').val('');


	//statement_option($('.input_statement_val').val());



	//current if statement value
	var datatype = "";
	var value = "";

	if(if_statement=="left"){
		datatype = $(this.if_tag_id+' .statement_left').attr('datatype');
		value = $(this.if_tag_id+' .statement_left').attr('value');
	}
	else if(if_statement=="right"){
		datatype = $(this.if_tag_id+' .statement_right').attr('datatype');
		value = $(this.if_tag_id+' .statement_right').attr('value');
	}

	statement_option(datatype);

	if(datatype=="String"){
		value = value.replace(/"/g,"");
	}
	else if(datatype=="char"){
		value = value.replace(/'/g,"");
	}

	$('.input_statement_type').val(datatype);
	$('.input_statement_val').val(value);

	

}//end of get_statement_id


function get_switch_case_id(ID){
	this.switch_case_id = ID;
}//end of get_switch_case_id


function get_case_id(THIS, id){
	this.case_self_id = THIS;
	this.current_switch_type = $('#switch'+id).attr('datatype');
	//alert(current_switch_type);
}//end of get_case_id

function get_forloop_id(forloop_value_id, forloop_text_id){
	
	this.forloop_value_id = forloop_value_id;
	this.forloop_text_id = forloop_text_id;
	$('.forloop_value').val($(forloop_text_id).text());
}


function get_forloop_this(self){
	this.forloop_this = self;
	this.forloop_this = $(this.forloop_this).closest('.forloop').get(0);//get the object element of the forloop class	

}


function get_forloop_text_id(THIS){
	this.forloop_text_id = THIS;
	$('.forloop_value').val($(forloop_text_id).text());
	//alert($(forloop_id).text());
}

//inherit the variable type of the switch value
function inherit_var_datatype(){
	$('#dock_box .switch').each(function(){
		var switch_self = this;
		var var_name = $(this).attr('param');
		$('.switch_suggested_var option').each(function(){
			if(var_name==$(this).attr('value')){
				$(switch_self).attr('datatype',$(this).attr('datatype'));
			}
		});
	});
}//end of inherit_var_datatype


function add_input_statement(){
	
	var type = $('.input_statement_type').val();

	//$(this.statement_id).text($('.input_statement_type').val()+"( "+$('.input_statement_val').val()+" )");
	
	if(type=="String"){
		$(this.statement_id).text('"'+$('.input_statement_val').val()+'"');
	}
	else if(type=="char"){
		$(this.statement_id).text("'"+$('.input_statement_val').val()+"'");
	}
	else {
			$(this.statement_id).text($('.input_statement_val').val());
	}
	
	
	//store statement value and data type
	$(if_tag_id+' '+statement_id).attr('datatype',$('.input_statement_type').val());
	$(if_tag_id+' '+statement_id).attr('value',$('.input_statement_val').val());
	$(if_tag_id+' '+statement_id).attr('variable',"");
	
	add_condition();
	
}//end of add_input_statement


function reuse_variable(){
	alert();
}//end of use_variable

function add_var_statement(){
	$(if_tag_id+' '+statement_id).attr('variable',$('.suggested_var').val());
	$(this.statement_id).text($('.suggested_var').val());
	add_condition();
}//end of add_var_statement


function add_switch_parameter(){

	

	$('#switch_case'+switch_case_id+" .switch_label").text("switch( "+$('.switch_suggested_var').val()+" )");
	$('#switch'+switch_case_id).attr('param',$('.switch_suggested_var').val());

	var datatype = $('.switch_suggested_var option:selected').attr('datatype');
	$('#switch'+switch_case_id).attr('datatype',datatype);

	save_structure();

}//end of add_switch_parameter


function statement_option(datatype){
	if(datatype=="boolean"){
		//$('#statement_val_holder').html('<select class="input_statement_val"><option>true</option><option>false</option></select>');
		$('#statement_val_holder input').attr("class","").hide();
		$('#statement_val_holder select').attr("class","input_statement_val").show();
	}
	else {
		//$('#statement_val_holder').html('<input class="input_statement_val" type="text" />');
		$('#statement_val_holder select').attr("class","").hide();
		$('#statement_val_holder input').attr("class","input_statement_val").show();
		
	}
}//end of statement_option


function add_condition(){
	
	var condition = "";
	
	var operator = $(this.if_tag_id+' .statement_operator'+this.if_id).val();
	

	if(operator==">"){
		operator = "&gt;";
		
	}
	else if(operator=="<"){
		operator = "&lt;";
	}
	else if(operator==">="){
		operator = "&gt;=";
	}
	else if(operator=="<="){
		operator = "&lt;=";
	}

	


	//left statement
	var left_datatype = $(this.if_tag_id+' .statement_left'+this.if_id).attr('datatype');
	var left_value = $(this.if_tag_id+' .statement_left'+this.if_id).attr('value');
	var left_variable = $(this.if_tag_id+' .statement_left'+this.if_id).attr('variable');


	//input statement
	if(left_variable==""){
		if(left_datatype=="String"){
			condition+="\""+left_value+"\""+operator;
		} else if (left_datatype=="char") {
			condition+="'"+left_value+"'"+operator;
		}
		else if(left_datatype=="int"||left_datatype=="double"||left_datatype=="long"||left_datatype=="float"||left_datatype=="boolean"){
			condition+=left_value+operator;
		}
	}
	//variable statement
	else {
		condition+=left_variable+operator;
	}
	
	//right statement
	var right_datatype = $(this.if_tag_id+' .statement_right'+this.if_id).attr('datatype');
	var right_value = $(this.if_tag_id+' .statement_right'+this.if_id).attr('value');
	var right_variable = $(this.if_tag_id+' .statement_right'+this.if_id).attr('variable');
	
	
	
	//input statement
	if(right_variable==""){
		if(right_datatype=="String"){
			condition+="\""+right_value+"\"";
		} 
		else if ( right_datatype=="char" ) {
			condition+="'"+right_value+"'";
		}
		else if(right_datatype=="int"||right_datatype=="double"||right_datatype=="long"||right_datatype=="float"||right_datatype=="boolean"){
			condition+=right_value;

		}
	}
	//variable statement
	else {
		condition+=right_variable;
	}
	
	if($(this.if_tag_id).attr("class")=="if"||$(this.if_tag_id).attr("class")=="while if"||$(this.if_tag_id).attr("class")=="elseif if"){
		
		$(this.if_tag_id).attr('condition',condition);
	}
	else {
		if($(this.if_tag_id).attr("class")=="dowhile if"){
			
			$(this.if_tag_id).next().next().attr('condition',condition);
		}
		else {
			
			$(this.if_tag_id).next().attr('condition',condition);
		}
	}


	//store the variable for while counter
	if($(this.if_tag_id).attr('class')=="while if"||$(this.if_tag_id).attr('class')=="dowhile if"){
		
		var counter_val = [];
		if(left_variable){
			counter_val.push(left_variable);
		}
		
		if(right_variable){
			counter_val.push(right_variable);
		}

		$(this.if_tag_id).attr('var_counter',counter_val);

		var option = "";
		var current_option = "";

		for(var x=0;x<counter_val.length;x++){
			if(current_option==counter_val[x]){
				alert("break");
				break;
			}
			option+="<option>"+counter_val[x]+"</option>";
			current_option = counter_val[x];
		}
		
		//alert(this.while_id);
		//alert("#while_counter_var"+this.while_id);
		$("#while_counter_var"+this.while_id).html(option);

		set_while_counter_value();
	}


	save_structure();


}//end of add_condition


function set_while_counter_value(){
	var counter_var = $("#while_counter_var"+this.while_id).val();
	var operator = $("#while_counter_operator"+this.while_id).val();
	var add = $("#while_counter_by"+this.while_id).val();
	$(this.if_tag_id).next().attr('value',counter_var+" = "+counter_var+" "+operator+" "+add+";");
}//end 



function forloop_condition(val, e){

	if(e.keyCode>=48&&e.keyCode<=57){
		
	}
	else {
		e.preventDefault();
	}

	if(e.keyCode==13){
		alert(val);
	}
}//end of forloop_condition



function forloop_current_value(){
	var initialized_var = $('.statement_left:first', this.forloop_this).text().split(" = ");//the first element of forloop

	var variable_name = initialized_var[0];
	var value = initialized_var[1];
	
	$('.forloop_var_name').val(variable_name);
	$('.forloop_var_value').val(value);


}//end function



function add_forloop_value(){


	var variable_name = $('.forloop_var_name').val();
	var value = $('.forloop_var_value').val();

	$('#forloop_input_text:first', this.forloop_this).text(variable_name+' = '+value);
	close_box();
	add_forloop_condition();
}//end function

function add_forloop_compare(){
	
	$('.statement_right:first', this.forloop_this).text($('.forloop_suggested_var').val());
	add_forloop_condition();
}//end function


function add_forloop_input(){
	$('.statement_right:first', this.forloop_this).text($('.forloop_input_val').val());
	$('.forloop_input_val').val('');
	close_box();

	add_forloop_condition();
	
}//end function


function add_forloop_condition(){


	var initialized_var = $('.statement_left:first', this.forloop_this).text();//the first element of forloop

	var operator = $('.forloop_operator:first', this.forloop_this).val();//operator of the second element

	//$('.forloop_operator:first option:selected', this.forloop_this).attr('selected','selected');

	var static_var = $('.statement_right:first', this.forloop_this).text();//value after the operator
	var in_dec_crement = $('.in_dec_crement:first', this.forloop_this).val();//increment or decrement value
	var in_dec_crement_by = $('.in_dec_crement_by:first', this.forloop_this).val();//how to many to increment or decrement in each loop


	if(operator==">"){
		operator = "&gt;";
		
	}
	else if(operator=="<"){
		operator = "&lt;";
	}
	else if(operator==">="){
		operator = "&gt;=";
	}
	else if(operator=="<="){
		operator = "&lt;=";
	}

	
	if(in_dec_crement==1){
		in_dec_crement = "+=";
	}
	else {
		in_dec_crement = "-=";
	}


	$(this.forloop_this).attr('condition', "int "+initialized_var+"; "+initialized_var.split(" ")[0]+" "+operator+" "+static_var+"; "+initialized_var.split(" ")[0]+in_dec_crement+""+in_dec_crement_by);

	//alert("int "+initialized_var+"; "+initialized_var.split(" ")[0]+" "+operator+" "+static_var+"; "+initialized_var.split(" ")[0]+in_dec_crement+""+in_dec_crement_by);

	save_structure();

}//end function	

/*
function add_forloop_value(){

	    
	var variables = "abcdefghijklmnopqrstuvwxyz";
	var forloop_id = parseInt(forloop_value_id.replace('#forloop',''));
	var forloop_var = variables.charAt((forloop_id - 1));
 	
	if($(forloop_value_id).attr('current_variable')){
		forloop_var = $(forloop_value_id).attr('current_variable');
	}
	
	$(forloop_text_id).text($('.forloop_value').val());
	$(forloop_value_id).attr('condition',"int "+forloop_var+" = 0; "+forloop_var+" < "+$('.forloop_value').val()+"; "+forloop_var+"++");
	$(forloop_value_id).attr('current_variable',forloop_var);
	close_box();


	save_structure();


}//end of add_forloop_value

*/



//////////VARIABLE DECLARATION

function get_variable_id(variable_id){

	this.variable_id = variable_id;

	select_var_dec($('.var_dec_type').val());



	$('.var_dec_type').val($(variable_id).attr('datatype'));
	$('.var_dec_name').val($(variable_id).attr('identifier'));
	$('.var_dec_val').val($(variable_id).attr('val'));

	

}//end of get_variable_id


function select_var_dec(val){
	if(val=="boolean"){
		$('#var_dec_val_holder').html('<select class="var_dec_val"><option>true</option><option>false</option></select>');
	}
	else {
		$('#var_dec_val_holder').html('<input class="var_dec_val" type="text" />');
	}
}

function declare_variable(){
	
	var datatype = $('.var_dec_type').val();
	var name = $('.var_dec_name').val();
	var value = $('.var_dec_val').val();
	
	$(this.variable_id).attr("datatype",datatype);
	$(this.variable_id).attr("identifier",name);
	$(this.variable_id).attr("val",value);
	
	if(datatype=="String"){
		value = '"'+value+'"';
	}
	if(datatype=="char"){
		value = "'"+value+"'";
	}
	
	$(this.variable_id).text(name+" = "+value+" ");


	count_switch_variable();

	save_structure();
	
}//end of declare_variable




function add_case(id){
	//alert(id);
	$('#switch_case_holder'+id).append('<div id="upper_tag_holder"><div class="tag_holder">\
                <div class="case" case="null">\
                    <div class="upper_box case_upper_box">\
                        <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
                            <tr>\
                                <td><a class="case_label">case</a></td>\
                            </tr>\
                        </table>\
                    </div><!--end of upper_box-->\
                    \
                    <br/>\
                    <div id="sortable" class="insert_tags insert_tags100 droptrue">\
                        \
                    </div><!--end of insert_tags-->\
                    \
                    <div class="bottom_box case_bottom_box"></div><!--end of bottom_box-->\
                </div><!--end of case-->\
                <div class="endcase"></div>\
                 <br/>\
            </div></div><!--end of tag_holder-->');


	$( "div.droptrue").sortable({
  		connectWith: "div",
	});





	//add id to all case
	var count = 0;
	$('.case').each(function(){
		count++;
		$(this).attr('id','case'+count);
	});

	count = 0;

	$('.case .upper_box').each(function(){
		count++;
		$(this).attr('onclick',"show_popup(\'#input_case_box\',\'Case value\'); get_case_id("+count+","+id+");");
	});

	save_structure();

}//end of add_Case


function add_case_value(){
	
	

	var case_label = "null";

	if(current_switch_type=='String'){
		case_label = '"'+$('.input_case_val').val()+'"';
		$('#case'+case_self_id).attr('case','\"'+$('.input_case_val').val()+'\"');
	}
	else if(current_switch_type=='int'){
		case_label = $('.input_case_val').val();
		$('#case'+case_self_id).attr('case',$('.input_case_val').val());
	}
	else if(current_switch_type=='char'){
		case_label = "'"+$('.input_case_val').val()+"'";
		$('#case'+case_self_id).attr('case',"'"+$('.input_case_val').val()+"'");
	}

	$('#case'+case_self_id+' .case_label').text("case "+case_label+":");

	$('.input_case_val').val('');
	
	close_box();

	//alert(current_switch_type);

	save_structure();

}//end of add_case_value



function save_structure(){
	//save the current tag structure
	setTimeout(function(){
		localStorage.setItem("current_structure",$('#dock_box').html());
	},500);
}//end save_structure


function test_loop(t){
	alert($(t).closest('.popup_box').attr('id'));
}





 

