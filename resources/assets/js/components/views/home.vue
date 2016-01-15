<template>
	<nav-component></nav-component>
	<div class="container">
		<div class="jumbotron">
		    <h1>Keep your life in sync</h1>
		    <h5 class="lead">Begin is the easiest way to get stuff done. Whether you’re planning a holiday, sharing a shopping list with a partner or managing multiple work projects, Begin is here to help you tick off all your personal and professional to-dos.</h5>
		    <p><a class="btn btn-success" v-link="{ path: '/auth/register' }" role="button">Create a free account</a></p>
		</div>
		<div class="row marketing">
		    <div class="col-lg-6">
		        <h4>PLAN FOR EVERYTHING</h4>
		        <p>Organize and share your to-do, work, grocery, movies and household lists. No matter what you’re planning, how big or small the task may be, Begin makes it super easy to get stuff done.</p>
		    </div>
		    <div class="col-lg-6">
		        <h4>CLOUD</h4>
		        <p>Access from anywhere. Since Begin is in the cloud you never have to worry about accessibility now.</p>
		    </div>
		</div>
	</div>
	<footer-component></footer-component>
</template>

