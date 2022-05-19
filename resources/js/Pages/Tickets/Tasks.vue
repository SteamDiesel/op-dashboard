<template>
	<div class="sm:p-2">
		<fieldset>
			<div class="flex mb-2 gap-4">
				<label
					for="description"
					class="block font-semibold text-gray-700"
					>Tasks</label
				>
				<button class="h-5" @click.prevent="addTask">
					<PlusIcon class="h-5 text-gray-700" />
				</button>
			</div>

			<div
				v-for="(task, index) in tasks"
				:key="index"
				class="relative flex items-start py-1"
			>
				<div class="min-w-0 flex-1 text-sm">
					<input
						:for="`task-${index}`"
						v-model="task.title"
						@change="saveTask(task, index)"
						class="
							pl-2
							py-1
							w-full
							font-medium
							text-gray-700
							select-none
						"
					/>
				</div>
				<div class="ml-3 mt-1 flex items-center h-5">
					<input
						:id="`task-${index}`"
						:name="`task-${index}`"
						type="checkbox"
						v-model="task.is_complete"
						@change="toggleComplete(task, index)"
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
</template>

<script>
import { saveTicket, addTask, ticketActivity } from "./ticketApi.js";
import { PlusIcon } from "@heroicons/vue/outline";
export default {
	components: {
		PlusIcon,
	},
	props: {
		tasks: Object,
	},
	methods: {
		saveTicket,
		ticketActivity,
		addTask,
		toggleComplete(task) {
			var activity = {
				ticket_id: this.$page.props.ticket.id,
				type: "task",
				endpoint: "NA",
				parameters: "NA",
				result: "Success",
			};
			if (task.is_complete === true) {
				activity.details =
					"marked task '" + task.title + "' as complete.";
			} else {
				activity.details = "marked task '" + task.title + "' as to do.";
			}
			ticketActivity(activity);
			this.saveTicket(this.$page.props.ticket);
			// this.saveTask(task, index);
		},
		saveTask(task, index) {
			var activity = {
				ticket_id: this.$page.props.ticket.id,
				type: "task",
				endpoint: "NA",
				parameters: "NA",
				result: "Success",
				details: "saved task as '" + task.title + "'",
			};
			if (task.title == "") {
				activity.details = "deleted a task.";
				console.log("Dropping empty task " + index);
				this.$page.props.ticket.tasks.splice(index, 1);
			}
			ticketActivity(activity);
			this.saveTicket(this.$page.props.ticket);
		},
	},
};
</script>

<style>
</style>
