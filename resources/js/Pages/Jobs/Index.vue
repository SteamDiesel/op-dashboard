
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
		clearFields(field) {
			switch (field) {
				case "property_id":
					(this.job_id = ""), (this.agency_id = "");
					break;
				case "job_id":
					(this.property = ""), (this.agency_id = "");
					break;
				case "agency_id":
					(this.property_id = ""), (this.job_id = "");
					break;
			}
		},
		search() {
			if (this.property_id) {
				this.byProperty();
			}
			if (this.job_id) {
				this.byJobID();
			}
			if (this.agency_id) {
				this.byAgency();
			}
		},
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
		<div class="flex gap-4">
			<!-- by Job ID -->
			<div class="max-w-xs">
				<label for="email" class="sr-only">By Job ID</label>
				<div class="flex">
					<input
						autocomplete="off"
						type="text"
						v-model="job_id"
						@keydown.enter="byJobID"
						@click="clearFields('job_id')"
						@change="clearFields('job_id')"
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
						placeholder="Job ID"
						aria-describedby="job's I.D. number"
					/>
				</div>
			</div>

			<!-- By Property ID -->
			<div class="max-w-xs">
				<label class="sr-only">By Property ID</label>
				<div class="flex">
					<input
						autocomplete="off"
						type="email"
						v-model="property_id"
						@keydown.enter="byProperty"
						@click="clearFields('property_id')"
						@change="clearFields('property_id')"
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
						placeholder="Property ID"
						aria-describedby="property I.D. "
					/>
				</div>
			</div>

			<div class="max-w-xs">
				<label for="email" class="sr-only">By Agency ID</label>
				<div class="flex">
					<input
						autocomplete="off"
						type="text"
						v-model="agency_id"
						@keydown.enter="byAgency"
						@click="clearFields('agency_id')"
						@change="clearFields('agency_id')"
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
						placeholder="Agency ID"
						aria-describedby="agency's I.D. number"
					/>
				</div>
			</div>
			<div>
				<ButtonPrimary @click="search">Search</ButtonPrimary>
			</div>
		</div>
		<div>
			<JobsTable :jobs="$attrs.jobs"></JobsTable>
		</div>
	</MainLayout>
</template>
