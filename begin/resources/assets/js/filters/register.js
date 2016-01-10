var Vue = require('vue');
var stringLimiter = require('./stringLimiter');

module.exports = {
	
	registerAllGlobally: function() {
		// register filters globally
		Vue.filter('strlimit', stringLimiter);
	}
};