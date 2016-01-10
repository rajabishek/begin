module.exports = function(Vue) {

    Vue.http.interceptors.push({

        request: function (request) {
            var token = localStorage.getItem('jwt-token')
            if(token !== null && token !== 'undefined') {
                request.headers.Authorization = token
            }
            return request;
        },

        response: function (response) {
            //console.log(response);
            if(response.status === 401) {
                localStorage.removeItem('jwt-token');
            }
            if(response.headers('Authorization')) {
                localStorage.setItem('jwt-token', response.headers('Authorization'));
            }
            
            if(response.data.data && response.data.data.token && response.data.data.token.length > 10) {
                localStorage.setItem('jwt-token', 'Bearer ' + response.data.data.token);
            }
            return response;
        }
        
    });
}
