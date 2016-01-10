<template>
    <div class="wrapper">
        <router-view></router-view>
    </div>
</template>

<script type="text/javascript">

module.exports = {

    ready: function() {

        //The app has just been initialized, check if we can get the user data with an already existing token
        var token = localStorage.getItem('jwt-token')
        if (token !== null && token !== 'undefined') {
            var that = this
            this.$http.get('/api/v1/user').then(function(response) {
                that.saveUserDetails(response.data.data);
            }, function(response) {
                that.clearUserDetails();
            });
        }
    },

    components: {
        'modal': {
            template: '<h2>message</h2>'
        }
    },

    data: function() {
        return {
            user: null,
            token: null,
            authenticated: false
        }
    },

    events: {
        clearUserDetails: function() {
            this.clearUserDetails();
        },
        saveUserDetails: function(user) {
            this.saveUserDetails(user);
        }
    },

    methods: {

        saveUserDetails: function(user) {
            // Save login info in our data and set header in case it's not set already
            this.user = user;
            this.authenticated = true;
            this.token = localStorage.getItem('jwt-token');
        },

        clearUserDetails: function() {
            
            this.user = null;
            this.token = null;
            this.authenticated = false;
            localStorage.removeItem('jwt-token');
            
            if(this.$route.auth) 
                this.$route.router.go('/auth/login');
        }
    }

}
</script>
