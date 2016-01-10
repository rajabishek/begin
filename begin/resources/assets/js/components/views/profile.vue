<template>
	<nav-component></nav-component>
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	            <div class="panel panel-info" v-show="$root.user">
	                <div class="panel-heading">
	                    <h3 class="panel-title">{{ $root.user.name }}</h3>
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" :src="getGravatarImageLink($root.user.email)" class="img-circle img-responsive"> </div>
	                        
	                        <div class=" col-md-9 col-lg-9 ">
	                            <table class="table table-user-information">
	                                <tbody>
	                                    <tr>
	                                        <td>Name:</td>
	                                        <td>{{ $root.user.name }}</td>
	                                    </tr>
	                                    <tr>
	                                        <td>Email</td>
	                                        <td><a href="mailto:{{ $root.user.name }}">{{ $root.user.email }}</a></td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel-footer">
	                    <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<footer-component></footer-component>
</template>

<script type="text/javascript">
var gravatar = require('../../services/gravatar');

module.exports = {
	methods: {
		getGravatarImageLink: function(email) {
			return gravatar.getImageLink(email);
		}
	}
};
</script>



