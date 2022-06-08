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
										Property ID
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
										Agency
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
								</tr>
							</thead>
							<tbody class="divide-y divide-gray-200 bg-white">
								<Row
									v-for="(i, index) in properties"
									:key="index"
									:adr="i"
								/>
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
	components: {
		Row,
	},
	props: {
		properties: Array,
	},
};
</script>
