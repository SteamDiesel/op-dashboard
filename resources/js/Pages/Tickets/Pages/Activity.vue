<template>
	<TicketLayout :ticket="$attrs.ticket" :team="$attrs.team">
		<h2 class="mb-4">Ticket Activity</h2>
		<div>
			<Feed :activity="$attrs.activity"></Feed>
		</div>
		<!-- <div class="w-full pl-4">
			<ObjectNest :val="$attrs.activity"></ObjectNest>
		</div> -->
	</TicketLayout>
</template>

<script>
import TicketLayout from "../../../Layouts/TicketLayout.vue";
import Feed from "../Activity/Feed.vue";
import ObjectNest from "../../Components/ObjectNest.vue";

export default {
	components: {
		TicketLayout,
		ObjectNest,
		Feed,
	},

	data() {
		return {};
	},
	methods: {},
};
</script>
