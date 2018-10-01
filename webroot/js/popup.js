$(document).ready(function(){
	/* 画像を押す */
	$('.img').on('click',function()
		{
			var	index = $(this).index('.img');
			idname = index;
			$('#back-curtain')
		.css({
			'width' : $(window).width(),
			'height' : $(window).height()
		})
	.show();
	$('.largeImg',this)
		.css({
			'position': 'absolute',
			'left': Math.floor(($(window).width() - 800) / 2) +'px',
			'top': $(window).scrollTop() + 120 + 'px'
		})
	.show();
	$('#buttonR')
		.css({
			'position': 'absolute',
			'left': Math.floor(($(window).width() + 300) / 2) +'px',
			'top': $(window).scrollTop() + 320 + 'px'
		})
	.show();
	$('#buttonL')
		.css({
			'position': 'absolute',
			'left': Math.floor(($(window).width() - 750) / 2) +'px',
			'top': $(window).scrollTop() + 320 + 'px'
		})
	.show();

		});
/* スライドショーの操作 */
$('#buttonR').on('click',function()
		{
			if(idname<6){	
				$('.largeImg').eq(idname).fadeOut('slow', function(){
					$('.largeImg').eq(++idname)
					.css({
						'position': 'absolute',
						'left': Math.floor(($(window).width() - 800) / 2) +'px',
						'top': $(window).scrollTop() + 120 + 'px'
					})
				.fadeIn('slow');
				});
			}
		});


$('#buttonL').on('click',function()
		{
			if(idname>0){
				$('.largeImg').eq(idname).fadeOut('slow', function(){
					$('.largeImg').eq(--idname)
					.css({
						'position': 'absolute',
						'left': Math.floor(($(window).width() - 800) / 2) +'px',
						'top': $(window).scrollTop() + 120 + 'px'
					})
				.fadeIn('slow');

				});
			}
		});
/* スライドショーの終了 */
$('.largeImg, #back-curtain').on('click',function()
		{
			$('.largeImg').fadeOut('slow', function() { $('#back-curtain, #buttonR, #buttonL').hide();});
		});

});
