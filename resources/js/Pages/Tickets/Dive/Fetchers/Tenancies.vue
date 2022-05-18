<template>
	<div class="w-full">
		<button
			class="border rounded-sm px-2 text-sm"
			@click="fetchPropertyTenancies"
		>
			Tenancies +
		</button>
		<div class="p-4" v-if="loading">
			<img class="h-5" src="/images/spinner.gif" alt="" />
		</div>
		<div v-if="!loading" class="w-full">
			<Tenancy
				v-if="parent.tenancies"
				v-for="(t, index) in parent.tenancies"
				:key="index"
				:tenancy="t"
			></Tenancy>
		</div>
	</div>
</template>

<script>
import {
	fetchPropertyTenancies,
	saveTicket,
} from "@/Pages/Tickets/ticketApi.js";
import Tenancy from "../Tenancy.vue";
export default {
	components: { Tenancy },
	props: {
		parent: Object,
	},
	data() {
		return {
			loading: false,
		};
	},
	methods: {
		saveTicket,
		fetchPropertyTenancies() {
			this.loading = true;
			let ids = this.parent.TenantIDs.split(",");
			console.log(ids);
			this.parent.tenancies = [];
			ids.forEach((e) => {
				console.log("getting tenancy for " + e);
				axios
					.post("/ticket/api/getUserTenancies", {
						id: e,
					})
					.then((response) => {
						let tar = response.data.tcy[0];
						console.log();
						if (tar !== 0) {
							this.parent.tenancies.push(response.data.tcy[0]);
						} else {
							console.log("tenancy not retrieved");
						}
						this.loading = false;
						this.saveTicket();
					})
					.catch((error) => {
						console.log(error);
						this.loading = false;
						// $emit("failed", error);
					});
			});
		},
	},
};
</script>

<style>
</style>
