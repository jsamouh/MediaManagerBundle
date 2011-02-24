/* Sorry for that*/
jQuery(document).ready(function() {

    $("a.fancybox").fancybox(
            {
            'width' : '100%',
            'height' : '100%'
            });
    
    $('.media-delete').live('click', function(){
    	$(this).parent('div').remove();
    });
});
