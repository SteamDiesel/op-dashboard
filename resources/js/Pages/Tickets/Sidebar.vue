<template>
	<div
		class="
			hidden
			sm:block
			min-w-xl
			w-64
			max-w-3xl
			min-h-screen
			pr-4
			border-r-2
		"
	>
		<!-- Linked Ticket -->
		<div class="mb-4">
			<div class="flex justify-between">
				<label
					for="linked_ticket"
					class="block text-sm font-medium text-gray-700"
				>
					Linked Ticket
				</label>
				<div>
					<a
						v-if="ticket.linked_ticket_id"
						:href="
							'https://ourpropertyhelp.zendesk.com/agent/tickets/' +
							ticket.linked_ticket_id
						"
						target="_blank"
					>
						<ExternalLinkIcon
							class="h-5 text-gray-700"
						></ExternalLinkIcon>
					</a>
				</div>
			</div>

			<div class="mt-1 flex">
				<input
					type="text"
					name="linked_ticket"
					id="linked_ticket"
					v-model="ticket.linked_ticket_id"
					@change="saveTicket(ticket)"
					class="
						shadow-sm
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
					"
				/>
			</div>
		</div>

		<!-- title -->
		<div class="mb-4">
			<label for="title" class="block text-sm font-medium text-gray-700"
				>Title</label
			>
			<div class="mt-1 flex">
				<input
					type="text"
					name="title"
					id="title"
					v-model="ticket.title"
					@change="saveTicket(ticket)"
					class="
						shadow-sm
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
					"
				/>
			</div>
		</div>

		<!-- Description -->
		<div class="mb-4">
			<label
				for="description"
				class="block text-sm font-medium text-gray-700"
				>Description</label
			>
			<div class="mt-1 flex">
				<input
					type="text"
					name="description"
					id="description"
					v-model="ticket.description"
					@change="saveTicket(ticket)"
					class="
						shadow-sm
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
					"
				/>
			</div>
		</div>

		<!-- tasks -->
		<div class="mb-4">
			<fieldset>
				<div class="flex justify-between">
					<label
						for="description"
						class="block text-sm font-medium text-gray-700"
						>Tasks</label
					>
					<button @click.prevent="addTask">
						<PlusIcon class="h-5 text-gray-700" />
					</button>
				</div>

				<div
					v-for="(task, index) in ticket.tasks"
					:key="index"
					class="relative flex items-start py-1"
				>
					<div class="min-w-0 flex-1 text-sm">
						<input
							:for="`task-${index}`"
							v-model="task.title"
							@change="emptyDrop(task, index)"
							class="font-medium text-gray-700 select-none"
						/>
					</div>
					<div class="ml-3 flex items-center h-5">
						<input
							:id="`task-${index}`"
							:name="`task-${index}`"
							type="checkbox"
							v-model="task.is_complete"
							@change="saveTicket(ticket)"
							class="
								focus:ring-indigo-500
								h-4
								w-4
								text-indigo-600
								border-gray-300
								rounded
							"
						/>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
</template>

<script>
import { ExternalLinkIcon, PlusIcon } from "@heroicons/vue/outline";
import axios from "axios";

export default {
	props: {
		ticket: Object,
	},
	components: {
		ExternalLinkIcon,
		PlusIcon,
	},
	methods: {
		addTask() {
			let $task = {
				title: "",
				is_complete: false,
			};
			if (this.$props.ticket.tasks !== null) {
				this.$props.ticket.tasks.push($task);
			} else {
				this.$props.ticket.tasks = [];
				this.$props.ticket.tasks.push($task);
			}

			console.log(this.$props.ticket.tasks);
		},
		emptyDrop(task, index) {
			// console.log("drop" + task.index);
			if (task.title == "") {
				console.log("dropping " + index);
				this.$props.ticket.tasks.splice(index, 1);
			}
			this.saveTicket(this.$props.ticket);
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

<style>
</style>
