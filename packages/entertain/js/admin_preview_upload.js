/*
	Ja, ajax-historien som tar emot det här är skyddat genom privilegiesystemet, kolla github...
*/

$(document).ready(function() {
	if($('#entertain_edit_preview_upload_submit')) {
		$('#entertain_edit_preview_upload_submit').click(function() {
			window.open('/entertain-admin/preview_upload?handle=' + this.name, 'fullscreen_window', 'width=' + screen.width + ', height=' + screen.height + ', toolbar=no, location=no');
			$('#entertain_edit_preview_confirm').show();
			
			return false;
		});
	}
	
	$('#entertain_edit_preview_confirm_success').click(function() {
		$('#entertain_edit_preview_confirm').hide(250);
		$('#entertain_admin_preview_image').attr({src: 'http://static.hamsterpaj.net/images/entertain/items/' + $('#entertain_admin_preview_image').attr('name') + '/medium.png?' + Math.random()});
		$('#entertain_admin_has_image_1').attr({checked: true});
		return false;
	});

	$('#entertain_edit_preview_confirm_fail').click(function() {
		$('#entertain_edit_preview_confirm').hide(250);
		$('#entertain_admin_has_image_0').attr({checked: true});
		return false;
	});
});