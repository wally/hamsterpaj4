hp.set('packages.eggs', {
    supercoloractivatorposition: {x: 330, y: 17},
    supercurrentcolor: [0, 255, 0],
    supercurrentdirections: ['+', '-', '+'],
    
    init: function() {
	$(document).ready(function() {
	    var position = $('#hp #head h2 a').offset();
	    hp.packages.eggs.supercoloractivatorposition.x += position.left;
	    hp.packages.eggs.supercoloractivatorposition.y += position.top;
	    
	    $('#hp #head h2 a').click(hp.packages.eggs.supercolors);
	});
    },
    
    supercolors: function(e) {
	var pos = {x: e.clientX, y: e.clientY};
	
	if (
	    pos.x > hp.packages.eggs.supercoloractivatorposition.x
	    && pos.x < hp.packages.eggs.supercoloractivatorposition.x + 10
	    && pos.y > hp.packages.eggs.supercoloractivatorposition.y
	    && pos.y < hp.packages.eggs.supercoloractivatorposition.y + 15
	) {
	    hp.packages.eggs.go_crazy();
	    return false;
	}
    },
    
    go_crazy: function() {
	/*setInterval(function() {
	    var color = hp.packages.eggs.supercurrentcolor,
		c = [];
	    
	    // Add to rgb
	    for ( var i = 0; i < 3; i++ ) {
		switch ( hp.packages.eggs.supercurrentdirections[i] ) {
		    case '+':
			if ( (color[i] = Math.max(256, color[i] + 5)) > 255 )
			    hp.packages.eggs.supercurrentdirections[i] = '-';
		    break;
		    
		    case '-':
			if ( (color[i] = Math.max(-1, color[i] - 5)) < 0 )
			    hp.packages.eggs.supercurrentdirections[i] = '+';
		    break;
		}
		c[i] = (Math.min(255, Math.max(0, color[i]))).toString(16);
	    }
	    color = '#' + c.join('');
	    
	    $(document.body).css('background', color);
	}, 50);*/
	$(document.body).css('background', 'url(http://static.hamsterpaj.net/images/packages/base/layouts/amanda/idx2.gif)');
    }
});

hp.packages.eggs.init();