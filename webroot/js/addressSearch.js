$(function () {
	//検索ボタンをクリックされたときに実行
	$("#search_btn").click(function () {
		//検索結果をリセット
		$('#zip_result').children().remove();
		//入力値をセット
		var param = {zipcode: $('#zipcode').val()};
		var send_url = "/users/search";
		$.ajax({
			type: "post",
			data: param,
			url: send_url,
			dataType: "json",
			success: function (res) {
				$('#zip_result').empty();
				//該当する住所を表示
				if(res!==null){
				res.forEach(function(value) {
					add = '';
					add +=  value.PostalCode.state;
					add +=  value.PostalCode.city;
					add +=  value.PostalCode.street;
					$('#zip_result').append($('<option>').text(add));
				});
				//alert(JSON.stringify(res));
				//alert(JSON.stringify(add));
				}else{
					alert("not exist");
				}
			},
			error: function (res, status, errors) {
				alert(res + ', ' + status + ', ' + errors);
			}
		});
		return false;
	});
	//検索結果を選択
	$("#select_btn").click(function () {
		$('#select_result').val($('#zip_result').val());
	});

	$("#region").change(function () {
		//入力値をセット
		var param = {region: $("#region").val()};
		var send_url = "/users/region_search";
		$.ajax({
			type: "post",
			data: param,
			url: send_url,
			dataType: "json",
			success: function (res) {
				$('#prefecture').empty();
				$('#city').empty();
				$('#street').empty();
				//該当する住所を表示
				if(res!==null){
					$('#prefecture').append($('<option>').text('選択してください').prop("disabled", true).prop("selected", true));
				res.forEach(function(value) {
					add = '';
					add +=  value.PostalCode.state;
					$('#prefecture').append($('<option>').text(add));
				});
				//alert(JSON.stringify(res));
				//alert(JSON.stringify(add));
				}else{
					alert("not exist");
				}
			},
			error: function (res, status, errors) {
				alert(res + ', ' + status + ', ' + errors);
			}
		});

		$("#button_search_btn").hide();
		return false;
	});

	$("#prefecture").change(function () {
		//入力値をセット
		var param = {prefecture: $("#prefecture").val()};
		var send_url = "/users/region_search";
		$.ajax({
			type: "post",
			data: param,
			url: send_url,
			dataType: "json",
			success: function (res) {
				$('#city').empty();
				$('#street').empty();
				//該当する住所を表示
				if(res!==null){
					$('#city').append($('<option>').text('選択してください').prop("disabled", true).prop("selected", true));
				res.forEach(function(value) {
					add = '';
					add +=  value.PostalCode.city;
					$('#city').append($('<option>').text(add));
				});
				//alert(JSON.stringify(res));
				//alert(JSON.stringify(add));
				}else{
					alert("not exist");
				}
			},
			error: function (res, status, errors) {
				alert(res + ', ' + status + ', ' + errors);
			}
		});

		$("#button_search_btn").hide();
		return false;
	});

    $("#city").change(function () {
		//入力値をセット
		var param = {city: $("#city").val()};
		var send_url = "/users/region_search";
		$.ajax({
			type: "post",
			data: param,
			url: send_url,
			dataType: "json",
			success: function (res) {
				$('#street').empty();
				//該当する住所を表示
				if(res!==null){
					$('#street').append($('<option>').text('選択してください').prop("disabled", true).prop("selected", true));
				res.forEach(function(value) {
					add = '';
					add +=  value.PostalCode.street;
					$('#street').append($('<option>').text(add));
				});
				//alert(JSON.stringify(res));
				//alert(JSON.stringify(add));
				}else{
					alert("not exist");
				}
			},
			error: function (res, status, errors) {
				alert(res + ', ' + status + ', ' + errors);
			}
		});

		$("#button_search_btn").hide();
		return false;

	});
    $("#street").change(function () {
		$("#button_search_btn").show();
	});
	$("#button_search_btn").click(function () {
		var result = $("#prefecture").val() + $("#city").val() + $("#street").val();
		$('#select_result').val(result);
	});
});
