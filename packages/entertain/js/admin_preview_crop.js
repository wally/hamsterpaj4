$(function(){
			$('#entertain_preview_cropper_photo').Jcrop({
				aspectRatio: 4.26388,
				onSelect: updateCoords,
				onChange: updateCoords
			});
		});
		
		function updateCoords(c)
		{
			showPreview(c);
			$("#307x72_x1").val(c.x);
			$("#307x72_y1").val(c.y);
			$("#307x72_x2").val(c.w);
			$("#307x72_y2").val(c.h);
		}
		
		function showPreview(coords)
		{
			var rx = 307 / coords.w;
			var ry = 72 / coords.h;
			
			var orig_width = $('#entertain_preview_cropper_photo').width();
			var orig_height = $('#entertain_preview_cropper_photo').height();
			
			$("#crop_307x72 img").css({
				width: Math.round(rx*orig_width)+'px',
				height: Math.round(ry*orig_height)+'px',
				marginLeft:'-'+  Math.round(rx*coords.x)+'px',
				marginTop: '-'+ Math.round(ry*coords.y)+'px'
			});
		}