$(function(){

	var imageBg = getImageBG($('body').attr('class'));
	$('body').ezBgResize({
		img : homeRoot+'/images/backgrounds/'+imageBg,
		opacity : 1, 
		center  : true 
	});

	$('nav ul li').first().css('border-top', '1px solid #ffffff');

	$('nav ul li').bind('mouseenter', function() {
		if(!$(this).hasClass('active')) {
			$(this).children('ul').stop().slideDown(); }
	});
	$('nav ul li').bind('mouseleave', function() {
		if(!$(this).hasClass('active')) {
			$(this).children('ul').stop().slideUp(); }
	});

	$('#header h1 a.logo').html('<img src="'+homeRoot+'/images/layout/logo.png" />');
	
	$(".mycarousel").jcarousel({
		itemLoadCallback: mycarousel_itemLoadCallback,
		initCallback: mycarousel_initCallback,
		visible:1,
		scroll: 1,
		auto: 4, // seconds
		wrap: "both"
	});

	if($('.sectionContent p').size() > 1){
		$('.sectionContent p').each(function(index){
			if(index > 0){
				$(this).css('display','none');
			}
		})
		$('.sectionContent a.more').fadeIn();
	}

	$('.sectionContent a.more').click(function(){
		$(this).fadeOut();
		$('.sectionContent p').each(function(index){
			if(index > 0){
				$(this).fadeIn();
			}
		})
	})
})

function getImageBG(section) {
	arraySection = section.split(" ");;
	var arrayImageBg = new Array(); 

	arrayImageBg = {
		'home' : {
			'default' : 'fusion-del-oro-624023.jpg'},
		'perlen' : {
			'tahiti-perlen' : 'napo-uw-greatb-reef.jpg',
			'default' : 'napo-uw-greatb-reef.jpg'
		}, 
		'default' : 'fusion-del-oro-624023.jpg'
	}

	if(arraySection[0] in arrayImageBg) {
		auxSection = arraySection[0];
		if(arraySection[1] in arrayImageBg[auxSection]) {
			auxSectionSub = arraySection[1];
			return arrayImageBg[auxSection][auxSectionSub];
		}
		else{
			return arrayImageBg[auxSection]['default'];	
		}
	}
	else {
		return arrayImageBg['default'];
	}
}

function mycarousel_initCallback(carousel){
	carousel.clip.bind('mouseenter', function() {
		carousel.stopAuto();
	});
	carousel.clip.bind('mouseleave', function() {
		carousel.startAuto();
	}); 
}

function mycarousel_itemLoadCallback(carousel, state) {
	// Check if the requested items already exist
	if (carousel.has(carousel.first, carousel.last)) {
		return;
	}

	jQuery.get(
		homeRoot+'/images_slider.php',
		{
			first: carousel.first,
			last: carousel.last,
			section: $(".mycarousel").data('section'),
			subsection: $(".mycarousel").data('subsection'),
			lang: $(".mycarousel").data('lang')
		},
		function(xml) {
			mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, xml);
		},
		'xml'
	);
};

function mycarousel_itemAddCallback(carousel, first, last, xml) {
	// Set the size of the carousel
	carousel.size(parseInt(jQuery('total', xml).text()));

	jQuery('item', xml).each(function(i) {
		carousel.add(first + i, mycarousel_getImageHTML(jQuery(this).find('image').text(),jQuery(this).find('text').text()));
	});
};

function mycarousel_getImageHTML(url, text) {
	var imagen = $('<img>', { 'src': url, 'alt': '' });
	var footer = $('<p>').html(text);
	var itemContent = $('<div>', { 'class': 'sliderItemContent'});

	itemContent.append(footer);
	itemContent.append(imagen);

	return itemContent;
};
