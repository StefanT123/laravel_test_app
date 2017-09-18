class Lesson {

	static all(then) {
		return axios.get('/vue/lessons').then(({data}) => then(data));
	}

}

export default Lesson;