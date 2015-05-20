$(document).ready(function(){
    updateTooltips = function($this) {
        var $texts = $this.attr('title');
        var $tools = $this.parent().siblings('div')
            .removeClass('red')
            .removeClass('green')
            .removeClass('top')
            .removeClass('center')
            .removeClass('bottom');

        /*
         ## Get the title and add to tooltip message */
        $this.parent().siblings('div').find('span').text( $texts );

        /*
         ## Get the class and add to tooltip div container */
        $this.parent().siblings('div').addClass( $this.attr('class') );
    }
	$('input[type="radio"]').on('change', function(){
        updateTooltips($(this))
	});
    $(function() {
        $('input[type="radio"]').each(function(i, e){
            if( $(e).is(':checked') ) {
                updateTooltips($(e))
            }
        });
    });
});
