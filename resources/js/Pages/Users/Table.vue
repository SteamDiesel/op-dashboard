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
											pl-3
											pr-6
											py-3.5
											text-left text-sm
											font-semibold
											text-gray-900
										"
									>
										Login
									</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-gray-200 bg-white">
								<Row
									v-for="person in people"
									:key="person.UserID"
									:person="person"
								></Row>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Row from "./Row.vue";

export default {
	setup() {
		return {};
	},
	props: {
		people: Array,
	},
	data() {
		return {};
	},
	methods: {},
	components: { Row },
};
</script>
