<template>
	<nav-component></nav-component>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
			  	<div class="jumbotron">
			    	<h1>One workplace</h1>
			    	<h5 class="lead">Be as simple as you can be. You'll know how uncomplicated your life can be.</h5>
			    	<h4>A simple task manager build with ♥ for 2016.</h4>
			     	 <a class="btn btn-sm btn-info" v-link="{ path: '/home'}" role="button">Learn more »</a>
			    	<p></p>
			  	</div>
			</div>
			<div class="col-md-4">
				<router-view></router-view>
			</div>
		</div>
	</div>
	<footer-component></footer-component>
</template>

