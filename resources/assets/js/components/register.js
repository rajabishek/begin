var Vue = require('vue');

var modalComponent = require('./general/modal.vue');
var alertComponent = require('vue-strap/src/Alert.vue');
var alertMessagesComponent = require('./general/alertMessages.vue');
var spinnerComponent = require('./general/spinner.vue');
var loadingButtonComponent = require('./general/loadingButton.vue');
var navComponent = require('./partials/nav.vue');
var footerComponent = require('./partials/footer.vue');


module.exports = {
	
	registerAllGlobalComponents: function() {
		
		Vue.component('modal', modalComponent);
		Vue.component('alert', alertComponent);
		Vue.component('alert-messages', alertMessagesComponent);
		Vue.component('spinner', spinnerComponent);
		Vue.component('loading-button', loadingButtonComponent);
		Vue.component('nav-component', navComponent);
		Vue.component('footer-component', footerComponent);
	}
};