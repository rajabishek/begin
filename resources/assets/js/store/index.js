var Vue = require('vue');
var Vuex = require('vuex');

var actions = require('./actions');
var mutations = require('./mutations');

Vue.use(Vuex);

const state = {
	tasks: []
};

module.exports = new Vuex.Store({
	state,
	actions,
	mutations
});