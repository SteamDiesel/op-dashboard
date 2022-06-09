<template>
	<tr>
		<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
			{{ adr.PropertyID }}
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<Link
				class="text-indigo-600 hover:text-indigo-900 font-semibold"
				:href="'/property/' + adr.PropertyID"
			>
				{{ adr.Address1 }}
				{{ adr.Address2 }}
				{{ adr.Suburb }} {{ adr.State }}
			</Link>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ adr.AgencyName }} <br />
			{{ adr.AgencyID }}
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<span
				class="
					bg-green-200
					text-green-700
					font-semibold
					rounded-full
					px-1
					text-xs
				"
				v-if="adr.Active"
				>active</span
			>
			<span
				class="
					bg-red-200
					text-red-700
					font-semibold
					rounded-full
					px-1
					text-xs
				"
				v-if="!adr.Active"
				>inactive</span
			>
		</td>
	</tr>
</template>

<script>
export default {
	props: {
		adr: Object,
	},
};
</script>

<style>
</style>
