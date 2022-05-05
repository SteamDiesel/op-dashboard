<template>
	<button class="border rounded-sm px-2 text-sm" @click="fetchUserTenancy">
		Tenancies +
	</button>
</template>

<script>
import { fetchUserTenancy, saveTicket } from "@/Pages/Tickets/ticketApi.js";

export default {
	props: {
		user: Object,
	},
	methods: {
		fetchUserTenancy,
		saveTicket,
	},
};
</script>

<style>
</style>
