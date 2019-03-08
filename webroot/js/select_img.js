$(document).ready(function(){
/* キャンセルボタンを押す */
	$('.cancel_btn').on('click',function()
		{
			$('.cancel_btn').closest('div').find('.form-control').val('');
		});
});
