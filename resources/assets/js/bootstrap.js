window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery')
require('bootstrap-sass/assets/javascripts/bootstrap')
require('bootbox')
require('bootstrap-notify')

window.jasny = require('jasny-bootstrap/dist/js/jasny-bootstrap.min.js')

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue')
require('vue-resource')

window.simplemarquee = require('./marquee')

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push(function (request, next)
{
  request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken

  next()
})

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.io = require('socket.io-client')

import Echo from "laravel-echo"

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host:        Laravel.host + ':' + Laravel.socketPort
})
