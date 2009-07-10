$(document).ready(function () {
	$('#crop_previews > li').click(function() {
		$('#crop_previews > li').removeClass('active');
		$(this).addClass('active');
		
		var aspect_ratio = this.id.substr(5);
		$('#entertain_preview_cropper_photo').imgAreaSelect({ aspectRatio: aspect_ratio.replace('x', ':'), onSelectChange: function(img, selection){
				$('#crop_' + aspect_ratio + ' > img').css({
					marginLeft: '-' + Math.round(($('#crop_' + aspect_ratio).width() / selection.width) * selection.x1) + 'px', 
					marginTop: '-' + Math.round(($('#crop_' + aspect_ratio).height() / selection.height) * selection.y1) + 'px',
					width: Math.round($('#crop_' + aspect_ratio).width() / (selection.width / $('#entertain_preview_cropper_photo').width()))
				});
				
			
				$('#' + aspect_ratio + '_x1').val(Math.round(selection.x1));
				$('#' + aspect_ratio + '_x2').val(Math.round(selection.x2));
				$('#' + aspect_ratio + '_y1').val(Math.round(selection.y1));
				$('#' + aspect_ratio + '_y2').val(Math.round(selection.y2));
			}
		 });
	});
}); 
