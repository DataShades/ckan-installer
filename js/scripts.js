$(document).ready(function(){
	$('input[type="radio"]').on('change', function(){
		var $texts = $(this).attr('title');
		var $tools = $(this).parent().siblings('div')
			.removeClass('red')
			.removeClass('green')
			.removeClass('top')
			.removeClass('center')
			.removeClass('bottom');
		
		/*
		## Get the title and add to tooltip message */			
		$(this).parent().siblings('div').find('span').text( $texts );
		
		/*
		## Get the class and add to tooltip div container */
		$(this).parent().siblings('div').addClass( $(this).attr('class') );
	});
});

$(function() {		
	$('input[type="radio"]').each(function(i, e){
		if( $(e).is(':checked') ) {
			/*
			## Get the class and add to tooltip div container */
			$(e).parent().siblings('div').addClass( $(e).attr('class') );
			/*
			## Get the title and add to tooltip message */	
			$(e).parent().siblings('div').find('span').text( $(e).attr('title') );
		}
	});
});