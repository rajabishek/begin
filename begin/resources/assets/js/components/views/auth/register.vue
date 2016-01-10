<template>
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Register</h3>
            </div>
            <div class="panel-body">
                <form method="POST" @submit.prevent="registerUser">
                <alert-messages :messages="messages"></alert-messages>
                <fieldset>
                    <div class="form-group ">
                        <label for="name">Name</label>
                         <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control input-sm" v-model="user.name" name="name" type="text" id="name">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="email">Email</label>
                         <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input class="form-control input-sm" v-model="user.email" name="email" type="text" id="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control input-sm" v-model="user.password" name="password" type="password" value="" id="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control input-sm" v-model="user.password_confirmation" name="password_confirmation" type="password" value="" id="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <loading-button type="success" size="sm" :loading="loading">Sign Up</loading-button>
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

module.exports = {

    data: function() {
        return {
            user: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            loading: false,
            messages: []
        }
    },

    methods: {
        registerUser: function(e) {
            this.loading = true;
            var that = this;
            this.$http.post('/api/v1/register', this.user).then(function(response) {
                that.getUserData();
            }, function(response) {
                that.loading = false;
                this.displayErrorMessagesFromResponse(response);
            });
        },

        getUserData: function() {
            var that = this;
            this.$http.get('/api/v1/user').then(function(response) {
                that.$dispatch('saveUserDetails', response.data.data);
                that.loading = false;
                that.$route.router.go('/profile');
            }, function(response) {
                that.loading = false;
                this.displayErrorMessagesFromResponse(response);
            });
        },

        displayErrorMessagesFromResponse: function(response) {
            var that = this;
            if (response.data.success === false && response.status) {
                status = response.status;
                if (status == 400 || status == 422) {
                    that.messages = [];
                    var errors = response.data.errors;
                    for (var i = 0; i < errors.length; i++) {
                        that.messages.push({
                            type: 'danger',
                            message: errors[i]
                        });
                    }
                }
            }
        }
    }
}
</script>

