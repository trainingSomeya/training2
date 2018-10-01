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
});
