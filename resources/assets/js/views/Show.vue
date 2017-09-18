<template>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div v-for="session in sessions">
				<h2>
					<a v-bind:href="'session/' + session.slug">{{ session.title }}</a>
				</h2>
				<p>{{ session.content }}</p>
				<embed v-bind:src="session.video" width="300" height="300">
			</div>
		</div>
	</div>
</template>

<script>

	import Session from '../models/Session';

	export default {

		data() {
			return {
				sessions: []
			}
		},

		mounted() {
			Session.all(sessions => this.sessions = sessions);
		}

	}

</script>