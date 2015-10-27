$(document).ready(function(){

	$('#countrylist').change (function () {
		var index = $("#countrylist").val();

		$.ajax ({
			type: "POST",
			url: "logincity.php",
			dataType: "json",
			data: {country: index },
		
			success: function ($data) {
				//alert($data);
				//$('#city').text($data);
				
				var json = $data;
				
				var string = '\n';
				
				$('#city').find('option').remove().end();
				
				$.each(JSON.parse(json), function(idx, obj) {
					
					$('#city').append($('<option>', { 
						value: obj.id_city,
						text : obj.city_name 
					}));
					
					//string += obj.id_city + " - " + obj.city_name + "\n";
				});

				//alert(string);
			}                                    
		});
		return false;
	}).change();
	
	$('#btn-submit').click(function() {
		var username = $("#userName").val();
		
		if(username === ""){
			$( "#verno" ).css({ "display":"none", "color":"" }).html("");
			$( "#neverno" ).css({ "display":"inline", "color":"red" }).html('Необходимо заполнить обязательное поле \"Логин\".');
		} else {
			var usernameRegex = new RegExp(/^[A-Za-z0-9]{5,20}$/i);
		
			//alert(usernameRegex.test(username));
			
			if (usernameRegex.test(username)) {
				//alert("OK!");
				$( "#neverno" ).css({ "display":"none", "color":"" }).html("");
				$( "#verno" ).css({ "display":"inline", "color":"#00FF00" }).html("OK!");
			} else { 
				//alert ('Wrong format of userName.');
				$( "#verno" ).css({ "display":"none", "color":"" }).html("");
				$( "#neverno" ).css({ "display":"inline", "color":"red" }).html('От 5 до 20 символов: большие и маленькие буквы латинского алфавита, цифры от 0 до 9');
			}
		}
		
		var password = $("#password").val();
		
		if(password === ""){
			$( "#verno1" ).css({ "display":"none", "color":"" }).html("");
			$( "#neverno1" ).css({ "display":"inline", "color":"red" }).html('Необходимо заполнить обязательное поле \"Пароль\".');
		} else {
			var passwordRegex = new RegExp(/^[A-Za-z0-9]{5,20}$/i);
			
			if (passwordRegex.test(password)) {
				$( "#neverno1" ).css({ "display":"none", "color":"" }).html("");
				$( "#verno1" ).css({ "display":"inline", "color":"#00FF00" }).html("OK!");
			} else { 
				$( "#verno1" ).css({ "display":"none", "color":"" }).html("");
				$( "#neverno1" ).css({ "display":"inline", "color":"red" }).html('От 5 до 20 символов: большие и маленькие буквы латинского алфавита, цифры от 0 до 9');
			}
		}
		
		var password2 = $("#password2").val();
		
		if(password2 === ""){
			$( "#verno2" ).css({ "display":"none", "color":"" }).html("");
			$( "#neverno2" ).css({ "display":"inline", "color":"red" }).html('Поле \"Еще раз пароль\" должно быть заполнено.');
		} else {
			$( "#neverno2" ).css({ "display":"none", "color":"" }).html("");
			
			if(password === password2){
				$( "#neverno2" ).css({ "display":"none", "color":"" }).html("");
				$( "#verno2" ).css({ "display":"inline", "color":"#00FF00" }).html("OK!");
			} else {
				$( "#verno2" ).css({ "display":"none", "color":"" }).html("");
				$( "#neverno2" ).css({ "display":"inline", "color":"red" }).html('Поля \"Пароль\" и \"Еще раз пароль\" должны быть идентичными.');
			}
		}
		
		var phone = $("#phone").val();
		
		if(phone === ""){
			$( "#verno3" ).css({ "display":"none", "color":"" }).html("");
			$( "#neverno3" ).css({ "display":"inline", "color":"red" }).html('Необходимо заполнить обязательное поле \"Телефон\".');
		} else {
			var phoneRegex = new RegExp(/^((\+38)( ))?((\(?[0]{1}\d{2}\)?)( ))?\d{3}((-| )\d{2}){2}$/i);
			
			if (phoneRegex.test(phone)) {
				$( "#neverno3" ).css({ "display":"none", "color":"" }).html("");
				$( "#verno3" ).css({ "display":"inline", "color":"#00FF00" }).html("OK!");
			} else { 
				$( "#verno3" ).css({ "display":"none", "color":"" }).html("");
				$( "#neverno3" ).css({ "display":"inline", "color":"red" }).html('От 13 до 19 символов в формате +38 (093) 937-99-92, 093 937 99 92, (093) 937 99 92.');
			}
		}
		
		var invite = $("#invite").val();
		
		if(invite === ""){
			$( "#verno4" ).css({ "display":"none", "color":"" }).html("");
			$( "#neverno4" ).css({ "display":"inline", "color":"red" }).html('Необходимо заполнить обязательное поле \"Инвайт\".');
		} else {
			var inviteRegex = new RegExp(/^[^0]{1}[0-9]{5}$/i);
			
			if (inviteRegex.test(invite)) {
				
				$( "#neverno4" ).css({ "display":"none", "color":"" }).html("");
				
				$.ajax ({
					type: "POST",
					url: "invite.php",
					dataType: "json",
					data: {id_invite: invite },
				
					success: function ($data) {
						var obj = JSON.parse($data);
						
						//alert(obj.invite + "\n" + obj.status);
						
						if($data != false && obj.status == 0){
							$( "#verno4" ).css({ "display":"inline", "color":"#00FF00" }).html("OK!");
							
							var city = $('#city').val();
							
							$.ajax ({
								type: "POST",
								url: "registration.php",
								dataType: "json",
								data: {
									username: username,
									password: password,
									phone: phone,
									city: city,
									invite: invite 
								},
							
								success: function ($data) {
									var obj = JSON.parse($data);

									if(obj.number === '1'){
										window.location.href = "success.php";
									} else {
										alert(obj.message);
									}
								}                                    
							});
							
						} else {
							$( "#verno4" ).css({ "display":"none", "color":"" }).html("");
							$( "#neverno4" ).css({ "display":"inline", "color":"red" }).html('Ваш \"Инвайт\" уже занят. Введите другой \"Инвайт\".');
						}
					}                                    
				});
			} else { 
				$( "#verno4" ).css({ "display":"none", "color":"" }).html("");
				$( "#neverno4" ).css({ "display":"inline", "color":"red" }).html('Состоит из 6 цифр, первая из которых не может быть 0.');
			}
		}
		
	});
	
	$('#btn-reset').click(function() {
		$("#userName").val('').html('');
		$("#password").val('').html('');
		$("#password2").val('').html('');
		$("#phone").val('').html('');
		$("#countrylist").val(233);
		$('#city').find('option').remove().end();
		$("#invite").val('').html('');
		
	});
	
});