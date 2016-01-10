module.exports = {
	handleFailedResponse: function(response, component) {
        if (response.data.success === false && response.status) {
            status = response.status;
            if(status == 422 || status == 404){
                this.displayErrorMessagesFromResponse(response, component);
            }
            else if(status == 400 || status == 401 || status == 403)
                component.$dispatch('clearUserDetails');
            else if(status == 500)
                component.messages = [{ type: 'danger', message: 'An unknown error occured, try sometime later.' }];
        }
    },

    displayErrorMessagesFromResponse: function(response, component) {
        component.messages = [];
        var errors = response.data.errors;
        for (var i = 0; i < errors.length; i++) {
            component.messages.push({ type: 'danger', message: errors[i] });
        }
    }
};