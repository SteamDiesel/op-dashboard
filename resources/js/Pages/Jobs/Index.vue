
<script>
import { Inertia } from "@inertiajs/inertia";
import MainLayout from "@/Layouts/Main.vue";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import { Link } from "@inertiajs/inertia-vue3";
import JobsTable from "./Table.vue";
export default {
	components: {
		ButtonPrimary,
		Link,
		JobsTable,
		MainLayout,
	},
	data() {
		return {
			property_id: "",
			job_id: "",
			agency_id: "",
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
		byJobID() {
			Inertia.visit("/job/" + this.job_id);
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
			<!-- by Job ID -->
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
						@keydown.enter="byJobID"
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

					<ButtonPrimary @click="byJobID">Find</ButtonPrimary>
				</div>
			</div>

			<!-- By Property ID -->
			<div class="max-w-xs mr-8">
				<label class="block text-sm font-medium text-gray-700"
					>By Property ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="email"
						v-model="property_id"
						@keydown.enter="byProperty"
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
					>By Agency ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="agency_id"
						@keydown.enter="byAgency"
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
						aria-describedby="agency's I.D. number"
					/>

					<ButtonPrimary @click="byAgency">Find</ButtonPrimary>
				</div>
			</div>
		</div>
		<div>
			<JobsTable :jobs="$attrs.jobs"></JobsTable>
		</div>
	</MainLayout>
</template>
