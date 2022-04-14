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
						{{ job.Title }}
					</div>
					<div
						class="
							max-w-xs
							text-ellipsis
							overflow-hidden
							text-gray-500
						"
						:title="job.Description"
					>
						{{ job.Description }}
					</div>
					<div class="text-gray-500">
						{{ job.Trade }}
					</div>
					<div class="text-gray-500">
						{{ job.Property[0].Address1 }}
					</div>
					<div class="text-gray-500">
						Created by {{ job.Creator[0].Name }} at
						{{ timestamp(job.Created) }}
					</div>
					<div class="text-gray-900">
						Modified: {{ timestamp(job.Modified) }}
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
			>
				{{ job.PropertyManager_Contacts[0].Name }}
			</div>
			<div class="max-w-xs text-ellipsis overflow-hidden text-gray-500">
				{{ job.PropertyManager_Contacts[0].AgencyName }}
			</div>
			<div class="max-w-xs text-ellipsis overflow-hidden text-gray-500">
				{{ job.PropertyManager_Contacts[0].ID }}
			</div>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<div v-for="t in job.Tenant_Contacts" :key="t.ID">
				<div
					class="
						max-w-xs
						text-ellipsis
						overflow-hidden
						font-semibold
						text-gray-900
					"
				>
					{{ t.Name }}
				</div>
				<div
					class="max-w-xs text-ellipsis overflow-hidden text-gray-500"
				>
					{{ t.ID }}
				</div>
			</div>
		</td>

		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<span
				v-if="
					job.ApprovedStart == '' ||
					job.ApprovedStart == '0000-00-00 00:00:00'
				"
				class="
					inline-flex
					rounded-full
					bg-gray-100
					px-2
					text-xs
					font-semibold
					leading-5
					text-gray-800
				"
				>Pending</span
			>
			<div
				v-if="
					job.ApprovedStart !== '' &&
					job.ApprovedStart !== '0000-00-00 00:00:00'
				"
			>
				<span
					class="
						inline-flex
						rounded-full
						bg-green-100
						px-2
						text-xs
						font-semibold
						leading-5
						text-green-800
					"
					>Approved</span
				>
				<br />
				{{ timestamp(job.ApprovedStart) }}
			</div>
			<div v-if="job.InvoiceNumber !== '' && job.InvoiceNumber !== '0'">
				<span
					class="
						inline-flex
						rounded-full
						bg-green-100
						px-2
						mt-1
						text-xs
						font-semibold
						leading-5
						text-green-800
					"
					>Invoiced</span
				>
				<br />
				{{ job.InvoiceNumber }}
			</div>
		</td>
		<!--
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ job.UserType.toUpperCase() }}
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ job.AgencyId }}
		</td>
-->
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
				:href="'/job/' + job.ID"
				class="text-indigo-600 hover:text-indigo-900"
				>View<span class="sr-only">
					job with job ID {{ job.ID }}</span
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
		job: Object,
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
