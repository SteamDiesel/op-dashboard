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
						Created at {{ timestamp(ticket.created_at) }}
					</div>
				</div>
			</div>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<div
				class="
					max-w-xs
					text-ellipsis
					overflow-hidden
					font-semibold
					text-gray-900
				"
				v-if="ticket.agencies"
			>
				<div v-for="a in ticket.agencies" :key="a.AgencyID">
					{{ a.AgencyName }}
				</div>
			</div>
			<div
				class="
					max-w-xs
					text-ellipsis
					overflow-hidden
					font-semibold
					text-gray-900
				"
				v-if="ticket.pms"
			>
				<div v-for="p in ticket.pms" :key="p.UserID">
					{{ p.FirstName }}
					{{ p.LastName }}
				</div>
			</div>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<div class="max-w-xs text-ellipsis overflow-hidden text-gray-500">
				{{ ticket.linked_ticket_url }}
			</div>
		</td>

		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ timestamp(ticket.updated_at) }}
		</td>

		<td
			class="
				relative
				whitespace-nowrap
				py-4
				pl-3
				pr-4
				text-right text-sm
				font-medium
				sm:pr-6
			"
		>
			<Link
				:href="'/ticket/' + ticket.id"
				class="text-indigo-600 hover:text-indigo-900"
				>View<span class="sr-only">
					ticket with ticket ID {{ ticket.id }}</span
				></Link
			>
		</td>
	</tr>
</template>

<script>
import dayjs from "dayjs";
export default {
	setup() {
		return {};
	},
	props: {
		ticket: Object,
	},
	computed: {},
	methods: {
		timestamp(date) {
			return dayjs(date, "YYYY-MM-DD hh:mm:ss").format(
				"DD/MM/YYYY h:mm a"
			);
		},
	},
};
</script>
