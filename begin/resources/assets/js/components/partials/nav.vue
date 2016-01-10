<template>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" v-link="{ path: '/' }">Begin</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a v-link="{ path: '/home' }">Home</a></li>
                    <li><a href="http://github.com/rajabishek/begin" target="_blank">Source</a></li>
                    <li v-if="$root.authenticated"><a v-link="{ path: '/tasks' }">Tasks</a></li>
                    <li v-if="$root.authenticated"><a v-link="{ path: '/tasks/create' }">Create Task</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li v-if="!$root.authenticated"><a v-link="{ path: '/auth/register' }">Register</a></li>
                    <li v-if="!$root.authenticated"><a v-link="{ path: '/auth/login' }">Login</a></li>
                    <li class="dropdown" v-if="$root.authenticated">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span>{{ $root.user.name }}</span>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <span class="glyphicon glyphicon-user icon-size"></span>
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="text-left"><strong>{{ $root.user.name }}</strong></p>
                                            <p class="text-left small">{{ $root.user.email }}</p>
                                            <p class="text-left">
                                                <a v-link="{ path: '/profile' }" class="btn btn-primary btn-block btn-sm">Profile</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider navbar-login-session-bg"></li>
                            <li><a v-link="{ path: '/profile'}">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                            <li><a v-link="{ path: '/auth/logout' }">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
var gravatar = require('../../services/gravatar');

module.exports = {
    data: function () {
        return {
            navTitle: 'Begin'
        }
    },
    methods: {
        getGravatarImageLink: function(email) {
            return gravatar.getImageLink(email);
        }
    }
}
</script>

<style type="text/css">
.navbar-login
{
    width: 305px;
    padding: 10px;
    padding-bottom: 0px;
}

.navbar-login-session
{
    padding: 10px;
    padding-bottom: 0px;
    padding-top: 0px;
}

.icon-size
{
    font-size: 87px;
}
</style>