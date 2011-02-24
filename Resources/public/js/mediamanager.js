/* Sorry for that*/
var base_url = "";
var base_url_list_media = "";
var medias_association = new Array();
var medias 					= new Array();

jQuery(document).ready(function() {

	jQuery('#checkboxAll').change(function(){
		var checked = this.checked;
		jQuery('#tableMediaManagerList tr td input').each(function(){
				this.checked = checked;
		});
	});
	$('#tableMediaManagerList a.lightbox').lightBox();
	$('#imageCrop').Jcrop({
		aspectRatio: 1,
		onSelect: updateCoords
	});
	
	
	$('#selectAction').change(function(){
		 $("select option:selected").each(function () {
             	if (this.value == '_delete')
             		$('form').submit();
             	if (this.value == '_associate')
             		refreshAssociation();
             	
           });

	});
	
	$('.media-associate').click(function(){
		medias_association.push(this.id);
		refreshAssociation();
	});
	
	function refreshAssociation()
	{
		jQuery('#tableMediaManagerList tr td input:checked').each(function(){
			medias_association.push($(this).val());
		});
		
		parent.$.ajax(
				{
					url : base_url_list_media,
					dataType: "script",
					type: 'POST',
					async: false,
					data: { 'medias': medias_association },
					success: function(data){
						
						jQuery('#tableMediaManagerList tr td input').each(function(){
							medias[$(this).val()] = $(this).val();
						});
						
						parent.$('.list-medias-field').append(data);
						var tmp = new Array();
						parent.$('.list-medias-field input').each(function(){
							if (tmp[parent.$(this).val()] || !medias[parent.$(this).val()])
									parent.$(this).parent('div').remove();
							else
									tmp[parent.$(this).val()] = parent.$(this).val();
						});
					}
				}	
			);
			parent.$.fancybox.close();		
	}
	
});


function updateCoords(c)
{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
};


function initVariables(documentWebRootBundle, routingListMedias)
{
	base_url 				  = documentWebRootBundle;
	base_url_list_media = routingListMedias; 
}