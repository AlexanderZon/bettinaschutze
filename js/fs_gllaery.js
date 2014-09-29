/* 
	Kenburns Type Gallery Slider Script
	Version : 1.0.0
	Site	: under construction
	---
	Author	: Art Dark
	License : MIT License / GPL License
*/

jQuery.fn.fs_gallery = function(fs_options) {

	gallery_lightbox = function(){

		var item = function(item){
			//console.log(item);
			return '<a id="fancybox_'+item.ID+'" class="fancybox fancybox_'+item.ID+'" rel="fancybox_'+item.ID+'" href="'+item.src+'" title="'+item.post_title+'"><img src="'+item.src+'" alt="" height="80"/></a>';
		}

		var photo = function(photo, ID){
			//console.log(photo);
			return '<a id="fancybox_'+photo.ID+'" class="fancybox fancybox_'+ID+'" rel="fancybox_'+ID+'" href="'+photo.src+'" title="'+photo.post_title+'"><img src="'+photo.src+'" style="display:none" alt="" /></a>';
		}

		var video = function(video){
			//console.log(video);
			return '<a id="fancybox_'+video.ID+'" class="fancybox fancybox_'+video.ID+'" rel="fancybox_'+video.ID+'" href="'+video.content+'" title="'+video.post_title+'"><img src="'+video.src+'" alt="" /></a>';
		}

		var data = {
			'id': 312
		};

		var html = '';

		$.post('/wp-content/themes/bettinaschutze/core/gallery/ajax/ajax-gallery-lightbox.php', data, function(response) {

			//console.log(response);
			for(var i = 0 ; i < response.items.length ; i++ ){
				//console.log(response.items[i]);
				//console.log(item(response.items[i]));
				html += item(response.items[i]);
				for(var j = 0 ; j < response.items[i].photos.length ; j++ ){
					html += photo( response.items[i].photos[j],  response.items[i].ID);
					//console.log( photo( response.items[i].photos[j] ) );
				}
			}

			for(var i = 0 ; i < response.videos.length ; i++ ){
				//console.log(response.items[i]);
				//console.log(item(response.items[i]));
				html += video(response.videos[i]);
			}
			//console.log(html);
			$('.fs_thmb_viewport ').html(html);

			for(var i = 0 ; i < response.items.length ; i++ ){
				$('.fancybox_'+response.items[i].ID).fancybox({
		          	helpers: {
		              	title : {
		                  	type : 'float'
		              	}
		          	}
		      	});
			}

			for(var i = 0 ; i < response.videos.length ; i++ ){
				$('.fancybox_'+response.videos[i].ID).fancybox({
		          	helpers: {
		              	title : {
		                  	type : 'float'
		              	}
		          	}
		      	});
			}

			return html;
		});
	}

	photo_lightbox = function(){

		var item = function(item){
			//console.log(item);
			return '<a id="fancybox_'+item.ID+'" class="fancybox fancybox_'+item.ID+'" rel="fancybox_'+item.ID+'" href="'+item.src+'" title="'+item.post_title+'"><img src="'+item.src+'" alt="" height="80"/></a>';
		}

		var photo = function(photo, ID){
			//console.log(photo);
			return '<a id="fancybox_'+photo.ID+'" class="fancybox fancybox_'+ID+'" rel="fancybox_'+ID+'" href="'+photo.src+'" title="'+photo.post_title+'"><img src="'+photo.src+'" style="display:none" alt="" /></a>';
		}

		var video = function(video){
			//console.log(video);
			return '<a id="fancybox_'+video.ID+'" class="fancybox fancybox_'+video.ID+'" rel="fancybox_'+video.ID+'" href="'+video.content+'" title="'+video.post_title+'"><img src="'+video.src+'" alt="" /></a>';
		}

		var data = {
			'id': 312
		};

		var html = '';

		$.post('/wp-content/themes/bettinaschutze/core/gallery/ajax/ajax-gallery-lightbox.php', data, function(response) {

			//console.log(response);
			for(var i = 0 ; i < response.items.length ; i++ ){
				//console.log(response.items[i]);
				//console.log(item(response.items[i]));
				html += item(response.items[i]);
				for(var j = 0 ; j < response.items[i].photos.length ; j++ ){
					html += photo( response.items[i].photos[j],  response.items[i].ID);
					//console.log( photo( response.items[i].photos[j] ) );
				}
			}

			for(var i = 0 ; i < response.videos.length ; i++ ){
				//console.log(response.items[i]);
				//console.log(item(response.items[i]));
				html += video(response.videos[i]);
			}
			//console.log(html);
			$('.fs_thmb_viewport ').html(html);

			for(var i = 0 ; i < response.items.length ; i++ ){
				$('.fancybox_'+response.items[i].ID).fancybox({
		          	helpers: {
		              	title : {
		                  	type : 'float'
		              	}
		          	}
		      	});
			}

			for(var i = 0 ; i < response.videos.length ; i++ ){
				$('.fancybox_'+response.videos[i].ID).fancybox({
		          	helpers: {
		              	title : {
		                  	type : 'float'
		              	}
		          	}
		      	});
			}

			return html;
		});
	}

	video_lightbox = function(){
		console.log("Video click");
		var item = function(item){
			//console.log(item);
			return '<a id="fancybox_'+item.ID+'" class="fancybox fancybox_'+item.ID+'" rel="fancybox_'+item.ID+'" href="'+item.src+'" title="'+item.post_title+'"><img src="'+item.src+'" alt="" height="80"/></a>';
		}

		var photo = function(photo, ID){
			//console.log(photo);
			return '<a id="fancybox_'+photo.ID+'" class="fancybox fancybox_'+ID+'" rel="fancybox_'+ID+'" href="'+photo.src+'" title="'+photo.post_title+'"><img src="'+photo.src+'" style="display:none" alt="" /></a>';
		}

		var video = function(video){
			console.log(video);
			return '<a class="fancybox-media" href="'+video.post_content+'"><img src="'+video.src+'" alt="" height="80"/></a>';
		}

		var data = {
			'id': 383
		};

		var html = '';

		$.post('/wp-content/themes/bettinaschutze/core/gallery/ajax/ajax-gallery-lightbox.php', data, function(response) {
			console.log(data);
			for(var i = 0 ; i < response.items.length ; i++ ){
				html += item(response.items[i]);
				for(var j = 0 ; j < response.items[i].photos.length ; j++ ){
					html += photo( response.items[i].photos[j],  response.items[i].ID);
				}
			}

			for(var i = 0 ; i < response.videos.length ; i++ ){
				//console.log(response.items[i]);
				//console.log(item(response.items[i]));
				html += video(response.videos[i]);
			}

			$('.fs_thmb_viewport ').html(html);

			for(var i = 0 ; i < response.items.length ; i++ ){
				$('.fancybox_'+response.items[i].ID).fancybox({
		          	helpers: {
		              	title : {
		                  	type : 'float'
		              	}
		          	}
		      	});
			}
			/*$('.fancybox-media').click(function(e){
				e.preventDefault();
			});*/

			$('.fancybox-media').fancybox({
	          	openEffect  : 'none',
				closeEffect : 'none',
				helpers : {
					media : {}
				}
	      	});
			/*for(var i = 0 ; i < response.videos.length ; i++ ){
				$('.fancybox_'+response.videos[i].ID).fancybox({
		          	helpers: {
		              	title : {
		                  	type : 'float'
		              	}
		          	}
		      	});
			}*/

			return html;
		});
	}

	contact_lightbox = function(){

	}

	bio_lightbox = function(){

	}

	//Set Variables
	var fs_el = $(this),
		fs_base = this;
	var fs_interval = setInterval('nextSlide()', fs_options.slide_time);

	if (fs_options.thmb_state == 'hide') {
		set_state = "fs_hide";
	} else {
		set_state = "";
	}


	$('body').append('<div class="fs_gallery_wrapper"><ul class="fs_gallery_container '+fs_options.fx+'"/><a href="javascript:void(0)" class="fs_slider_prev"/><a href="javascript:void(0)" class="fs_slider_next"/><div class="fs_title_wrapper '+set_state+'"><h1 class="fs_title"></h1><h6 class="fs_descr"></h6></div><div class="fs_thmb_viewport '+set_state+'"><div class="fs_thmb_wrapper" style="display:none"><ul class="fs_thmb_list" style="width:'+fs_options.slides.length*88+'px"/></div></div>');
	$('header ul.menu').append('<li class="thumb_toggle"><a href="javascript:void(0)"></a></li>');
	$fs_container = $('.fs_gallery_container');
	$fs_thmb = $('.fs_thmb_list');
	$fs_title = $('.fs_title_wrapper');
	thisSlide = 0;
	while(thisSlide <= fs_options.slides.length-1){
		$fs_container.append('<li class="fs_slide slide'+thisSlide+'" data-count="'+thisSlide+'" data-fit="'+fs_options.slides[thisSlide].fit+'" data-src="'+fs_options.slides[thisSlide].image+'"></li>');
		$fs_thmb.append('<li class="fs_slide_thmb slide'+thisSlide+'" data-count="'+thisSlide+'"><img alt="'+fs_options.slides[thisSlide].alt+' '+thisSlide+'" src="'+fs_options.slides[thisSlide].thmb+'"/><div class="fs_thmb_fadder"></div></li>');
		thisSlide++;
	}	
	$fs_container.find('li.slide0').addClass('current-slide').attr('style', 'background:url('+$fs_container.find('li.slide0').attr('data-src')+') no-repeat; background-size:'+$fs_container.find('li.slide0').attr('data-fit')+';');
	$fs_container.find('li.slide1').attr('style', 'background:url('+$fs_container.find('li.slide1').attr('data-src')+') no-repeat; background-size:'+$fs_container.find('li.slide1').attr('data-fit')+';');
	$('.fs_title').text(fs_options.slides[0].title);
	$('.fs_descr').html(fs_options.slides[0].description);
	$('.fs_thmb_viewport').width($(window).width()-$fs_title.width()-58);
	
	$('.fs_slide_thmb').click(function(){
		goToSlide(parseInt($(this).attr('data-count')));
	});
	$('.fs_slider_prev').click(function(){
		prevSlide();
	});
	$('.fs_slider_next').click(function(){
		nextSlide();
	});
	$('.thumb_toggle a').click(function(){
		$('.fs_title_wrapper').toggleClass('fs_hide');
		$('.fs_thmb_viewport').toggleClass('fs_hide');
	});
	
	nextSlide = function() {
		beforeChange();
		clearInterval(fs_interval);		
		thisSlide = parseInt($('.fs_gallery_container').find('.current-slide').attr('data-count'));
		thisSlide++;
		cleanSlide = thisSlide-2;
		nxtSlide = thisSlide+1;
		if (thisSlide == $('.fs_gallery_container').find('li').size()) {
			thisSlide = 0;
			cleanSlide = $('.fs_gallery_container').find('li').size()-3;
			nxtSlide = thisSlide+1;
		}
		if (thisSlide == 1) {
			cleanSlide = $('.fs_gallery_container').find('li').size()-2;
		}

		$('.fs_title').fadeOut(300);
		$('.fs_descr').fadeOut(300, function(){
			if (fs_options.slides[thisSlide].title == '' && fs_options.slides[thisSlide].description == "") {
				$fs_title.addClass('notext');
				$('.fs_thmb_viewport').width($(window).width()).css('left', '0px');							
			} else {
				$fs_title.removeClass('notext');
				$('.fs_thmb_viewport').width($(window).width()-$fs_title.width()-58).css('left', $fs_title.width()+58+'px');
				$('.fs_title').text(fs_options.slides[thisSlide].title);
				$('.fs_descr').html(fs_options.slides[thisSlide].description);
			}
			$('.fs_title').fadeIn(300);
			$('.fs_descr').fadeIn(300);
		});
		
		$('.fs_gallery_container').find('.slide'+cleanSlide).attr('style', '');
		$('.fs_gallery_container').find('.slide'+thisSlide).attr('style', 'background:url('+$('.slide'+thisSlide).attr('data-src')+') no-repeat; background-size:'+$('.slide'+thisSlide).attr('data-fit')+';');
		$('.fs_gallery_container').find('.slide'+(nxtSlide)).attr('style', 'background:url('+$('.slide'+(thisSlide+1)).attr('data-src')+') no-repeat; background-size:'+$('.slide'+nxtSlide).attr('data-fit')+';');
		$('.current-slide').removeClass('current-slide');
		$('.slide'+thisSlide).addClass('current-slide');
		fs_interval = setInterval('nextSlide()', fs_options.slide_time);
		setTimeout("afterChange()",500);
	}

	prevSlide = function() {
		beforeChange();
		clearInterval(fs_interval);		
		thisSlide = parseInt($('.fs_gallery_container').find('.current-slide').attr('data-count'));
		thisSlide--;
		nxtSlide = thisSlide-1;
		cleanSlide = thisSlide+2;
		if (thisSlide < 0 ) {
			thisSlide = $('.fs_gallery_container').find('li').size()-1;
			cleanSlide = 1;
		}
		if (thisSlide == $('.fs_gallery_container').find('li').size()-2) {
			cleanSlide = 0;
		}
		$('.fs_title').fadeOut(300);
		$('.fs_descr').fadeOut(300, function(){
			if (fs_options.slides[thisSlide].title == '' && fs_options.slides[thisSlide].description == "") {
				$fs_title.addClass('notext');
				$('.fs_thmb_viewport').width($(window).width()).css('left', '0px');							
			} else {
				$fs_title.removeClass('notext');
				$('.fs_thmb_viewport').width($(window).width()-$fs_title.width()-58).css('left', $fs_title.width()+58+'px');
				$('.fs_title').text(fs_options.slides[thisSlide].title);
				$('.fs_descr').html(fs_options.slides[thisSlide].description);
			}
			$('.fs_title').fadeIn(300);
			$('.fs_descr').fadeIn(300);
		});

		$('.fs_gallery_container').find('.slide'+(cleanSlide)).attr('style', '');
		$('.fs_gallery_container').find('.slide'+thisSlide).attr('style', 'background:url('+$('.slide'+thisSlide).attr('data-src')+') no-repeat; background-size:'+$('.slide'+thisSlide).attr('data-fit')+';');
		$('.fs_gallery_container').find('.slide'+(nxtSlide)).attr('style', 'background:url('+$('.slide'+(thisSlide+1)).attr('data-src')+') no-repeat; background-size:'+$('.slide'+nxtSlide).attr('data-fit')+';');
		$('.current-slide').removeClass('current-slide');
		$('.slide'+thisSlide).addClass('current-slide');
		fs_interval = setInterval('nextSlide()', fs_options.slide_time);		
		setTimeout("afterChange()",500);
	}
	
	goToSlide = function(set_slide)  {	
		beforeChange();
		clearInterval(fs_interval);
		oldSlide = parseInt($('.fs_gallery_container').find('.current-slide').attr('data-count'));
		thisSlide = set_slide

		$('.fs_title').fadeOut(300);
		$('.fs_descr').fadeOut(300, function(){
			if (fs_options.slides[thisSlide].title == '' && fs_options.slides[thisSlide].description == "") {
				$fs_title.addClass('notext');
				$('.fs_thmb_viewport').width($(window).width()).css('left', '0px');							
			} else {
				$fs_title.removeClass('notext');
				$('.fs_thmb_viewport').width($(window).width()-$fs_title.width()-58).css('left', $fs_title.width()+58+'px');
				$('.fs_title').text(fs_options.slides[thisSlide].title);
				$('.fs_descr').html(fs_options.slides[thisSlide].description);
			}
			$('.fs_title').fadeIn(300);
			$('.fs_descr').fadeIn(300);
		});
		
		$('.fs_gallery_container').find('.fs_slide').attr('style', '');
		$('.fs_gallery_container').find('.slide'+thisSlide).attr('style', 'background:url('+$('.slide'+thisSlide).attr('data-src')+') no-repeat; background-size:'+$('.slide'+thisSlide).attr('data-fit')+';');
		$('.fs_gallery_container').find('.slide'+(thisSlide+1)).attr('style', 'background:url('+$('.slide'+(thisSlide+1)).attr('data-src')+') no-repeat; background-size:'+$('.slide'+thisSlide+1).attr('data-fit')+';');
		$('.current-slide').removeClass('current-slide');
		$('.slide'+thisSlide).addClass('current-slide');
		fs_interval = setInterval('nextSlide()', fs_options.slide_time);
		setTimeout("afterChange()",500);
	}
	
	beforeChange = function(slide) {
		//$fs_title.addClass('change');
	}
	afterChange = function(slide) {
		//$fs_title.removeClass('change');
	}

	$(document).on('ready', function(){
		var html = gallery_lightbox();
	});

	var menu_items = {
		'home': '48',
		'photos':'72',
		'videos':'73',
		'bio':'74',
		'contant':'75'
	}
		
	$('#menu-item-73').click(function(e){
		e.preventDefault();
		console.log("Click");
		var html = video_lightbox();
	});
		
	$('#menu-item-48').click(function(e){
		e.preventDefault();
		console.log("Click");
		var html = gallery_lightbox();
	});
	
	$('.fs_thmb_viewport').width($(window).width()-$fs_title.width()-58)
		.mouseenter(function(){
			var h = $(this).width(),
				tlist = $('.fs_thmb_list');
				window._s_top = parseInt(tlist.css('left'));
				window._sh = setInterval(function(){
				if (
					(window._s_top >= 0 && window._sp > 0) || 
					(window._s_top < 0 && window._s_top > -(tlist.width() - h)) || 
					(window._sp < 0 && window._s_top <= -(tlist.width() - h))
				) {
					var sign = (window._sp >= 0),
						val = Math.pow(window._sp * 15, 2),
						val = (sign)?val:-val;
					window._s_top -= val;
					if (window._s_top > 0){
						window._s_top = 0;
					}
					if (window._s_top < -(tlist.width() - h)){
						window._s_top = -(tlist.width() - h);
					}
					if ($('.fs_thmb_list').width() > $('.fs_thmb_viewport').width()) {
						tlist.stop().animate({
							left: window._s_top
						}, 500);
					}
				}
			}, 100);
		}).mouseleave(function(){
			clearInterval(window._sh);
		}).mousemove(function(e){
			var correction = $fs_title.width()+58;
				y = e.pageX-correction;
				h = $(this).width(),
				p = y / h;
										
			if (y > ($(window).width()-correction)*0.8) {
				window._sp = Math.round((p - 0.5) * 50) / 50;
			}
			else if (y < ($(window).width()-correction)*0.2) {
				window._sp = Math.round((p - 0.5) * 50) / 50;
			}
			else {window._sp =0}
		});		
}
/*function nextSlide() {
}*/


$(document).ready(function(){
	$('.fs_thmb_list').mousedown(function(){
		$('.fs_thmb_list').addClass('clicked');
	});
	$('.fs_thmb_list').mouseup(function(){
		$('.fs_thmb_list').removeClass('clicked');
	});
	
});
$(window).resize(function(){
	$('.fs_thmb_viewport').width($(window).width()-$('.fs_title_wrapper').width()-58);
	$('.fs_thmb_list').css('left','0px');
});