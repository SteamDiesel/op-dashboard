<template>
	<button class="border rounded-sm px-2 text-sm" @click="fetchProperty">
		Properties +
	</button>
</template>

<script>
import { fetchProperty, saveTicket } from "@/Pages/Tickets/ticketApi.js";

export default {
	props: {
		user: Object,
	},
	methods: {
		fetchProperty,
		saveTicket,
	},
};
</script>

<style>
</style>
