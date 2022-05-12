<!-- This example requires Tailwind CSS v2.0+ -->
<template>
	<div class="">
		<div class="mt-8 flex flex-col">
			<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div
					class="
						inline-block
						min-w-full
						py-2
						align-middle
						md:px-6
						lg:px-8
					"
				>
					<div
						class="
							overflow-hidden
							shadow
							ring-1 ring-black ring-opacity-5
							md:rounded-lg
						"
					>
						<table class="min-w-full divide-y divide-gray-300">
							<thead class="bg-gray-50">
								<tr>
									<th
										scope="col"
										class="
											py-3.5
											pl-4
											pr-3
											text-left text-sm
											font-semibold
											text-gray-900
											sm:pl-6
										"
									>
										Details
									</th>

									<th
										scope="col"
										class="
											px-3
											py-3.5
											text-left text-sm
											font-semibold
											text-gray-900
										"
									>
										Owner
									</th>
									<th
										scope="col"
										class="
											px-3
											py-3.5
											text-left text-sm
											font-semibold
											text-gray-900
										"
									>
										Created
									</th>
									<th
										scope="col"
										class="
											px-3
											py-3.5
											text-left text-sm
											font-semibold
											text-gray-900
										"
									>
										Last Update
									</th>
									<!-- <th
										scope="col"
										class="
											px-3
											py-3.5
											text-left text-sm
											font-semibold
											text-gray-900
										"
									>
										AgencyID
									</th> -->

									<th
										scope="col"
										class="
											relative
											py-3.5
											pl-3
											pr-4
											sm:pr-6
										"
									>
										<span class="sr-only">Edit</span>
									</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-gray-200 bg-white">
								<TableRow
									v-for="t in tickets"
									:key="t.id"
									:ticket="t"
								></TableRow>
							</tbody>
						</table>
					</div>
				</div>
				<!-- <pre>{{ tickets }}</pre> -->
			</div>
		</div>
	</div>
</template>

<script>
import TableRow from "./TableRow.vue";
export default {
	components: {
		TableRow,
	},
	setup() {
		return {};
	},
	props: {
		tickets: Array,
	},
};
</script>
