$(document).ready(function(){
	/* キャンセルボタンを押す */
	$('#add_img_list').on('click','.cancel_btn', function()
		{
			$(this).closest('li').find('#ImageFilename').val('');
		});

	/* 画像追加フォームの追加 */
	$('.add_btn').on('click',function()
		{
			$('#add_img_list').append(
				$('<li/>').attr({class: 'select_img'})
				.append(
					
					$('<div/>').attr({class: 'form-group'}).append(
						$('<input>').attr({
						type: 'file',
						name: 'data[Image][][filename]',
						class: 'form-control',
						accept:"image/*",
						id: 'ImageFilename'
					})),
					$('<input>').attr({
						type: 'button',
						class: 'cancel_btn',
						value: 'cancel'
					})
				)
			);
		});
});

