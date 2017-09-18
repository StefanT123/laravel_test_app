<template>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div v-for="module in modules">
				<h2>{{ module.title }}</h2>
				<p>{{ module.description }}</p>
			</div>
		</div>
	</div>
</template>

<script>

	import Module from '../models/Module';

	export default {

		data() {
			return {
				modules: []
			}
		},

		mounted() {
			Module.all(modules => this.modules = modules);
		}

	}

</script>