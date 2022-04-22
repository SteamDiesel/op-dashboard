
<script>
import { Inertia } from "@inertiajs/inertia";
import MainLayout from "@/Layouts/Main.vue";
import Sidebar from "./Sidebar.vue";
import ObjectNest from "../Components/ObjectNest.vue";
export default {
	components: {
		MainLayout,
		Sidebar,
		ObjectNest,
	},
};
</script>

<template>
	<MainLayout :title="'Ticket: ' + $attrs.ticket.title">
		<div v-if="!$attrs.ticket" class="flex w-full justify-between">
			<div>
				No results retrieved for the ticket number {{ $attrs.query }}
			</div>
		</div>
		<div v-if="$attrs.ticket" class="flex w-full h-full justify-between">
			<Sidebar :ticket="$attrs.ticket"></Sidebar>
			<div class="w-full pl-4">
				<ObjectNest :val="$attrs.ticket"></ObjectNest>
			</div>
		</div>
	</MainLayout>
</template>
