<template>
	<div class="w-full">
		<button
			class="border rounded-sm px-2 text-sm"
			@click="fetchPropertyJobs"
		>
			Jobs +
		</button>
		<div class="p-4" v-if="loading">
			<img class="h-5" src="/images/spinner.gif" alt="" />
		</div>
		<div v-if="!loading" class="w-full">
			<!-- <div v-if="parent.jobs">
				{{ parent.jobs }}
			</div> -->

			<Job
				v-if="parent.jobs"
				v-for="(job, index) in parent.jobs"
				:key="index"
				:job="job"
			></Job>
		</div>
	</div>
</template>

<script>
import { saveTicket } from "@/Pages/Tickets/ticketApi.js";
import Job from "../Job.vue";
export default {
	components: { Job },
	props: {
		parent: Object,
	},
	data() {
		return {
			loading: false,
		};
	},
	methods: {
		saveTicket,
		fetchPropertyJobs() {
			this.loading = true;
			this.parent.jobs = [];

			axios
				.post("/ticket/api/getPropertyJobs", {
					property_id: this.parent.PropertyID,
				})
				.then((response) => {
					this.parent.jobs = response.data.jobs;
					this.loading = false;
					this.saveTicket();
				})
				.catch((error) => {
					console.log(error);
					this.loading = false;
					// $emit("failed", error);
				});
		},
	},
};
</script>

<style>
</style>
