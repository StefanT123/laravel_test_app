class Module {

	static all(then) {
		return axios.get('/vue/modules').then(({data}) => then(data));
	}

}

export default Module;