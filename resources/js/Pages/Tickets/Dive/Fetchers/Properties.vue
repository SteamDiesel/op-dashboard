<template>
	<div>
		<button class="border rounded-sm px-2 text-sm" @click="fetchProperty">
			Properties +
		</button>
		<div class="p-4" v-if="loading">
			<img class="h-5" src="/images/spinner.gif" alt="" />
		</div>
		<div v-if="!loading">
			<Property
				v-for="(p, index) in parent.properties"
				:key="index"
				:property="p"
			/>
		</div>
	</div>
</template>

<script>
import { saveTicket } from "@/Pages/Tickets/ticketApi.js";

import Property from "../Property.vue";
export default {
	components: {
		Property,
	},
	props: {
		parent: Object,
		user_id: String,
	},
	data() {
		return {
			loading: false,
		};
	},
	methods: {
		saveTicket,
		fetchProperty() {
			this.loading = true;
			axios
				.post("/ticket/api/getProperties", {
					user_id: this.user_id,
				})
				.then((response) => {
					console.log(response.data.data);
					this.parent.properties = response.data.pty;
					this.saveTicket();
					this.loading = false;
				})
				.catch((error) => {
					console.log(error);
					this.loading = false;
				});
		},
	},
};
</script>

<style>
</style>
