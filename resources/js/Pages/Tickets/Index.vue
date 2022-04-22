
<script>
// import { Inertia } from "@inertiajs/inertia";
import MainLayout from "@/Layouts/Main.vue";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import { Link } from "@inertiajs/inertia-vue3";
import TicketsTable from "./Table.vue";
import NavTabs from "../Components/NavTabs.vue";
export default {
	components: {
		ButtonPrimary,
		Link,
		TicketsTable,
		MainLayout,
		NavTabs,
	},
	data() {
		return {
			property_id: "",
			job_id: "",
			agency_id: "",
			user_type: "PM",
			tabs: [
				{ name: "Mine", href: "/tickets" },
				{ name: "Closed", href: "/tickets/closed" },
				{ name: "Team", href: "/tickets/team" },
				{ name: "Team Closed", href: "/tickets/team/closed" },
			],
		};
	},

	methods: {},
};
</script>

<template>
	<MainLayout title="Tickets">
		<template v-slot:header>
			<Link href="/tickets/new">
				<ButtonPrimary>New Ticket</ButtonPrimary>
			</Link>
		</template>
		<NavTabs :tabs="tabs"></NavTabs>
		<div>
			<TicketsTable :tickets="$attrs.tickets"></TicketsTable>
		</div>
	</MainLayout>
</template>
