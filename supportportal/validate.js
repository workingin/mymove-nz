$(document).ready(function(){
	
	$("#password").keyup(function(){
		validatePassword();
	});
	
	$("#generatePassword").click(function(){	
		var password =  Array(20).fill('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@-#$')
		.map(x => x[Math.floor(crypto.getRandomValues(new Uint32Array(1))[0] / (0xffffffff + 1) * x.length)]).join('');

		$("#password").val(password);
		validatePassword();
	});
	
});

function validatePassword() {
	
 var pass = $("#password").val(); 
 if(pass != "") { 
 
  $("#strengthSection").removeClass('hidden');   
  
  if(pass.length <= 6) { 
	$("#strength").css("background-color", "red").text("Very Weak").animate({width:'200px'},300); 	
  } 
  
  if(pass.length > 6 && (pass.match(/[a-z]/) || pass.match(/\d+/) || pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))){	
	$("#strength").css("background-color", "#F5BCA9").text("Weak").animate({width:'200px'},300); 	
  } 
  
  if(pass.length > 6 && ((pass.match(/[a-z]/) && pass.match(/\d+/)) || (pass.match(/\d+/) && pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (pass.match(/[a-z]/) && pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) {	
	$("#strength").css("background-color", "#FF8000").text("Good").animate({width:'200px'},300); 	
  } 
  
  if(pass.length > 6 && pass.match(/[a-z]/) && pass.match(/\d+/) && pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {	
	$("#strength").css("background-color", "#00FF40").text("Strong").animate({width:'200px'},300); 	
  } 
  
 } else {    
  $("#strength").animate({width:'200px'},300); 
  $("#strengthSection").addClass('hidden'); 
 }
 
}