<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>Registro | 5DB</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" title="5DB">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--

	sfHover = function() {
		var sfEls = document.getElementById("nav").getElementsByTagName("LI");
		for (var i=0; i<sfEls.length; i++) {
			sfEls[i].onmouseover=function() {
				this.className+=" sfhover";
			}
			sfEls[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
			}
		}
	}

	if (window.attachEvent) window.attachEvent("onload", sfHover);

	//--><!]]></script>

	<script  type="text/javascript">
	
	var FormUtil=new Object;
	
	FormUtil.focusOnFirst=function(){
		document.forms[0].elements[0].focus();
	}

	FormUtil.textCounter=function(field, maxlimit){
	if (field.value.length > maxlimit) // if too long...trim it!
	field.value = field.value.substring(0, maxlimit);
	}
	
	FormUtil.checkmaj=function (ival)
	{
	  istr=ival.toString();

	  if (istr==istr.toUpperCase() & istr.length!=0)
		{

		      alert("No escriguis tot en majúscules!");
		}

	  return true;
	}
	
	FormUtil.checkchar=function (ival,sRequiredChars)
	{
		var sValidString;
		sValidString=true;
		istr=ival.toString();
		for (var i=0; i<sRequiredChars.length; i++) {
			if (istr.indexOf(sRequiredChars[i])==-1) {
				sValidString = false;
			}
		}
		if (!sValidString) {
			alert('Son necessaris els caràcters: '+sRequiredChars);
		}
		//alert(sValidString);
	
		return true;
	}

	FormUtil.allowChars=function(i,oCad,sValidChars){
		var sChar=oCad.charAt(oCad.length-1);
		var bIsValidChar=sValidChars.indexOf(sChar)>-1;
		
		if (bIsValidChar) {document.forms[0].elements[i].value=oCad} 
		else {document.forms[0].elements[i].value=oCad.substr(0,oCad.length-1)};			

		return bIsValidChar
	}

	FormUtil.allowChars2=function(i,oCad,sValidChars){
		var sChar=oCad.charAt(oCad.length-1);

		//caràcters vàlids i els seus codis ASCII
		//48 -> 57 números
		//65 -> 90 majúscules
		//61 -> 122 -> minúscules
		var bIsValidChar=sValidChars.indexOf(sChar)>-1;
		
		if (bIsValidChar || (sChar.charCodeAt(0)>=48 & sChar.charCodeAt(0)<=57) || (sChar.charCodeAt(0)>=65 & sChar.charCodeAt(0)<=90) || (sChar.charCodeAt(0)>=61 & sChar.charCodeAt(0)<=122)) {document.forms[0].elements[i].value=oCad} 
		else {document.forms[0].elements[i].value=oCad.substr(0,oCad.length-1)};			

		return bIsValidChar
	}

	FormUtil.netejar_camp=function(field){
		field.value="";
	}

	FormUtil.validar_nifcif=function(cif)
	{
		par = 0
		non = 0
		letras="ABCDEFGHKLMNPQS"
		let=cif.charAt(0)

		if (!isNaN(let))
		  {
			  nif=cif
			  FormUtil.validar_nif(nif)
			  return false
		  }

		if (cif.length!=9)
		  {
			  alert('El Cif debe tener 9 dígitos')
			  document.formulario.nif.focus()
			  return false
		  }

		if (letras.indexOf(let.toUpperCase())==-1)
		  {
			  alert("El comienzo del Cif no es válido")
			  document.formulario.nif.focus()
			  return false
		  }

		for (zz=2;zz<8;zz+=2)
		  {
			  par = par+parseInt(cif.charAt(zz))
		  }

		for (zz=1;zz<9;zz+=2)
		  {
			  nn = 2*parseInt(cif.charAt(zz))
			  if (nn > 9) nn = 1+(nn-10)
			  non = non+nn
		}

		parcial = par + non

		control = (10 - ( parcial % 10))

		if (control!=cif.charAt(8))
			{
				alert("El Cif no es válido")
				document.formulario.nif.focus()
				return false
			}
			alert("El Cif es válido")
	}

	FormUtil.validar_nif=function(vnif)
	{
		dni=vnif.substring(0,vnif.length-1);
		let=vnif.charAt(vnif.length-1);
		if (!isNaN(let))
		{
			alert('Falta la lletra');
			return false;
		}
		else
		{
			cadena="TRWAGMYFPDXBNJZSQVHLCKET";
			posicion = dni % 23;
			letra = cadena.substring(posicion,posicion+1);
			if (letra!=let.toUpperCase())
			{
				alert("Nif no vàlid");
				return false;
			}
		}
	}
	
	FormUtil.num_min=function(vvalue,vnum_min_car){
		if (vvalue.length < vnum_min_car) {
			alert('com a mínim ' + vnum_min_car + ' caràcters');
		}
	}

	FormUtil.comprovar_pwd=function(vpos1, vpos2){
		if (document.forms[0].elements[vpos1].value != document.forms[0].elements[vpos2].value) alert('passwords no coincideixen');
	}
	</script>

	<script language = "javascript">
	var peticion = false; 
	if (window.XMLHttpRequest) {
	      peticion = new XMLHttpRequest();
	      } else if (window.ActiveXObject) {
	            peticion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	function obtenir_dades(divID,divtotal,divnum) { 
	//variació de AjaxTabs
		for(i=1;i<=divtotal;i++){
		    var obj = document.getElementById(divID+i);
			if (i==divnum) {
				obj.style.visibility="visible";
				obj.style.display="block";
			}
			else
			{
				obj.style.visibility="hidden";
				obj.style.display="none";
			}
		}
	}

	function CanviarEstil(id) {
		var elementosMenu = getElementsByClassName(document, "li", "activo");
		for (k = 0; k< elementosMenu.length; k++) {
		elementosMenu[k].className = "inactivo";
		}
		var identity=document.getElementById(id);
		identity.className="activo";
	}

	/*
	    function getElementsByClassName
	    Written by Jonathan Snook, http://www.snook.ca/jonathan
	    Add-ons by Robert Nyman, http://www.robertnyman.com
	*/

	function getElementsByClassName(oElm, strTagName, strClassName){
	    var arrElements = (strTagName == "*" && document.all)? document.all : oElm.getElementsByTagName(strTagName);
	    var arrReturnElements = new Array();
	    strClassName = strClassName.replace(/\-/g, "\\-");
	    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
	    var oElement;
	    for(var i=0; i<arrElements.length; i++){
	        oElement = arrElements[i];      
	        if(oRegExp.test(oElement.className)){
	            arrReturnElements.push(oElement);
	        }   
	    }
	    return (arrReturnElements)
	}

	</script>
</head>
<body>