

<template>
	<div class="p-12">
		<div>
			<textarea
				type="email"
				v-model="blob_string"
				@change="makeObject"
				@keydown.enter="makeObject"
				class="
					shadow-sm
					focus:ring-indigo-500 focus:border-indigo-500
					block
					w-full
					sm:text-sm
					border-gray-300
					rounded-md
				"
			/>
		</div>
		<div>
			<table>
				<tr v-for="(i, index) in blob" :key="index">
					<td>
						{{ i.name }}
					</td>
				</tr>
			</table>
		</div>
	</div>
</template>
<script>
// import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
	props: {
		canLogin: Boolean,
		canRegister: Boolean,
		laravelVersion: String,
		phpVersion: String,
		param_code: String,
	},
	data() {
		return {
			blob: "",
			blob_string: "",
		};
	},
	computed: {},
	methods: {
		makeObject() {
			if (!(this.blob = JSON.parse(this.blob_string))) {
				console.log("that's not an object");
			}
		},
	},
	mounted() {
		console.log("param_code: " + this.param_code);
		this.loadCredentials();
		// console.log(window.location.href);
		// console.log(window.location.params);

		// console.log("The code is: " + this.code);
		// this.access_token = this.$route.query.code;
		if (this.param_code) {
			localStorage.code = this.param_code;
			this.code = this.param_code;
			console.log("Code updated in local storage.");
		}
	},
};
</script>

