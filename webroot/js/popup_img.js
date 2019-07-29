$(document).ready(function(){
	var size = $(".img").length;
	const margin=300;    // 上下左右の最低マージン
	/* 画像を押す */
	$('.img').on('click',function()
		{
			//押した画像の情報を取得
			var img = new Image();
			img.src = $(this).children('img').attr('src');
			img_width = $(this).children('img').width();          // 幅
			img_height = $(this).children('img').height();        // 高さ
			img_ratio = img_height/img_width;   // 画像の幅高比	
			//ウィンドウサイズに合わせて表示
			var w;  var h;      // 幅、高さ

			if($(window).height() < $(window).width()){
				h = $(window).height()-margin;
				w = h/img_ratio;
			}else{
				w = $(window).width()-margin;
				h = w*img_ratio;
			}

			$(this).find('.largeImg').children('img').width(w);
			$(this).find('.largeImg').children('img').height(h);

			var	index = $(this).index('.img');
			idname = index;
			$('#back-curtain')
				.css({
					'position':'fixed',
					'width' : $(window).width(),
					'height' : $(window).height()
				})
				.show();
			$('.largeImg',this)
				.css({
					'position': 'absolute',
					'left': Math.floor(($(window).width()-w)/2) +'px',
					'top': $(window).scrollTop() + 120 + 'px',
				})
				.show();
			$('#buttonR')
				.css({
					'position': 'absolute',
					'left': Math.floor($(window).width()-50) +'px',
					'top': $(window).scrollTop() + 320 + 'px'
				})
				.show();
			$('#buttonL')
				.css({
					'position': 'absolute',
					'left': Math.floor(50) +'px',
					'top': $(window).scrollTop() + 320 + 'px'
				})
				.show();

		});
	/* スライドショーの操作 */
	$('#buttonR').on('click',function()
		{
			if(idname<size-1){
				//後で関数化//
				//次の画像の情報を取得
				++idname;

				var img = new Image();
				img.src = $('.img').eq(idname).children('img').attr('src');
				img_width = $('.img').eq(idname).children('img').width();          // 幅
				img_height = $('.img').eq(idname).children('img').height();        // 高さ
				img_ratio = img_height/img_width;   // 画像の幅高比	
				//ウィンドウサイズに合わせて表示
				var w;  var h;      // 幅、高さ

				if($(window).height() < $(window).width()){
					h = $(window).height()-margin;
					w = h/img_ratio;
				}else{
					w = $(window).width()-margin;
					h = w*img_ratio;
				}
				$('.largeImg').eq(idname).children('img').width(w);
				$('.largeImg').eq(idname).children('img').height(h);
				/////////////////////


				$('.largeImg').eq(idname-1).fadeOut('slow', function(){
					$('.largeImg').eq(idname)
						.css({
							'position': 'absolute',
							'left': Math.floor(($(window).width()-w)/2) +'px',
							'top': $(window).scrollTop() + 120 + 'px'
						})
						.fadeIn('slow');
				});
			}
		});


	$('#buttonL').on('click',function()
		{
			if(idname>0){
				//後で関数化//
				//次の画像の情報を取得
				--idname;
				var img = new Image();
				img.src = $('.img').eq(idname).children('img').attr('src');
				img_width = $('.img').eq(idname).children('img').width();          // 幅
				img_height = $('.img').eq(idname).children('img').height();        // 高さ
				img_ratio = img_height/img_width;   // 画像の幅高比	
				//ウィンドウサイズに合わせて表示
				var w;  var h;      // 幅、高さ

				if($(window).height() < $(window).width()){
					h = $(window).height()-margin;
					w = h/img_ratio;
				}else{
					w = $(window).width()-margin;
					h = w*img_ratio;
				}
				$('.largeImg').eq(idname).children('img').width(w);
				$('.largeImg').eq(idname).children('img').height(h);
				/////////////////////


				$('.largeImg').eq(idname+1).fadeOut('slow', function(){
					$('.largeImg').eq(idname)
						.css({
							'position': 'absolute',
							'left': Math.floor(($(window).width()-w)/2) +'px',
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

	/*  画面のリサイズに合わせる */
	$(window).resize(function(){
		var img = new Image();
		img.src = $('.img').eq(idname).children('img').attr('src');
		img_width = $('.img').eq(idname).children('img').width();          // 幅
		img_height = $('.img').eq(idname).children('img').height();        // 高さ
		img_ratio = img_height/img_width;   // 画像の幅高比	
		//ウィンドウサイズに合わせて表示
		var w;  var h;      // 幅、高さ

		if($(window).height() < $(window).width()){
			h = $(window).height()-margin;
			w = h/img_ratio;
		}else{
			w = $(window).width()-margin;
			h = w*img_ratio;
		}
		$('.largeImg').eq(idname).children('img').width(w);
		$('.largeImg').eq(idname).children('img').height(h);

		$('#back-curtain')
			.css({
				'width' : $(window).width(),
				'height' : $(window).height()
			});
		$('.largeImg')
			.css({
				'position': 'absolute',
				'left': Math.floor(($(window).width()-w)/2) +'px',
				'top': $(window).scrollTop() + 120 + 'px'
			});
		$('#buttonR')
			.css({
				'position': 'absolute',
				'left': Math.floor($(window).width()-50) +'px',
				'top': $(window).scrollTop() + 320 + 'px'
			});
		$('#buttonL')
			.css({
				'position': 'absolute',
				'left': Math.floor(50) +'px',
				'top': $(window).scrollTop() + 320 + 'px'
			});

	});

	$(window).scroll(function() {
		var img = new Image();
		img.src = $('.img').eq(idname).children('img').attr('src');
		img_width = $('.img').eq(idname).children('img').width();          // 幅
		img_height = $('.img').eq(idname).children('img').height();        // 高さ
		img_ratio = img_height/img_width;   // 画像の幅高比	
		//ウィンドウサイズに合わせて表示
		var w;  var h;      // 幅、高さ

		if($(window).height() < $(window).width()){
			h = $(window).height()-margin;
			w = h/img_ratio;
		}else{
			w = $(window).width()-margin;
			h = w*img_ratio;
		}
		$('.largeImg').eq(idname).children('img').width(w);
		$('.largeImg').eq(idname).children('img').height(h);

		$('#back-curtain')
			.css({
				'width' : $(window).width(),
				'height' : $(window).height()
			});
		$('.largeImg')
			.css({
				'position': 'absolute',
				'left': Math.floor(($(window).width()-w)/2) +'px',
				'top': $(window).scrollTop() + 120 + 'px'
			});
		$('#buttonR')
			.css({
				'position': 'absolute',
				'left': Math.floor($(window).width()-50) +'px',
				'top': $(window).scrollTop() + 320 + 'px'
			});
		$('#buttonL')
			.css({
				'position': 'absolute',
				'left': Math.floor(50) +'px',
				'top': $(window).scrollTop() + 320 + 'px'
			});


	});

});
