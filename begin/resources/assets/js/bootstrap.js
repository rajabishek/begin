//Import the dependencies
var Vue = require('vue');
var VueRouter = require('vue-router')

var filters = require('./filters/register');
filters.registerAllGlobally();

Vue.use(VueRouter);
Vue.use(require('vue-resource'));

//Register the routes with the route
var configureRoutes = require('./routes');

//Create a router instance
var router = new VueRouter();

//Set the routes on the router instance
configureRoutes(router);

// Configure the application
//var config = require('./config');
Vue.config.debug = true;

//Register the routes with the route
var configureInterceptors = require('./interceptors');
configureInterceptors(Vue);

//Register the global components
var components = require('./components/register');
components.registerAllGlobalComponents();

//Create the main root component constructor
var App = require('./app.vue');

//Create an instance of root component and mount to the given selector
router.start(App, '#container');
