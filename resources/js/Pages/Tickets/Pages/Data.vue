<template>
	<TicketLayout :ticket="$attrs.ticket" :team="$attrs.team">
		<h2>Ticket Data</h2>
		<div class="w-full pl-4">
			<ObjectNest :val="$attrs.ticket"></ObjectNest>
		</div>
	</TicketLayout>
</template>

<script>
import TicketLayout from "../../../Layouts/TicketLayout.vue";

import ObjectNest from "../../Components/ObjectNest.vue";

export default {
	components: {
		TicketLayout,
		ObjectNest,
	},

	data() {
		return {};
	},
	methods: {},
};
</script>
