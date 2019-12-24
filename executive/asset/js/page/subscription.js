var baseURL = "http://50.116.58.130:2001/";

$("#smsName").on('input', function(){
	var value = $(this).val();
	$("#helpBlock").html((10-value.length)+" Characters Left");
	$(this).attr('maxlength','10');
});
$("#same").on('change', function(){
  //swal({title:"Hello, Shamim!", text:"This is!", type:"success"});
  if($("#same").is(':checked')){
  $("#adminName").val($("#businessAdminName").val());
}  
else{
   $("#adminName").val("");
}
})

function addSubscription()
{
	/*$("#catStatusLoading").show();
	var newCategoryName = $('#newCategoryName').val();
	var newCategoryUnit = $('#newCategoryUnit').val();*/
	 $.post(baseURL+'executive/subscription/add',
	    {
	        businessName: $('#businessName').val(),
	        businessAddress: $('#businessAddress').val(),
	        businessAdminName:$('#businessAdminName').val(),
          businessPhone:$('#businessPhone').val(),
					 businessEmail:$('#businessEmail').val(),
					 timezone:$('#timezone').val(),
					 smsName:$('#smsName').val(),
					 adminName:$('#adminName').val(),
					 adminUsername:$('#adminUsername').val(),
					 adminEmail:$('#adminEmail').val(),
					 adminPhone:$('#adminPhone').val(),
					 lang:$('#lang').val(),
		 			currency:$('#currency').val(),
					 subscription:$('#subscription').val(),
     
     
     submit: "true"
	    },
	    function(data, status){
     	var a = JSON.parse(data);
		 if(a[2]=="success"){
			  $('#businessName').val('');
	      $('#businessAddress').val('');
	        $('#businessAdminName').val('');
          $('#businessPhone').val('');
					 $('#businessEmail').val('');
					 $('#timezone').val('');
					 $('#smsName').val('');
					 $('#adminName').val('');
					 $('#adminUsername').val('');
					 $('#adminEmail').val('');
					 $('#adminPhone').val('');
					 $('#lang').val('');
					 $('#subscription').val('');
		 }
     swal({title:a[0], html:a[1], type:a[2]})
	       /* $("#catStatusLoading").hide();
	        if(data=="true"){
	        	$("#catStatusTrue").fadeIn();
	        	setTimeout(function(){ 
	        		$("#catStatusTrue").fadeOut(); 
	        	}, 3000);
	        	$('#newCategoryUnit').val('');
	        	$('#newCategoryName').val('');
	        	loadCategory();
				loadCategory();
	        }
	        else if(data=="duplicate"){
	        	$("#catStatusDuplicate").fadeIn();
	        	setTimeout(function(){ 
	        		$("#catStatusDuplicate").fadeOut(); 
	        	}, 3000);
	        }
	        else if(data=="empty"){
	        	$("#catStatusEmpty").fadeIn();
	        	setTimeout(function(){ 
	        		$("#catStatusEmpty").fadeOut(); 
	        	}, 3000);
	        }
	        else{
	        	$("#catStatusFalse").fadeIn();
	        	setTimeout(function(){ 
	        		$("#catStatusFalse").fadeOut(); 
	        	}, 3000);
	        }*/
	    });
}