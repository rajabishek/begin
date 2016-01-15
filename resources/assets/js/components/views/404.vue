<template>
    <center>
        <div class="jumbotron jumbotron-error-notfound">
            <div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
            <h4>We couldn't find the page..</h4>

            <h5 class="lead">
                Sorry, but the page you are looking for was either not found or does not exist. <br/>
                Try refreshing the page or click the button below to go back to the Homepage.
            </h5>
            <div>
                <a v-link="{ path: '/' }" class="btn btn-md btn-info">
                    <i class="fa fa-arrow-left"></i>
                    Go back to Homepage                        
                </a>
            </div>
        </div>
    </center>
    <footer-component></footer-component>
</template>

<style type="text/css">
.error {
  margin: 0 auto;
  text-align: center;
}

.error-code {
  bottom: 60%;
  color: #2d353c;
  font-size: 96px;
  line-height: 100px;
}

.m-b-10 {
  margin-bottom: 10px!important;
}

.m-b-20 {
  margin-bottom: 20px!important;
}

.m-t-20 {
  margin-top: 20px!important;
}

.jumbotron-error-notfound {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
</style>

