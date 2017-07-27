	function add(){
		console.log($('.clicked').length);
		var x = document.getElementsByClassName("clicked");
		var values = {};
		var i;
		$(x).each(function(key,value) {
				i = $(value).attr('class').replace(' clicked','');//for getting form field name
				if(i == 'minrent'||i=='maxrent'||i == 'minage'||i=='maxage'||i=='country'||i=='state'||i=='area')
					values[i] = $(value).val();
				else
					values[i] = $(value).attr('value');
		});
		var json = JSON.stringify(values); 
		console.log(values);
		console.log(json);
        $.ajax({
		 type: "GET",
		 url: "http://localhost/advaced/backend/web/index.php?r=site%2Fhint&q=" + json,
		 contentType: "application/json; charset=utf-8",
		 dataType: "json",
		 success: function(msg) {
		 	$('#result').empty();
		 	console.log(msg);
		 	var data = eval(msg);
		 	console.log(data);
		 	if(data.length != 0)
		 	{	data = $.map(msg, function(el) { return el });
		 			 	//console.log(arr);
 			 	$(data).each(function(key,value){
		 			 		console.log(value['images']);
		 			 		$('#result').append('<a href="http://localhost/advaced/backend/web/index.php?r=site/slider&room_id='+value['id']+'"><div class="unique"><img src='+value["images"]+' height="100%" width="40%" class="uniqueimg"><div class="rent">'+'$'+value['rent']+'</div><div class="address">'+'Address:'+value['flat_no']+','+value['building_name']+',<br>'+value['area']+','+value['state']+','+value['country']+'</div><div class="description">'+value['description']+'</div></div><br>');
		 			 	});
		 	}else{
		 		$('#result').append('<div class="alert alert-danger"><strong>Sorry!</strong> No Rooms found for this combination. You can try a different combination.</div>');
		 	}
		 	//console.log(data[0]);
		 }
		});
	}

$('input[type="text"]').focusin(function(){
	$('.err').text('');
	$(this).css('background-color','yellow');
});
$('#min').blur(function(){
	$(this).css('background-color','white');
	if(!isNaN($('#min').val())&&($('#min').val()!='')){
		$(this).addClass('clicked');
		add();
	}else{
		if($(this).hasClass('clicked'))
			$(this).removeClass("clicked");
		if($('#min').val()!='')
			$('.err').text('enter valid values');
	}
});
$('#max').blur(function(){
	$(this).css('background-color','white');
	if(!isNaN($('#max').val())&&($('#max').val()!='')){
		$(this).addClass('clicked');
		add();
	}else{
		if($(this).hasClass('clicked'))
			$(this).removeClass("clicked");
		if($('#min').val()!='')
			$('.err').text('enter valid values');
	}
});
$('#minage').blur(function(){
	$(this).css('background-color','white');
	if(!isNaN($('#minage').val())&&($('#minage').val()!='')){
		$(this).addClass('clicked');
		add();
	}else{
		if($(this).hasClass('clicked'))
			$(this).removeClass("clicked");
		if($('#minage').val()!='')
			$('.err1').text('enter valid values');
	}
});
$('#maxage').blur(function(){
	$(this).css('background-color','white');
	if(!isNaN($('#maxage').val())&&($('#maxage').val()!='')){
		$(this).addClass('clicked');
		add();
	}else{
		if($(this).hasClass('clicked'))
			$(this).removeClass("clicked");
		if($('#maxage').val()!='')
			$('.err1').text('enter valid values');
	}
});
$('#button1').click(function(){
    $(this).css('background-color','#D4EDF6');
    $(this).addClass('clicked');
	    $('#button2').css('background-color','white');
	    
		if($('#button2').hasClass('clicked'))
			$('#button2').removeClass("clicked");
		add();
});
$('#button2').click(function(){
    $(this).css('background-color','#D4EDF6');
        $(this).addClass('clicked');
	    $('#button1').css('background-color','white');
	    if($('#button1').hasClass('clicked'))
			$('#button1').removeClass("clicked");
		add();
});
$('#button7').click(function(){
    $(this).css('background-color','#D4EDF6');
    $(this).addClass('clicked');
	$('#button8').css('background-color','white');
	if($('#button8').hasClass('clicked'))
			$('#button8').removeClass("clicked");
		add();
});
$('#button8').click(function(){
    $(this).css('background-color','#D4EDF6');
        $(this).addClass('clicked');
	    $('#button7').css('background-color','white');
if($('#button7').hasClass('clicked'))
			$('#button7').removeClass("clicked");
		add();
});

$('#button9').click(function(){
    $(this).css('background-color','#D4EDF6');
    $(this).addClass('clicked');
	    $('#button10').css('background-color','white');
if($('#button10').hasClass('clicked'))
			$('#button10').removeClass("clicked");
		add();

});
$('#button10').click(function(){
    $(this).css('background-color','#D4EDF6');
	    $('#button9').css('background-color','white');
    $(this).addClass('clicked');
if($('#button9').hasClass('clicked'))
			$('#button9').removeClass("clicked");
		add();
});

$('#button7').click(function(){
    $(this).css('background-color','#D4EDF6');
	    $('#button8').css('background-color','white');
    $(this).addClass('clicked');
if($('#button8').hasClass('clicked'))
			$('#button8').removeClass("clicked");
		add();
});
$('#button3').click(function(){
    $(this).css('background-color','#D4EDF6');
	    $('#button4').css('background-color','white');
		$('#button5').css('background-color','white');
		$('#button6').css('background-color','white');
    $(this).addClass('clicked');
if($('#button4').hasClass('clicked'))
			$('#button4').removeClass("clicked");
if($('#button5').hasClass('clicked'))
			$('#button5').removeClass("clicked");
if($('#button6').hasClass('clicked'))
			$('#button6').removeClass("clicked");
		add();
});
$('#button4').click(function(){
    $(this).css('background-color','#D4EDF6');
	    $('#button3').css('background-color','white');
		$('#button5').css('background-color','white');
		$('#button6').css('background-color','white');
    $(this).addClass('clicked');
if($('#button3').hasClass('clicked'))
			$('#button3').removeClass("clicked");
if($('#button5').hasClass('clicked'))
			$('#button5').removeClass("clicked");
if($('#button6').hasClass('clicked'))
			$('#button6').removeClass("clicked");
		add();
});
$('#button5').click(function(){
    $(this).css('background-color','#D4EDF6');
	    $('#button4').css('background-color','white');
		$('#button3').css('background-color','white');
		$('#button6').css('background-color','white');
    $(this).addClass('clicked');
if($('#button4').hasClass('clicked'))
			$('#button4').removeClass("clicked");
if($('#button3').hasClass('clicked'))
			$('#button3').removeClass("clicked");
if($('#button6').hasClass('clicked'))
			$('#button6').removeClass("clicked");
		add();
});
$('#button6').click(function(){
    $(this).css('background-color','#D4EDF6');
	    $('#button4').css('background-color','white');
		$('#button5').css('background-color','white');
		$('#button3').css('background-color','white');
    $(this).addClass('clicked');
if($('#button4').hasClass('clicked'))
			$('#button4').removeClass("clicked");
if($('#button5').hasClass('clicked'))
			$('#button5').removeClass("clicked");
if($('#button3').hasClass('clicked'))
			$('#button3').removeClass("clicked");
		add();
});