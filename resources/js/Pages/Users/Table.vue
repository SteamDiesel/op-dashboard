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
										User Details
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
										Username
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
								<tr
									v-for="person in people"
									:key="person.UserID"
								>
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
										<div class="flex items-center">
											<div class="">
												<div
													class="
														font-medium
														text-gray-900
													"
												>
													{{ person.FirstName }}
													{{ person.LastName }}
												</div>
												<div class="text-gray-500">
													{{ person.Email }}
												</div>
												<div class="text-gray-500">
													{{ person.PhoneNumber }}
												</div>
												<div class="text-gray-500">
													{{ person.Mobile }}
												</div>
											</div>
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
										<div class="text-gray-900">
											{{ person.UserName }}
										</div>
										<div class="text-gray-500">
											{{ person.department }}
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
											v-if="person.Active == 1"
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
											v-if="person.Active == 0"
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
										{{ person.UserType.toUpperCase() }}
									</td>
									<td
										class="
											whitespace-nowrap
											px-3
											py-4
											text-sm text-gray-500
										"
									>
										{{ person.AgencyId }}
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
											:href="'/user/' + person.UserID"
											class="
												text-indigo-600
												hover:text-indigo-900
											"
											>View<span class="sr-only"
												>, {{ person.UserID }}</span
											></Link
										>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
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
		people: Array,
	},
};
</script>
