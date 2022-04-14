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
										Job Details
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
										Address
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
										Status
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
										Type
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
										AgencyID
									</th>

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
								<tr v-for="job in jobs" :key="job.ID">
									<td
										class="
											whitespace-nowrap
											py-4
											pl-4
											pr-3
											text-sm
											sm:pl-6
										"
									>
										<div class="flex items-center max-w-sm">
											<div class="">
												<div
													class="
														max-w-sm
														text-ellipsis
														overflow-hidden
														font-medium
														text-gray-900
													"
												>
													{{ job.Title }}
												</div>
												<div
													class="
														max-w-sm
														text-ellipsis
														overflow-hidden
														text-gray-500
													"
												>
													{{ job.Description }}
												</div>
												<div class="text-gray-500">
													{{ job.Trade }}
												</div>
											</div>
										</div>
									</td>
									<!-- <td
										class="
											whitespace-nowrap
											px-3
											py-4
											text-sm text-gray-500
										"
									>
										<div class="text-gray-900">
											{{ job.UserName }}
										</div>
										<div class="text-gray-500">
											{{ job.department }}
										</div>
									</td>
									<td
										class="
											whitespace-nowrap
											px-3
											py-4
											text-sm text-gray-500
										"
									>
										<span
											v-if="job.Active == 1"
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
											>Active</span
										>
										<span
											v-if="job.Active == 0"
											class="
												inline-flex
												rounded-full
												bg-red-100
												px-2
												text-xs
												font-semibold
												leading-5
												text-red-800
											"
											>Inactive</span
										>
									</td>
									<td
										class="
											whitespace-nowrap
											px-3
											py-4
											text-sm text-gray-500
										"
									>
										{{ job.UserType.toUpperCase() }}
									</td>
									<td
										class="
											whitespace-nowrap
											px-3
											py-4
											text-sm text-gray-500
										"
									>
										{{ job.AgencyId }}
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
											:href="'/user/' + job.UserID"
											class="
												text-indigo-600
												hover:text-indigo-900
											"
											>View<span class="sr-only"
												>, {{ job.UserID }}</span
											></Link
										>
									</td> -->
								</tr>
							</tbody>
						</table>
					</div>
					<pre>{{ jobs }}</pre>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	setup() {
		return {};
	},
	props: {
		jobs: Array,
	},
};
</script>
