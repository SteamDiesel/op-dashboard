<template>
	<TicketLayout :ticket="$attrs.ticket" :team="$attrs.team">
		<div class="w-full h-full grid grid-cols-1 gap-4 divide-y">
			<div>
				<h2 class="font-semibold">Dive</h2>
				<p class="text-sm">
					Use this page to retrieve and explore related objects.
				</p>
			</div>
			<ObjectCard v-if="$attrs.ticket.users" name="Users">
				<DiveUser
					v-for="(u, index) in $attrs.ticket.users"
					:key="index"
					:user="u"
				></DiveUser>
			</ObjectCard>
			<ObjectCard v-if="$attrs.ticket.properties" name="Properties">
				Properties
			</ObjectCard>
		</div>
	</TicketLayout>
</template>

<script>
import TicketLayout from "../../../Layouts/TicketLayout.vue";
import ObjectCard from "../Dive/Object.vue";
import DiveUser from "../Dive/User.vue";
export default {
	components: {
		TicketLayout,
		ObjectCard,
		DiveUser,
	},
};
</script>

<style>
</style>
