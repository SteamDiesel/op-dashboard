<template>
	<div class="hidden sm:block sm:p-2">
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
					@change="$emit('saveTicket', ticket)"
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
				<input
					type="text"
					name="description"
					id="description"
					v-model="ticket.description"
					@change="$emit('saveTicket', ticket)"
					class="
						shadow-sm
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
					"
					placeholder="description"
				/>
			</div>
		</div>
	</div>
</template>

<script>
import { ExternalLinkIcon } from "@heroicons/vue/outline";

export default {
	props: {
		ticket: Object,
	},
	components: {
		ExternalLinkIcon,
	},
	methods: {},
};
</script>

<style>
</style>
