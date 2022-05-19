<template>
	<div class="hidden sm:block sm:p-2">
		<!-- open/closed -->
		<div class="mb-4">
			<div class="flex justify-end gap-2">
				<div class="relative">
					<button @click="showUsers = !showUsers">
						<img
							class="rounded-full h-7"
							:src="ticket.user.profile_photo_url"
							:alt="ticket.user.name"
							:title="ticket.user.name"
						/>
					</button>
					<div
						class="flex gap-1 fixed bg-gray-100 rounded-full p-1"
						v-if="showUsers"
					>
						<button
							v-for="(u, index) in team.users"
							:key="index"
							:id="'usr' + index"
							@click="changeUser(u)"
						>
							<img
								class="
									rounded-full
									h-7
									border border-gray-400
									hover:border-indigo-700
								"
								:src="u.profile_photo_url"
								:alt="u.name"
								:title="u.name"
							/>
						</button>
					</div>
				</div>
				<div>
					<button
						title="Close the ticket"
						class="border rounded-md hover:border-indigo-700"
						v-if="ticket.is_open"
						@click="toggleClosed()"
					>
						<CheckIcon
							class="h-7 hover:text-indigo-700 text-gray-400"
						/>
					</button>
					<button
						class="border rounded-md hover:border-indigo-700"
						title="Re-open the ticket"
						v-if="!ticket.is_open"
						@click="toggleOpen()"
					>
						<InboxInIcon
							class="h-7 hover:text-indigo-700 text-gray-400"
						/>
					</button>
				</div>
			</div>
		</div>
		<!-- Linked Ticket -->
		<!-- <div class="mb-4">
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
                    placeholder="Zendesk Ticket"
				/>
			</div>
		</div> -->

		<!-- title -->
		<div class="mb-4">
			<label
				for="title"
				class="hidden sr-only text-sm font-medium text-gray-700"
				sr-only
				>Title</label
			>
			<div class="mt-1 flex">
				<input
					type="text"
					name="title"
					id="title"
					v-model="ticket.title"
					@change="saveTicket"
					class="
						shadow-sm
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
					"
					placeholder="title"
				/>
			</div>
		</div>

		<!-- Description -->
		<div class="mb-4">
			<label
				for="description"
				class="hidden sr-only text-sm font-medium text-gray-700"
				sr-only
				>Description</label
			>
			<div class="mt-1 flex">
				<textarea
					class="
						shadow-sm
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
						align-top
					"
					name="description"
					id="description"
					v-model="ticket.description"
					@change="saveTicket"
					placeholder="description"
					rows="2"
				></textarea>
			</div>
		</div>
	</div>
</template>

<script>
import {
	ExternalLinkIcon,
	InboxInIcon,
	CheckIcon,
} from "@heroicons/vue/outline";
import {
	saveTicket,
	reassignTicket,
	closeTicket,
	openTicket,
} from "./ticketApi.js";

export default {
	props: {
		ticket: Object,
		team: Object,
	},
	data() {
		return {
			showUsers: false,
			toggle_loading: false,
		};
	},
	components: {
		ExternalLinkIcon,
		InboxInIcon,
		CheckIcon,
	},
	methods: {
		saveTicket,
		reassignTicket,
		closeTicket,
		openTicket,

		toggleClosed() {
			this.ticket.is_open = false;
			this.closeTicket(this.ticket.id);
		},
		toggleOpen() {
			this.ticket.is_open = true;
			this.openTicket(this.ticket.id);
		},
		changeUser(u) {
			this.ticket.user = u;
			this.ticket.user_id = u.id;
			this.showUsers = false;
			this.reassignTicket(u.id);
		},
	},
};
</script>

<style>
</style>
