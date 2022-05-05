<template>
	<button
		class="border rounded-sm px-2 text-sm"
		@click="fetchPropertyTenancies"
	>
		Tenants +
	</button>
</template>

<script>
import {
	fetchPropertyTenancies,
	saveTicket,
} from "@/Pages/Tickets/ticketApi.js";

export default {
	props: {
		property: Object,
	},
	methods: {
		fetchPropertyTenancies,
		saveTicket,
	},
};
</script>

<style>
</style>
