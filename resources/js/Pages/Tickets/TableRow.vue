<!-- This example requires Tailwind CSS v2.0+ -->
<template>
	<tr>
		<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
			<div class="flex items-center max-w-xs">
				<div class="max-w-xs text-ellipsis overflow-hidden">
					<div
						class="
							max-w-xs
							text-ellipsis
							overflow-hidden
							font-semibold
							text-gray-900
						"
					>
						{{ ticket.title }}
					</div>
					<div
						class="
							max-w-xs
							text-ellipsis
							overflow-hidden
							text-gray-500
						"
						:title="ticket.description"
					>
						{{ ticket.description }}
					</div>

					<div class="text-gray-500">
						Created at {{ timeStamp(ticket.created_at) }}
					</div>
				</div>
			</div>
		</td>

		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<div class="max-w-xs text-ellipsis overflow-hidden text-gray-500">
				<img
					class="h-10 w-10 rounded-full"
					:src="ticket.user.profile_photo_url"
					:title="ticket.user.name"
				/>
			</div>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ timeStamp(ticket.created_at) }}
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ timeStamp(ticket.updated_at) }}
		</td>

		<td
			class="
				whitespace-nowrap
				flex flex-col
				items-center
				justify-center
				h-24
				text-right text-sm
				font-medium
			"
		>
			<Link
				:href="'/ticket/' + ticket.id"
				class="
					text-gray-700
					hover:text-indigo-700
					w-full
					flex-col
					px-4
					py-4
					justify-center
				"
				><LoginIcon class="h-10 rotate-180" /><span class="sr-only">
					ticket with ticket ID {{ ticket.id }}</span
				></Link
			>
		</td>
	</tr>
</template>

<script>
import { timeStamp } from "../Helpers";
import { LoginIcon } from "@heroicons/vue/outline";
export default {
	setup() {
		return {};
	},
	components: {
		LoginIcon,
	},
	props: {
		ticket: Object,
	},
	computed: {},
	methods: {
		timeStamp,
	},
};
</script>
