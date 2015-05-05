
	var undo_arr = new Array();


		$(function(){

			
			//retrieve current structure when the page is refresh
			$('#dock_box').html(localStorage.getItem('current_structure'));

			count_tags();

			refresh_tag_box(true);

            $('.instruction').on('click',function(){
				$(".instruction_box",this).toggle();
			});
			
	

	/*
			Sortable.create(if_box, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});

			Sortable.create(else_box, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});

			Sortable.create(variable_box, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});


			Sortable.create(dock_box, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});

			Sortable.create(sortables, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});

			Sortable.create(else_if_box, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});

			Sortable.create(print_box, {
				group: "words",
				animation: 150,
				onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:', evt.item);},
				onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
			});
			*/

			$("#dock_box").droppable({
		        drop: function( ) {
		            	
						setTimeout(function(){
						remove_icon();
						refresh_tag_box(true);
						count_variable(); 
						//count_switch_variable();
						count_print();
						count_if();
						count_forloop();
						//count_while();

						save_structure();
						
			},50);
					}
					
		    });


	function count_tags(){
		count_variable(); 
		count_print();
		count_if();
		count_forloop();
	}//end count_tags

	
	$('#tags_box').droppable({
			drop:function(event, ui){
				//ui.draggable.remove();
				refresh_tag_box();
				
			}
		});

	

	$('#trash_box').droppable({
			drop:function(event, ui){
				$('#trash_box').removeClass('active');
				save_structure();
				ui.draggable.remove();
				refresh_tag_box(true);
				//alert(event.target.class);
			},
			over:function(){
				//alert();
				$('#trash_box').addClass('active');
			},
			out:function(){
				//alert();
				$('#trash_box').removeClass('active');
			}
	});

	//remove all current structure
	$('#clear_box').click(function(){
		localStorage.setItem("current_structure",'');
	});



		function save_structure(){
			//save the current tag structure
			setTimeout(function(){
				localStorage.setItem("current_structure",$('#dock_box').html());
			},500);
			
		}//end save_structure



		function remove_icon(){
		
			/*
			$('#dock_box .if_icon').each(function(){
				$(this).remove();
			});

			$('#dock_box .elseif_icon').each(function(){
				$(this).remove();
			});
			*/

			$('#dock_box .tag_icon').each(function(){
				$(this).remove();
			});


			
		}//end of remove_icon
		
		
		function refresh_tag_box(isSortable){

			//variable
			$('#variable_box').html('<div id="upper_tag_holder"><div class="tag_holder">\
				<div class="variable_icon tag_icon">\
                <div class="instruction">\
                    ?\
                    <div class="instruction_box">\
						A variable is a container that holds values that are used in a Java program. Every variable must be declared to use a data type. For example, a variable could be declared to use one of the eight primitive data types: byte, short, int, long, float, double, char or boolean. And, every variable must be given an initial value before it can be used.\
						Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/variables.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/variables.html</a>\
                    </div><!--end of instruction_box-->\
                </div><!--end of instruction-->\
                Variable\
            </div><!--end of variable_icon-->\
				<div class="variable" datatype="" identifier="" val=""  id="test_variable" >Variable</div><!--end of variable-->\
				<br/>\
				</div></div><!--end of tag_holder-->');
		
			//println
			$('#println_box').html('<div id="upper_tag_holder"><div class="tag_holder">\
				<div class="println_icon tag_icon">\
                <div class="instruction">\
                    ?\
                    <div class="instruction_box">\
                        This stream is already open and ready to display output or another output destination specified by the host environment or user.\
                        Read More: <a href="http://docs.oracle.com/javase/7/docs/api/java/lang/System.html#out" target="_blank" >http://docs.oracle.com/javase/7/docs/api/java/lang/System.html#out</a>\
                    </div><!--end of instruction_box-->\
                </div><!--end of instruction-->\
                println\
            </div><!--end of println_icon-->\
				<div class="println" val="" style="background:#0C9;">println()</div endprint><!--end of print-->\
				<br/>\
    			</div></div><!--end of tag_holder-->');




			$('#print_box').html('<div id="upper_tag_holder"><div class="tag_holder">\
				<div class="println_icon tag_icon">\
                <div class="instruction">\
                    ?\
                    <div class="instruction_box">\
                         This stream is already open and ready to display output or another output destination specified by the host environment or user.\
                         Read More: <a href="http://docs.oracle.com/javase/7/docs/api/java/lang/System.html#out" target="_blank" >http://docs.oracle.com/javase/7/docs/api/java/lang/System.html#out</a>\
                    </div><!--end of instruction_box-->\
                </div><!--end of instruction-->\
                print\
            </div><!--end of println_icon-->\
				<div class="print" val="" style="background:#0C9;">print()</div endprint><!--end of print-->\
				<br/>\
    			</div></div><!--end of tag_holder-->');


		
			//if
			$('#if_box').html(' <div id="upper_tag_holder"><div  class="tag_holder test">\
									<div class="if_icon tag_icon">\
									<div class="instruction">\
					                    ?\
					                    <div class="instruction_box">\
					                        The if statement tells your program to execute a certain section of code only if a particular test evaluates to true. \
 					                        Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/if.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/if.html</a>\
 					                    </div><!--end of instruction_box-->\
					                </div><!--end of instruction-->\
									if\
    								</div><!--end of if_icon-->\
									<div class="if" condition="null==null" id="jomarie" >\
										<div class="upper_box">\
							               	<table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
							                	<tr>\
							                		<td><a class="if_label">if</a></td>\
							                		<td valign="middle">\
							                        	<div class="statement_left" >Null</div>\
							                		</td>\
							                		<td>\
							                            <select class="statement_operator" onChange="add_condition();"> \
							                                <option>==</option>\
							                                <option>!=</option>\
							                                <option>></option>\
							                                <option><</option>\
							                                <option>>=</option>\
                                    						<option><=</option>\
							                            </select>\
							                		</td>\
							                        <td>\
							                           	<div class="statement_right" >Null</div>\
							                        </td>\
							                	</tr>\
							                </table>\
										</div><!--end of upper_box-->\
										<br/>\
											<div id="" class="insert_tags insert_tags100 droptrue">\
											</div><!--end of insert_tags-->\
										<div class="bottom_box"></div><!--end of bottom_box-->\
									</div>\
									<div class="endif"></div><!--end of if-->\
									<br/>\
								</div></div><!--end of tag_holder-->');



			$('#else_if_box').html('<div id="upper_tag_holder"><div  class="tag_holder test">\
									<div class="elseif_icon tag_icon">\
									<div class="instruction">\
					                    ?\
					                    <div class="instruction_box">\
					                        The else if statement provides a secondary path of execution when an "if" clause evaluates to false. \
	                				        Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/if.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/if.html</a>\
					                    </div><!--end of instruction_box-->\
					                </div><!--end of instruction-->\
									else if\
    								</div><!--end of if_icon-->\
									<div class="elseif if" condition="null==null" id="jomarie" >\
										<div class="upper_box">\
							               	<table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
							                	<tr>\
							                		<td><a class="if_label elseif_label">else if</a></td>\
							                		<td valign="middle">\
							                        	<div class="statement_left" >Null</div>\
							                		</td>\
							                		<td>\
							                            <select class="statement_operator" onChange="add_condition();"> \
							                                <option>==</option>\
							                                <option>!=</option>\
							                                <option>></option>\
							                                <option><</option>\
							                            </select>\
							                		</td>\
							                        <td>\
							                           	<div class="statement_right" >Null</div>\
							                        </td>\
							                	</tr>\
							                </table>\
										</div><!--end of upper_box-->\
										<br/>\
											<div id="" class="insert_tags insert_tags100 droptrue">\
											</div><!--end of insert_tags-->\
										<div class="bottom_box"></div><!--end of bottom_box-->\
									</div>\
									<div class="endif"></div><!--end of if-->\
									<br/>\
								</div></div><!--end of tag_holder-->');

							

			$('#else_box').html('<div id="upper_tag_holder"><div  class="tag_holder test">\
								        <div class="else_icon tag_icon">\
								        <div class="instruction">\
					                    ?\
					                    <div class="instruction_box">\
					    	                The else statement provides a secondary path of execution when an "if" clause evaluates to false. \
						                    Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/if.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/if.html</a>\
					                    </div><!--end of instruction_box-->\
					                </div><!--end of instruction-->\
								        else\
								        </div><!--end of if_icon-->\
											\
								        <div class="else" condition="" id="jomarie" >\
								            <div class="upper_box">\
								                <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
								                    <tr>\
								                        <td><a class="else_label">else</a></td>\
								                    </tr>\
								                </table>\
								            </div><!--end of upper_box-->\
								            <br/>\
								                <div id="sortable" class="insert_tags insert_tags100 droptrue">\
								                \
								                </div><!--end of insert_tags-->\
								                \
								            <div class="bottom_box"></div><!--end of bottom_box-->\
								        </div>\
								        <div class="endif"></div>\
								        \
								        <br/>\
    							</div></div><!--end of tag_holder-->');

			var switch_case_id = $('#dock_box .switch').length+1;
			//alert(switch_case_id);
			
			$('#switch_case_box').html('<div id="upper_tag_holder"><div class="tag_holder">\
							        <div class="switch_case_icon tag_icon">\
							        <div class="instruction">\
					                    ?\
					                    <div class="instruction_box">\
											Evaluates its expression, then executes all statements that follow the matching case label.	\
											Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/switch.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/switch.html</a>\
					                    </div><!--end of instruction_box-->\
					                </div><!--end of instruction-->\
							        switch case\
							        </div><!--end of switch_case_icon-->\
							         <div class="switch" param="" datatype="" id="switch'+switch_case_id+'">\
							            <div class="upper_box" onclick="show_popup(\'#switch_variable_box\',\'Variable\'); get_switch_case_id('+switch_case_id+');" id="switch_case'+switch_case_id+'">\
							                <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
							                    <tr>\
							                        <td><a class="switch_label">switch()</a></td>\
							                    </tr>\
							                </table>\
							            </div><!--end of upper_box-->\
							            <br/>\
							                <div id="sortable" class="insert_tags insert_tags1 droptrue">\
							                    <div class="switch_case_holder droptrue" id="switch_case_holder'+switch_case_id+'">\
							                    </div><!--end of switch_case_holder-->\
							                    <div id="upper_tag_holder">\
							                    <div class="tag_holder">\
							                                <div class="casedefault">\
							                                            <div class="upper_box">\
							                                                <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
							                                                    <tr>\
							                                                        <td><a class="else_label">default</a></td>\
							                                                    </tr>\
							                                                </table>\
							                                            </div><!--end of upper_box-->\
							                                            <br/>\
							                                            <div id="sortable" class="insert_tags insert_tags100 droptrue">\
							                                            </div><!--end of insert_tags-->\
							                                            <div class="bottom_box"></div><!--end of bottom_box-->\
							                                        </div><!--end of case-->\
							                                        <div class="endcasedefault"></div>\
							                                     <br/>\
							                        </div></div><!--end of tag_holder-->\
							                </div><!--end of insert_tags-->\
							            <div class="bottom_box"></div><!--end of bottom_box-->\
							        </div><!--end of switch-->\
							        <div class="endswitch"></div>\
							        <br/>\
							        <div class="add_case_box" title="Add case" onclick="add_case('+switch_case_id+');">\
							            +\
							        </div><!--end of add_case_box-->\
							        <br/>\
    </div></div><!--end of tag_holder-->');



	$('#while_box').html('<div id="upper_tag_holder"><div  class="tag_holder test">\
		\
        <div class="while_icon tag_icon">\
        <div class="instruction">\
            ?\
            <div class="instruction_box">\
				The while statement continually executes a block of statements while a particular condition is true. \
				Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/while.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/while.html</a>\
            </div><!--end of instruction_box-->\
        </div><!--end of instruction-->\
            while\
        </div><!--end of if_icon-->\
    \
        <div class="while if" condition="null==null" var_counter="">\
            <div class="upper_box while_upper_box">\
                <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
                    <tr>\
                        <td><a class="while_label">while</a></td>\
                        <td valign="middle">\
                            <div class="statement_left" >Null</div>\
                        </td>\
                        <td>\
                            <select class="statement_operator" onChange="add_condition();"> \
                                <option>==</option>\
                                <option>!=</option>\
                                <option>></option>\
                                <option><</option>\
                                <option>>=</option>\
        						<option><=</option>\
                            </select>\
                        </td>\
                        <td>\
                            <div class="statement_right" >Null</div>\
                        </td>\
                    </tr>\
                    </tr>\
                </table>\
            </div><!--end of upper_box-->\
            <br/>\
                <div id="sortable" class="insert_tags insert_tags100 droptrue">\
                \
                </div><!--end of insert_tags-->\
                \
            <div class="bottom_box while_bottom_box">\
            	<table>\
	        		<tr>\
	        			<td>Counter</td>\
	        			<td><select class="while_counter_var" onChange="set_while_counter_value();"></select></td>\
	        			<td>\
	        				<select class="while_counter_operator" onChange="set_while_counter_value();">\
	        					<option value="+">increment by</option>\
	        					<option value="-">decrement by</option>\
	        				</select>\
	        			</td>\
	        			<td><select class="while_counter_by" onChange="set_while_counter_value();">\
	        				<option>1</option>\
	        				<option>2</option>\
	        				<option>3</option>\
	        				<option>4</option>\
	        				<option>5</option>\
	        			</select></td>\
	        		</tr>\
	        	</table>\
            </div><!--end of bottom_box-->\
        </div>\
        <div class="while_counter" value=""></div><!--end of while_counter!-->\
        <div class="endwhile"></div>\
        <br/>\
    </div></div><!--end of tag_holder-->');


	$('#dowhile_box').html(' <div id="upper_tag_holder"><div  class="tag_holder test">\
		\
        <div class="dowhile_icon tag_icon">\
        <div class="instruction">\
	        ?\
	        <div class="instruction_box">\
				The do-while statement evaluates its expression at the bottom of the loop instead of the top.\
				Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/while.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/while.html</a>\
	        </div><!--end of instruction_box-->\
	    </div><!--end of instruction-->\
            do while\
        </div><!--end of if_icon-->\
        \
        <div class="dowhile if">\
            <div class="upper_box dowhile_upper_box">\
                <table>\
	        		<tr>\
	        			<td style="padding-right:15px;">do</td>\
	        			<td>Counter</td>\
	        			<td><select class="while_counter_var" onChange="set_while_counter_value();"></select></td>\
	        			<td>\
	        				<select class="while_counter_operator" onChange="set_while_counter_value();">\
	        					<option value="+">increment by</option>\
	        					<option value="-">decrement by</option>\
	        				</select>\
	        			</td>\
	        			<td><select class="while_counter_by" onChange="set_while_counter_value();">\
	        				<option>1</option>\
	        				<option>2</option>\
	        				<option>3</option>\
	        				<option>4</option>\
	        				<option>5</option>\
	        			</select></td>\
	        		</tr>\
	        	</table>\
            </div><!--end of upper_box-->\
            <br/>\
                <div id="sortable" class="insert_tags insert_tags100 droptrue">\
                \
                </div><!--end of insert_tags-->\
                \
            <div class="bottom_box dowhile_bottom_box">\
                 <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
                    <tr>\
                        <td><a class="dowhile_label">while</a></td>\
                        <td valign="middle">\
                            <div class="statement_left" >Null</div>\
                        </td>\
                        <td>\
                            <select class="statement_operator" onChange="add_condition();"> \
                                <option>==</option>\
                                <option>!=</option>\
                                <option>></option>\
                                <option><</option>\
                                <option>>=</option>\
        						<option><=</option>\
                            </select>\
                        </td>\
                        <td>\
                            <div class="statement_right" >Null</div>\
                        </td>\
                    </tr>\
                    </tr>\
                </table>\
            </div><!--end of bottom_box-->\
        </div>\
        <div class="while_counter" value=""></div><!--end of while_counter!-->\
        <div class="enddowhile"></div>\
        \
        \
        <br/>\
    </div></div><!--end of tag_holder-->');



	$('#forloop_box').html('\
				    <div id="upper_tag_holder"><div  class="tag_holder test">\
				            <div class="forloop_icon tag_icon">\
				            <div class="instruction">\
				                ?\
				                <div class="instruction_box">\
									The for statement provides a compact way to iterate over a range. Programmers often refer to it as the "for loop" because of the way in which it repeatedly loops until a particular condition is satisfied.\
									Read More: <a href="http://docs.oracle.com/javase/tutorial/java/nutsandbolts/for.html" target="_blank" >http://docs.oracle.com/javase/tutorial/java/nutsandbolts/for.html</a>\
        		                </div><!--end of instruction_box-->\
				            </div><!--end of instruction-->\
				              for loop\
				            </div><!--end of if_icon-->\
				            <div class="forloop" condition="int x = 0; x == 5; x+=1" id="jomarie">\
				                <div class="upper_box forloop_upper_box" onclick=" get_forloop_this(this);">\
				                    <table border="0" cellpadding="0" cellspacing="0" class="statement_table">\
				                        <tr>\
				                            <td><a class="if_label">for</a></td>\
				                            <td valign="middle">\
				                                <div id="forloop_input_text" class="statement_left" onclick=" get_forloop_this(this); forloop_current_value(); show_popup(\'#forloop_statement_box\',\'Input\'); count_variable();">x = 0</div>\
				                            </td>\
				                            \
				                            <td>\
				                                <select class="statement_operator forloop_operator" onchange="add_forloop_condition();"> \
				                                    <option>==</option>\
				                                    <option>!=</option>\
				                                    <option>></option>\
				                                    <option><</option>\
				                                    <option>>=</option>\
				                                    <option><=</option>\
				                                </select>\
				                            </td>\
				                            <td>\
				                                <div class="statement_right" onclick="show_popup(\'#forloop_compare_box\',\'choose\'); ">5</div>\
				                            </td>\
				                            <td>\
				                                <select class="in_dec_crement" onchange="add_forloop_condition();">\
				                                    <option value="1">Increment by</option>\
				                                    <option value="2">Decrement by</option>\
				                                </select>\
				                            </td>\
				                            <td>\
				                                <select class="in_dec_crement_by" onchange="add_forloop_condition();">\
				                                    <option>1</option>\
				                                    <option>2</option>\
				                                    <option>3</option>\
				                                    <option>4</option>\
				                                    <option>5</option>\
				                                </select>\
				                            </td>\
				                        </tr>\
				                    </table>\
				                </div><!--end of upper_box-->\
				                <br/>\
				                    <div id="sortable" class="insert_tags insert_tags100 droptrue">\
				                    </div><!--end of insert_tags-->\
				                <div class="bottom_box forloop_bottom_box"></div><!--end of bottom_box-->\
				            </div>\
				            <div class="endforloop"></div>\
				            <br/>\
				    </div></div><!--end of tag_holder-->\
				    \
		');


		

			 $('.instruction').on('click',function(){
					$(".instruction_box",this).toggle();
				});
	

		if(isSortable==true){
			
			
			$( "div.droptrue").sortable({
			      		connectWith: "div",
			    	});

			
		}

		else {
			//disable the tag box
			      	
		}

			


		}//end of refresh_tag_box
	
	
		 $('.instruction').on('click',function(){
			$(".instruction_box",this).toggle();
		});
			
			//$('.tag_holder').draggable();
			//$('#sortable').sortable();
			//$('.sortable').sortable();
			//$('#canvas').draggable();
			//$('body').sortable();
			//$('.if').sortable();
			///draw();
			
			/*
				$('.if').mouseover(function(e) {
					$(this).removeClass('if_hovered');
					$(this).addClass('if_hovered');
				});
				
				$('.if').mouseout(function(e) {
                    $(this).removeClass('if_hovered');
                });

                */
/*

                var isDragging = false;
                $("#dock_box").mousedown(function() {
					    $(window).mousemove(function() {
					    	isDragging = true;
					        refresh_tag_box(false);
					        $(window).unbind("mousemove");
					    });
					}).mouseup(function() {
					    var wasDragging = isDragging;
					    isDragging = false;
					    $(window).unbind("mousemove");
					    if (!wasDragging) { //was clicking
					        //alert();
					    }
					});


					*/
		});//end ready function





		
		
		
		


		$(window).resize(function(){
			//alert($(window).width());
			if($(window).width()<=750){
				$('#left_side_bar').addClass('responsive');
				$('#dock_box').addClass('responsive');
				$('#generated_code_box').addClass('responsive');
				$('#output_box').addClass('responsive');
			}

			else {
				$('#left_side_bar').removeClass('responsive');
				$('#dock_box').removeClass('responsive');
				$('#generated_code_box').removeClass('responsive');
				$('#output_box').removeClass('responsive');
			}
		});
		
		$('.if').mouseover(function(){
			
		});


		function window_width(){
			alert($(window).width());
		}

		function up(){
			save();
		}
		
		function insert_before(){
			$( "<p>Before</p>" ).insertBefore( ".if_test" );
		}
		
		function insert_after(){
			$( "<p>After</p>" ).insertAfter( ".if_test" );
		}