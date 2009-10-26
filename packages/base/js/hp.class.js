/*
    Function:
	hp.Class
    
    Creates a class from the passed object. The .init member is the constructor.
    
    Examples:
	(begin code)
	
	hp.set('classes.MyClass', hp.Class({
	    init: function(message, times) {
		this.message = message;
		this.times = times || 10;
	    },
	    
	    say: function() {
		for ( var i = 0; i < this.times; i++ )
		    alert(this.message);
	    }
	}));
	
	var myInstance = new hp.classes.MyClass("Hello world!", 1);
	myInstance.say(); // alerts "Hello world!" once
	
	var myInstance2 = new hp.classes.MyClass("Bye world!");
	myInstance2.say(); // alerts "Bye world!" ten times
	
	(end code)
*/

hp.Class = function(properties) {
    var klass = function() {
	this.init.apply(this, arguments);
    };
    
    for ( var key in properties ) if ( properties.hasOwnProperty(key) ) {
	klass.prototype[key] = properties[key];
    }
    
    klass.prototype.init = klass.prototype.init || function() {};
    
    return klass;
};