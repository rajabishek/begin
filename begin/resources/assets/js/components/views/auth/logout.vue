<script>
module.exports = {

    route: {
        activate: function(transition) {
            this.$root.authenticated = false;
            this.$root.user = null;
            this.$root.token = null;
            localStorage.removeItem('jwt-token');
            transition.redirect('/');
        }
    }
}
</script>

