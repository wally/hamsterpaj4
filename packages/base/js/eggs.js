hp.set('packages.eggs', {    
    init: function() {
	$(document).ready(function() {
	    var position = $('#hp #head h2 a').offset();
	    hp.packages.eggs.supercoloractivatorposition.x += position.left;
	    hp.packages.eggs.supercoloractivatorposition.y += position.top;
	    
	    $('#hp #head h2 a').click(hp.packages.eggs.supercolors);
	    
	    hp.packages.eggs.steve($('#steve'));
	});
    },
    
    /*
	Hamsterguard
    */
    
    supercoloractivatorposition: {x: 330, y: 17},
    supercurrentcolor: [0, 255, 0],
    supercurrentdirections: ['+', '-', '+'],
    
    supercolors: function(e) {
	var pos = {x: e.clientX, y: e.clientY};
	
	if (
	    pos.x > hp.packages.eggs.supercoloractivatorposition.x
	    && pos.x < hp.packages.eggs.supercoloractivatorposition.x + 10
	    && pos.y > hp.packages.eggs.supercoloractivatorposition.y
	    && pos.y < hp.packages.eggs.supercoloractivatorposition.y + 15
	) {
	    alert('sluta peta på mig!');
	    hp.packages.eggs.go_crazy();
	    return false;
	}
    },
    
    go_crazy: function() {
	$(document.body).css('background', 'url(http://static.hamsterpaj.net/images/packages/base/layouts/amanda/idx2.gif)');
    },
    
    /*
	Steve gun
    */
    
    steve: function(steve) {
	//this.steve_dbl();
	//this.steve_facts();
	//this.steve_gun();
    }
});

hp.packages.eggs.init();