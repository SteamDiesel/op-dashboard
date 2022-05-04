<script setup>
</script>

<script>
import { Inertia } from "@inertiajs/inertia";
import TicketLayout from "@/Layouts/TicketLayout.vue";
import Sidebar from "./Sidebar.vue";
import ObjectNest from "../Components/ObjectNest.vue";
import Tasks from "./Tasks.vue";
import axios from "axios";
import { FolderIcon, UsersIcon } from "@heroicons/vue/outline";

export default {
	components: {
		TicketLayout,
		Sidebar,
		ObjectNest,
		Tasks,
		FolderIcon,
		UsersIcon,
	},
	data() {
		return {
			navigation: [
				{
					name: "Users",
					href: "ticket/" + this.$page.props.ticket.id + "/users",
					prefix: "ticket/" + this.$page.props.ticket.id + "/user",
					icon: UsersIcon,
				},
				{
					name: "Jobs",
					href: "ticket/" + this.$page.props.ticket.id + "/jobs",
					prefix: "ticket/" + this.$page.props.ticket.id + "/job",
					icon: FolderIcon,
				},
			],
		};
	},
	methods: {
		addTask() {
			console.log("adding task");
			console.log(this.$page.props.ticket);
			let $task = {
				title: "",
				is_complete: false,
			};
			if (this.$page.props.ticket.tasks !== null) {
				this.$page.props.ticket.tasks.push($task);
			} else {
				this.$page.props.ticket.tasks = [];
				this.$page.props.ticket.tasks.push($task);
			}

			console.log(this.$page.props.ticket.tasks);
		},
		saveTask(task, index) {
			console.log("drop" + task.index);
			if (task.title == "") {
				console.log("dropping " + index);
				this.$page.props.ticket.tasks.splice(index, 1);
			}
			this.saveTicket(this.$page.props.ticket);
		},
		saveTicket(ticket) {
			axios
				.post("/ticket/update/" + ticket.id, {
					ticket: ticket,
				})
				.then((response) => {
					console.log(response.data.message);
				})
				.catch((error) => {
					console.log(error);
				});
		},
	},
};
</script>

<template>
	<TicketLayout
		:ticket="$attrs.ticket"
		:title="'Ticket: ' + $attrs.ticket.title"
		:navigation="navigation"
	>
		<template v-slot:sidebar>
			<Sidebar
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
		<div v-if="!$attrs.ticket" class="flex w-full justify-between">
			<div>
				No results retrieved for the ticket number {{ $attrs.query }}
			</div>
		</div>
		<div v-if="$attrs.ticket" class="flex w-full h-full justify-between">
			<div class="w-full pl-4">
				<ObjectNest :val="$attrs.ticket"></ObjectNest>
			</div>
		</div>
	</TicketLayout>
</template>
