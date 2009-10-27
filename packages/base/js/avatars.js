hp.set('packages.avatars', {
    open: false,
    statuses: {},

    init: function() {
	$(document).ready(function() {
	    hp.packages.avatars.create_base();
	});
	
	$(document).click(function(event) {
	    var target = $(event.target);
	    
	    if ( target.hasClass('user_avatar') ) {
		hp.packages.avatars.show_avatar(target);
	    } else {
		hp.packages.avatars.hide_avatar();
	    }
	});
    },
    
    create_base: function() {
	if ( ! $('#avatar_container').length ) {
	    $('<div id="avatar_container"><img /><div id="avatar_status" /></div>').appendTo(document.body);
	    
	    this.container = $('#avatar_container').hide();
	    this.image = this.container.find('img');
	    this.status = $('#avatar_status');
	    
	    this.container.css({
		position: 'absolute'
	    });
	    
	    this.image.css({
		width: '100%',
		height: '100%'
	    });
	}
    },
    
    show_avatar: function(img) {
	var id = img.attr('src');
	
	var user_id = id.split('/');
	user_id = user_id[user_id.length - 1];
	user_id = user_id.split('.')[0];
	
	if ( user_id != 'no_avatar' ) {
	    if ( this.open && this.to_url(user_id) == this.image.attr('src') )
		return false;
	    
	    var offset = img.offset();
	    
	    var newImage = this.create_avatar_img().attr('src', this.to_url(user_id));
	    
	    this.original_offset = {
		top: offset.top,
		left: offset.left,
		height: img.height(),
		width: img.width()
	    };
	    
	    if ( ! this.statuses[user_id] ) {
		$.get('/ajax_gateways/forum_signature.php?id=' + user_id, function(data){
		    hp.packages.avatars.status.html(data);
		    hp.packages.avatars.statuses[user_id] = data || '';
		});
	    } else {
		hp.packages.avatars.status.text(this.statuses[user_id]);
	    }

	    
	    this.container.show();
	    
	    if ( ! this.open ) {
		this.image.attr('src', newImage.attr('src'));
		this.animate_open(this.original_offset);
	    } else {
		this.animate_move(newImage);
	    }
	}
	return true;
    },
    
    animate_open: function(position) {
	    this.container
		.stop()
		.css(position)
		.animate({
		    opacity: 1,
		    left: 250,
		    top: $(document).scrollTop() + 50,
		    width: 320,
		    height: 427
		}, function() {
		    hp.packages.avatars.open = true;
	    });
    },
    
    animate_move: function(newImage) {
	    newImage.fadeInOnAnother(this.image, {
		callback: function(old) {
		    old.remove();
		    hp.packages.avatars.image = newImage;
		},
		
		appendType: 'prependTo'
	    });
	    
	    this.container.animate({
		'top': $(document).scrollTop() + 50
	    }, 'fast');
    },
    
    hide_avatar: function() {
	if ( this.container && this.container.css('display') != 'none' ) {
	    this.open = false;
	    
	    this.container.animate(this.original_offset, function() {
		hp.packages.avatars.container.hide();
	    })
	}
    },
    
    create_avatar_img: function() {
	return $('<img />').css({
	    width: '100%',
	    height: '100%'
	});
    },
    
    to_url: function(id) {
	return 'http://images.hamsterpaj.net/images/users/full/' + id + '.jpg';
    }
});

hp.packages.avatars.init();