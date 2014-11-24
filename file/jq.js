/**
 * @author MANAGER
 */
$(function(){
	$( "#caja" ).dialog({modal: true,autoOpen: false, width: 600});
	$( "#carpeta" ).dialog({modal: true,autoOpen: false, width: 600});
	$( "#operacion" ).dialog({modal: true,autoOpen: false, width: 600});
	$( "#consultarOp" ).dialog({modal: true,autoOpen: false, width: 600});
	$( "#consultarCaja" ).dialog({modal: true,autoOpen: false, width: 600, beforeClose: function( event, ui ) {
			$( "#resultCaja" ).empty();
			$( "#ano" ).val("");
			$( "#mes" ).val("");
			$( "#numero" ).val("");
		}
	});
	$( "#retirarCaja" ).dialog({modal: true,autoOpen: false, width: 600, beforeClose: function( event, ui ) {}});
});


function showDialog(id) {
	
	$("#"+id).click(
		$( "#"+id ).dialog("open"));
    
  };
function submitFormCaja(){
				$( "#box-creation" ).submit(function( event ) {
					 // Stop form from submitting normally
				  event.preventDefault();
				  // Get some values from elements on the page:
				  var $form = $("#box-creation");
				    term = "";
				    url = $form.attr( "action" );
				  // Send the data using post
				  var posting = $.post( url, {mesCaja: $("#mesCaja").val(), anoCaja: $("#anoCaja").val(), numeroCaja: $("#numeroCaja").val()} );
				 //alert(term);
				  // Put the results in a div
				  //if($("#anoCaja").val()!="" | typeof("undefined")){
					  posting.done(function( data ) {
						  	//alert(data);
						    if(data=="1"){
						    	alert("Se ha creado la caja " + $("#mesCaja").val()+ " " +$( "#numeroCaja" ).val());
						    	$( "#last-box" ).replaceWith("<strong style='color: red;'>" +$("#mesCaja").val()+ " " +$( "#numeroCaja" ).val() + "</strong>");
						    	$("#caja").dialog("close");
						    }
						    if(data=="2"){
						    	alert("La carpeta que intenta crear ya existe");
						    } 
		  				});
		  
		  		/*}else{
		  			alert("Debe seleccionar un año para la caja que desea crear.");
		  		}*/
		});
}

function submitFormFolder(){
			$( "#folderCreation" ).submit(function( event ) {
		 
				  // Stop form from submitting normally
				  event.preventDefault();
				 
				  // Get some values from elements on the page:
				  var term;
				  var $form = $("#folderCreation");
				  
				  	term = $form.serialize();
				    url = $form.attr( "action" );
				  // Send the data using post
				  var posting = $.post( url, term );
				 //alert(term);
				  // Put the results in a div
				  
				  posting.done(function( data ) {
				  //alert(data);
				  resultArray = data.split(",");
				    if(resultArray[0]=="1"){
				    	alert("Se ha creado la carpeta Nº " + resultArray[1] );
				    	getFolders();
				    	
				    }
		  		});
		  
		  
		});
}

function submitFormOps(){
			$( "#opsCreation" ).submit(function( event ) {
		 
				  // Stop form from submitting normally
				  event.preventDefault();
				 
				  // Get some values from elements on the page:
				  var term;
				  var $form = $("#opsCreation");
				  
				  	term = $form.serialize();
				    url = $form.attr( "action" );
				  // Send the data using post
				  var posting = $.post( url, term );
				 //alert(term);
				  // Put the results in a div
				  if($( "#codOperacion" ).val()!= "" && $( "#yearDropdown" ).val()!= "" && $( "#monthDropdown" ).val()!= "" && $( "#boxDropdown" ).val()!= "" && $( "#folderDropdown" ).val()!= ""){
				  	
				  	posting.done(function( data ) {
				  
					  //alert(data);
					  resultArray = data.split(",");
					    if(resultArray[0]=="1"){
					    	
					    	alert("Se ha agregado la operacion " + resultArray[1] + " a la carpeta " + resultArray[2]);
					    	$( "#opsInFolder" ).append( "<tr id='OP" + resultArray[1] + "'><td>" + resultArray[1] + "</td><td id='" + resultArray[1] + "' onclick='delOps(" + resultArray[1] + ");'><img style='cursor: pointer;' src='trash.png'></td></tr>" );
					    	$( "#codOperacion" ).val("");
					    	//$("#carpeta").dialog("close");
					    	
					    }
					    if(resultArray[0]=="2"){
					    	alert("La operacion " + resultArray[2] + " ya ha sido agregada a la carpeta " + resultArray[1]);
					    }
			  		});
			  	}else{
			  		alert("Debe ingresar un numero de operacion!");
			  	}
		  
		  
		});
}

var counter=0;
var operacion = new Array;
var theFolderId;


function deleteRow(id){
	event.preventDefault();
	$( "#rowInput"+id ).detach();
	$( "#deleteButton"+(id-1) ).show();
	counter--;
}

function createDropdown(theArray, name){
	
	var first = "<option></option>";
	var second = "";
	for(i=0; i<=theArray.length-1; i++){
		second = second + "<option value='"+ theArray[i] +"'>"+ theArray[i] +"</option>";
	}
	
	var thrid ="</select>";
	
	return first + second + thrid;
}

function createDropdownMulti(theArray, name){
	
	var first = "<option></option>";
	var second;
	
	var divide = theArray.split("|");
	var ids= divide[0];
	ids= ids.split(",");
	
		
	var nums = divide[1];
	nums = nums.split(",");
	
	for(i=0; i<=ids.length-1; i++){
		second = second + "<option value='"+ ids[i] +"'>"+ nums[i] +"</option>";

	}
	
	var thrid ="</select>";
	
	return first + second + thrid;
}

function getMonths(){
		$( "#month-selector" ).empty();
		$( "#box-selector" ).empty();
		$( "#folder-selector").empty();
		$( "#opsInFolder").empty();	
	 // Get some values from elements on the page:
	 var term;

	  
	 term = "yearDropdown="+$("#yearDropdown").val();
	 url = "months.php";
	 // Send the data using post
	 var posting = $.post( url, {yearDropdown: $("#yearDropdown").val(), boxDropdown: $("#boxDropdown").val()} );
	 //alert(term);
	  // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(data);
	    if(data!=""){
	    	var resultArray = new Array;
	    	resultArray = data.split(",");
	    	var theMonths = "<select name='monthDropdown' id='monthDropdown' onchange='getBoxes();'>" + createDropdown(resultArray, "monthDropdown");
	    	//alert(createDropdown(resultArray, "monthDropdown"));
	    	$( "#month-selector" ).empty();
	    	$( "#box-selector" ).empty();
	    	$( "#folder-selector").empty();
	    	$( "#opsInFolder").empty();
	    	$( "#month-selector" ).append( ""+theMonths );
		
		}
			 
	    
	});
		  
}

function getBoxes(){
		$( "#box-selector" ).empty();
    	$( "#folder-selector").empty();
    	$( "#opsInFolder").empty();	
	 // Get some values from elements on the page:
	 var term;

	  
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "boxes.php";
	 // Send the data using post
	 var posting = $.post( url, {monthDropdown: $("#monthDropdown").val(), yearDropdown: $("#yearDropdown").val() } );
	 //alert(term);
	  // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(data);
	    if(data!=""){
	    	var theBoxes = createDropdownMulti(data, "monthDropdown");
	    	//alert(createDropdownMulti(data, "monthDropdown"));
	    	$( "#box-selector" ).empty();
	    	$( "#folder-selector").empty();
	    	$( "#box-selector" ).append( "<select name='boxDropdown' id='boxDropdown' onchange='getFolders();'>"+theBoxes );
		
		}
			 
	    
	});
		  
}


//Folder====================================================================

function getMonthsFolder(){
			
	 // Get some values from elements on the page:
	 var term;

	  
	 term = "yearDropdownFolder="+$("#yearDropdownFolder").val();
	 url = "months.php";
	 // Send the data using post
	 var posting = $.post( url, {yearDropdown: $("#yearDropdownFolder").val()} );
	 //alert(term);
	  // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(data);
	    if(data!=""){
	    	var resultArray = new Array;
	    	resultArray = data.split(",");
	    	var theMonths = "<select name='monthDropdownFolder' id='monthDropdownFolder' onchange='getBoxesFolder();'>" + createDropdown(resultArray, "monthDropdownFolder");
	    	//alert(createDropdown(resultArray, "monthDropdown"));
	    	$( "#month-selector-folder" ).empty();
	    	$( "#box-selector-folder" ).empty();
	    	$( "#folder-selector" ).empty();
	    	$( "#opsInFolder" ).empty();
	    	$( "#month-selector-folder" ).append( ""+theMonths );
		
		}
			 
	    
	});
		  
}

function getBoxesFolder(){
			
	 // Get some values from elements on the page:
	 var term;

	  
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "boxes.php";
	 // Send the data using post
	 var posting = $.post( url, {monthDropdown: $("#monthDropdownFolder").val(), yearDropdown: $("#yearDropdownFolder").val() } );
	 //alert(term);
	  // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(data);
	    if(data!=""){
	    	var theBoxes = createDropdownMulti(data, "monthDropdownFolder");
	    	//alert(createDropdownMulti(data, "monthDropdown"));
	    	$( "#box-selector-folder" ).empty();
	    	$( "#folder-selector" ).empty();
	    	$( "#opsInFolder" ).empty();
	    	$( "#box-selector-folder" ).append( "<select name='boxDropdownFolder' id='boxDropdownFolder'  onchange='getFolders();'>"+theBoxes );
		
		}
			 
	    
	});
		  
}

function getFolders(){
	
	$( "#folder-selector").empty();
	$( "#opsInFolder").empty();
	 // Get some values from elements on the page:
	 var term;
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "folders.php";
	 // Send the data using post
	 var posting = $.post( url, {boxDropdown: $("#boxDropdown").val()} );
	 //alert(term);
	  // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(data);
	    if(data!=""){
	    	var resultArray = data.split(",");
	    	var theFolders = createDropdown(resultArray, "monthDropdownFolder");
	    	//alert(createDropdownMulti(data, "monthDropdown"));
	    	
	    	$( "#folder-selector" ).empty();
	    	$( "#opsInFolder" ).empty();
	    	$( "#folder-selector" ).append( "<select name='folderDropdown' id='folderDropdown' onchange='getOps();'>"+theFolders );	
		}
	});
		  
}
function getOps(){
	$( "#opsInFolder" ).empty();
	// Get some values from elements on the page:
	 var term;

	  
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "ops.php";
	 // Send the data using post
	 var posting = $.post( url, {folderDropdown: $("#folderDropdown").val()} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(data);
	    if(data!=""){
	    	var ops = data.split(",");
	    	var stringOps;
			for(i=0; i<=ops.length-1; i++){
				
				stringOps = stringOps + "<tr id='OP" + ops[i] + "'><td>" + ops[i] + "</td><td onclick=\"delOps('" + ops[i] + "');\" id='" + ops[i] + "'><img style='cursor: pointer;' src='trash.png'></td></tr>";
			}
		$( "#opsInFolder" ).empty();
		$( "#opsInFolder" ).append( stringOps );
		}
			 
	    
	});
	
	
	
	
}
function delOps(id){
	// Get some values from elements on the page:
	 var term;

	  
	 
	 url = "delete-op.php";
	 // Send the data using post
	 var posting = $.post( url, {op: id} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  alert(data);
	    if(data=="1"){
			
			$( "#OP"+id ).remove();
		}
			 
	    
	});
}
//=================================================CONSULTAR======================================================================

function submitOpsSearch(){
		// Get some values from elements on the page:
	 var term;

	  
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "infoOp.php";
	 // Send the data using post
	 var posting = $.post( url, {codigoOperacion: $("#codigoOperacion").val()} );
	 //alert(term);
	 // Put the results in a div
	  if($("#codigoOperacion").val()!=""){
	  	
	  	posting.done(function( data ) {
		    if(data!=""){
		    //alert(data);
		    var resultArray = data.split(",");
		    if(resultArray[0]=="1"){
			    
			    operacion['id']=resultArray[1];
			    operacion['carpeta']=resultArray[2];
			    operacion['caja']=resultArray[3];
			    operacion['ano']=resultArray[4];
			    operacion['mes']=resultArray[5];
			    operacion['numero']=resultArray[6];
			    operacion['estado']=resultArray[7];
			    operacion['idUsuario']=resultArray[8];
			    operacion['usuario']=resultArray[9];
			    operacion['log']=resultArray[10];
			    //alert(operacion['log']);
			    theFolderId = operacion['carpeta'];
			    var estado = "";
			    var transaccion = "";
			    if(operacion['estado']==0){
			    	
			    	estado="La carpeta se encuentra en el archivo";
			    	if(operacion['log']==3 || operacion['log']==4 || operacion['log']==16 || operacion['log']==17){
			    		transaccion = "<button id='botonRetirar' onclick='retirarCarpeta(" + theFolderId + ");' >Retirar del archivo</button>";
			    	}
			    }
			    if(operacion['estado']==1 || operacion['estado']==2){
			    	estado="La carpeta esta en poder de " + operacion['usuario'];
			    	if(operacion['log']==3 || operacion['log']==4 || operacion['log']==16 || operacion['log']==17){
			    		transaccion = "<button onclick='devolverCarpeta(" + theFolderId + ");' >Devolver al archivo</button>";
			    	}
			    }
			    var stringOps = "<table>\
				<tr>\
					<td>Operación: " + operacion['id'] + "</td>\
				</tr>\
				<tr>\
					<td>Ubicación: Carpeta Nº" + operacion['carpeta'] + " Caja Nº " + operacion['numero'] + " " + operacion['mes'] + " " + operacion['ano'] + "</td>\
				</tr>\
				<tr>\
					<td>" + estado + "</td>\
				</tr>\
				<tr>\
					<td>" + transaccion + "</td>\
				</tr>\
				</table>";
			    $( "#opTable" ).empty();
				$( "#opTable" ).append( stringOps );
				if(operacion['estado']==0  && (operacion['log']==3 || operacion['log']==4 || operacion['log']==16 || operacion['log']==17)){
					$( "#dropUsers" ).show();
					$( "#dropUsers" ).insertBefore('#botonRetirar');
				}
			}else{
				$( "#opTable" ).empty();
				alert("Operación no encontrada");
				
			}	
				 
		    }
		});
	  }
	  	
	
}

function retirarCarpeta(id){
	console.log(id);
	// Get some values from elements on the page:
	 var term;

	  
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "fRetirar.php";
	 // Send the data using post
	 var posting = $.post( url, {idFolder: theFolderId, idUser: $( "#dropUsers option:selected").val()} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(theFolderId);
	  //alert(data);
	    if(data=="1"){
	    	alert("La carpeta se ha entregado a " + $( "#dropUsers option:selected" ).text());
	    	
	    	$( "#codigoOperacion").val( "" );
	    	$( "#dropUsers").insertAfter("#opTable");
	    	$( "#dropUsers").hide();
	    	$( "#opTable" ).empty();
		//$( "#opTable" ).append( stringOps );
		}else{
			alert("Shit!");
		}
			 
	    
	});
}


function devolverCarpeta(id){
	//console.log(id);
	// Get some values from elements on the page:
	 var term;
 
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "fDevolver.php";
	 // Send the data using post
	 var posting = $.post( url, {idFolder: theFolderId} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(theFolderId);
	  //alert(data);
	    if(data=="1"){
	    	alert("La carpeta se ha devuleto al archivo ");
	    	
	    	$( "#codigoOperacion").val( "" );
	    	$( "#dropUsers").insertAfter("#opTable");
	    	$( "#dropUsers").hide();
	    	$( "#opTable" ).empty();
		//$( "#opTable" ).append( stringOps );
		}else{
			alert("Shit!");
		}
			 
	    
	});
}

function consultarCaja(){
	var term;
 
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "consultar-caja.php";
	 // Send the data using post
	 var posting = $.post( url, {ano: $("#ano").val(), mes: $("#mes").val(), numero: $("#numero").val()} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(theFolderId);
	  
	    if(data!=""){
	    	$( "#resultCaja" ).empty();
	    	$( "#resultCaja" ).append(data);
		//$( "#opTable" ).append( stringOps );
		}else{
			alert("Shit!");
		}
			 
	    
	});
}

function consultarCaja(){
	var term;
 
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "consultar-caja.php";
	 // Send the data using post
	 var posting = $.post( url, {ano: $("#ano").val(), mes: $("#mes").val(), numero: $("#numero").val()} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(theFolderId);
	  
	    if(data!=""){
	    	$( "#resultCaja" ).empty();
	    	$( "#resultCaja" ).append(data);
		//$( "#opTable" ).append( stringOps );
		}else{
			alert("Shit!");
		}
			 
	    
	});
}


function retirarCaja(){
	var term;
 
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "retirar-caja.php";
	 // Send the data using post
	 var posting = $.post( url, {ano: $("#anoR").val(), mes: $("#mesR").val(), numero: $("#numeroR").val()} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(theFolderId);
	  
	    if(data!=""){
	    	$( "#resultRetiroCaja" ).empty();
	    	$( "#resultRetiroCaja" ).append(data);
		//$( "#opTable" ).append( stringOps );
		}else{
			alert("Shit!");
		}
			 
	    
	});
}
function devolverCaja(){
	var term;
 
	 //term = "monthDropdown="+$("#monthDropdown").val() + "&" + "yearDropdown="+ $("#yearDropdown").val();
	 url = "devolver-caja.php";
	 // Send the data using post
	 var posting = $.post( url, {ano: $("#anoR").val(), mes: $("#mesR").val(), numero: $("#numeroR").val()} );
	 //alert(term);
	 // Put the results in a div
	  
	  posting.done(function( data ) {
	  //alert(theFolderId);
	  	alert(data);
	    if(data!=""){
	    	$( "#resultRetiroCaja" ).empty();
	    	$( "#resultRetiroCaja" ).append(data);
		//$( "#opTable" ).append( stringOps );
		}else{
			alert("Shit!");
		}
			 
	    
	});
}