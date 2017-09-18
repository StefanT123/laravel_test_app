class Session {

	static all(then) {
		return axios.get('/api/asd').then(({data}) => then(data));
	}

}

export default Session;