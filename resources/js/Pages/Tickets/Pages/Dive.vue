<template>
	<div>
		<TicketLayout
			:ticket="$attrs.ticket"
			:title="'Ticket: ' + $attrs.ticket.title"
			:navigation="navigation"
		>
			<!-- Named slots -->
			<template v-slot:sidebar>
				<Sidebar
					:team="$attrs.team"
					@save-ticket="saveTicket"
					:ticket="$attrs.ticket"
				></Sidebar>
				<Tasks
					@add-task="addTask"
					@save-task="saveTask"
					@save-ticket="saveTicket"
					:tasks="$attrs.ticket.tasks"
				></Tasks>
			</template>
			<template v-slot:header>
				<PageTabs
					:tabs="tabs"
					:active="active_tab"
					@change-tab="changeTab"
				></PageTabs>
			</template>
			This is the content
		</TicketLayout>
	</div>
</template>

<script>
import TicketLayout from "../../../Layouts/TicketLayout.vue";
import PageTabs from "../../Components/PageTabs.vue";
import Sidebar from "../Sidebar.vue";
export default {
	components: {
		TicketLayout,
		PageTabs,
		Sidebar,
	},
};
</script>

<style>
</style>
