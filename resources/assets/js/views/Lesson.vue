<template>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div v-for="lesson in lessons">
				<h2>
					<a :href="'lesson/' + lesson.slug">{{ lesson.title }}</a>
				</h2>
				<p>{{ lesson.description }}</p>
			</div>
		</div>
	</div>
</template>

<script>

	import Lesson from '../models/Lesson';

	export default {

		data() {
			return {
				lessons: []
			}
		},

		mounted() {
			Lesson.all(lessons => this.lessons = lessons);
		}

	}

</script>