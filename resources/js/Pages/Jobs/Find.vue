<script setup>
import MainLayout from "@/Layouts/Main.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import { Link } from "@inertiajs/inertia-vue3";

let submit = () => {
	console.log("submitted");
	Inertia.get("/job/", this.form.job_id);
};
</script>
<script>
export default {
	components: {
		ButtonPrimary,
		Link,
	},
	data() {
		return {
			job_id: "",
		};
	},
	computed: {
		search_url() {
			return "/job/" + this.job_id;
		},
	},
};
</script>

<template>
	<MainLayout title="Jobs">
		<div>
			<label for="job_id" class="block text-sm font-medium text-gray-700"
				>Job ID</label
			>
			<div class="mt-1">
				<input
					type="job_id"
					name="job_id"
					id="job_id"
					v-model="job_id"
					class="
						shadow-sm
						max-w-lg
						focus:ring-indigo-500 focus:border-indigo-500
						block
						w-full
						sm:text-sm
						border-gray-300
						rounded-md
						p-2
					"
					placeholder="eg. 288371"
					aria-describedby="Job ID"
				/>
			</div>
			<p class="mt-2 text-sm text-gray-500" id="job_id description">
				Need to find the job ID?
			</p>
			<Link :href="search_url">
				<ButtonPrimary>Find</ButtonPrimary>
			</Link>
		</div>
	</MainLayout>
</template>
