
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from 'vue-router';

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);

import router from './routes';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));

new Vue({
    el: '#app',

    router: router
});

$(document).ready(function() {

    $('#completed').on('change', function(){
		this.value = this.checked ? 1 : 0;
		var value = this.value;
		var id = $(this).attr('data-id');
		var user_id = $(this).attr('data-user');
		var lesson_id = $(this).attr('data-lesson');

		$.ajax({
			type: "POST",
			url: "/session/completed",
			data: {
				'value': value,
				'id': id,
				'user_id': user_id
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(resp) {

				if ( $('#next_session').length ) {

					window.location.replace("http://localhost:8000/session/" + resp.slug);

				} else {
					next_lesson = Number.isInteger(resp.id) ? "<a href=/lesson/" + resp.slug + ">Go to the next lesson</a>" : 'Please proceed to the next module';
					$('.navigation').append('<h2>You have completed this module.' + next_lesson + '</h2>');

				}

				$('#completed').remove();

			}
		})

	});

});
