import VueRouter from 'vue-router';

let routes = [

	{
		path: '/',
		component: require('./views/Show')
	},
	{
		path: '/lessons',
		component: require('./views/Lesson')
	},
	{
		path: '/modules',
		component: require('./views/Module')
	}

];

export default new VueRouter({
	routes,
	linkActiveClass: 'active'
});