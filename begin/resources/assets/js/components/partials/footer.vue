<template>
    <footer class="footer">
        <div class="container">
            <div class="pull-left" style="padding-top: 20px;">
                Copyright © Eckspan - <a v-link="{ path: '/terms' }">Terms Of Service</a>
            </div>
            <div class="pull-right footer-social-icons">
                <a href="https://twitter.com/therajabishek" target="_blank">
                    <i class="fa fa-btn fa-twitter-square"></i>
                </a>
                <a href="http://github.com/rajabishek" target="_blank">
                    <i class="fa fa-github-square"></i>
                </a>
                <a href="http://in.linkedin.com/in/rajabishek" target="_blank">
                    <i class="fa fa-btn fa-linkedin-square"></i>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>
</template>

<style type="text/css">
/* Sticky footer styles
-------------------------------------------------- */
.footer {
    background-color: #f5f5f5;
    bottom: 0;
    min-height: 60px;
    position: absolute;
    width: 100%;
}

.footer .footer-social-icons {
    font-size: 27px;
    padding-top: 10px;
}

.footer .footer-social-icons a {
    color: #777;
}
</style>