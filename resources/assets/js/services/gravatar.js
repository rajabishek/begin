var md5 = require('md5');

module.exports = {
    
    getHashForEmail: function(email) {
        return md5(email);
    },

    getImageLink: function(email, size = 150) {
        return 'http://www.gravatar.com/avatar/' + this.getHashForEmail(email) + '?s=' + size;
    }
}