module.exports = function(router) {
    
    router.map({
        '/auth': {
            component: require('./components/views/auth.vue'),
            subRoutes: {
                '/login': {
                    component: require('./components/views/auth/login.vue'),
                    guest: true
                },
                '/register': {
                    component: require('./components/views/auth/register.vue'),
                    guest: true
                },
                '/logout': {
                    component: require('./components/views/auth/logout.vue'),
                    auth: true
                }
            }
        },
        '/profile': {
            component: require('./components/views/profile.vue'),
            auth: true
        },
        '/home': {
            component: require('./components/views/home.vue')
        },
        '/tasks': {
            component: require('./components/views/tasks.vue'),
            auth: true,
            subRoutes: {
                '/': {
                    component: require('./components/views/tasks/index.vue')
                },
                '/:id': {
                    component: require('./components/views/tasks/show.vue')
                },
                '/create': {
                    component: require('./components/views/tasks/create.vue')
                }
            }
        },
        '/terms': {
            component: require('./components/views/terms.vue')
        },
        '*': {
            component: require('./components/views/404.vue')
        }
    })

    .alias({
        '': '/home',
        '/auth': '/auth/login'
    })

    .beforeEach(function(transition) {

        var token = localStorage.getItem('jwt-token')
        if (transition.to.auth) {
            if (!token || token === null) {
                transition.redirect('/auth/login')
            }
        }
        if (transition.to.guest) {
            if (token) {
                transition.redirect('/')
            }
        }
        transition.next()
    });
}