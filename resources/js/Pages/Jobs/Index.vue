<script setup>
import MainLayout from "@/Layouts/Main.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import { Link } from "@inertiajs/inertia-vue3";
import JobsTable from "./Table.vue";
</script>
<script>
export default {
	components: {
		ButtonPrimary,
		Link,
		JobsTable,
	},
	data() {
		return {
			property_id: "",
			job_id: "",
			agency_id: "",
			user_type: "PM",
		};
	},
	computed: {
		search_by_id() {
			return "/job/" + this.job_id;
		},
	},
	methods: {
		byProperty() {
			Inertia.get(
				"/jobs",
				{ property_id: this.property_id },
				{ preserveState: true }
			);
		},
		byAgency() {
			Inertia.get(
				"/jobs",
				{ agency_id: this.agency_id },
				{ preserveState: true }
			);
		},
		userType($val) {
			this.user_type = $val;
		},
	},
};
</script>

<template>
	<MainLayout title="Find Jobs">
		<div class="flex justify-start">
			<div class="max-w-xs mr-8">
				<label class="block text-sm font-medium text-gray-700"
					>By Property ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="email"
						v-model="property_id"
						class="
							shadow-sm
							max-w-xs
							focus:ring-indigo-500 focus:border-indigo-500
							block
							w-full
							sm:text-sm
							border-gray-300
							rounded-md
							p-2
							mr-2
						"
						placeholder="eg. 633052"
						aria-describedby="property I.D. "
					/>

					<ButtonPrimary @click="byProperty">Find</ButtonPrimary>
				</div>
			</div>
			<div class="max-w-xs mr-8">
				<label
					for="email"
					class="block text-sm font-medium text-gray-700"
					>By Job ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="job_id"
						class="
							shadow-sm
							max-w-xs
							focus:ring-indigo-500 focus:border-indigo-500
							block
							w-full
							sm:text-sm
							border-gray-300
							rounded-md
							p-2
							mr-2
						"
						placeholder="eg. 74159"
						aria-describedby="user's I.D. number"
					/>
					<Link :href="search_by_id">
						<ButtonPrimary>Find</ButtonPrimary>
					</Link>
				</div>
			</div>
			<div class="max-w-xs">
				<label
					for="price"
					class="block text-sm font-medium text-gray-700"
					>By Agency ID</label
				>
				<div class="mt-1 flex">
					<div class="relative rounded-md shadow-sm mr-2">
						<div
							class="
								absolute
								inset-y-0
								left-0
								flex
								items-center
								pointer-events-none
							"
						></div>
						<input
							v-model="agency_id"
							autocomplete="off"
							type="text"
							class="
								focus:ring-indigo-500 focus:border-indigo-500
								block
								max-w-xs
								pr-12
								sm:text-sm
								border-gray-300
								rounded-md
							"
							placeholder="eg. 74651"
						/>

						<div
							class="absolute inset-y-0 right-0 flex items-center"
						>
							<label for="usre_type" class="sr-only"
								>User Type</label
							>
							<select
								v-model="user_type"
								id="currency"
								name="currency"
								class="
									focus:ring-indigo-500
									focus:border-indigo-500
									h-full
									py-0
									pl-2
									pr-7
									border-transparent
									bg-transparent
									text-gray-500
									sm:text-sm
									rounded-md
								"
							>
								<option @click="userType('PM')" value="PM">
									PM
								</option>
								<option @click="userType('LL')" value="LL">
									LL
								</option>
								<option @click="userType('T')" value="T">
									T
								</option>
							</select>
						</div>
					</div>

					<ButtonPrimary @click="byAgency">Find</ButtonPrimary>
				</div>
			</div>
		</div>
		<div>
			<JobsTable :jobs="$attrs.jobs"></JobsTable>
		</div>
	</MainLayout>
</template>
