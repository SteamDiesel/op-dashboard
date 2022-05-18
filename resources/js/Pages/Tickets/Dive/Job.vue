<template>
	<div class="border rounded-lg p-4 w-full">
		<!-- fields -->
		<div class="w-full text-sm">
			<div class="w-full">
				<span class="font-semibold"
					>Job: {{ job.Title }} - {{ job.Type }}
				</span>

				<span
					class="
						bg-gray-200
						text-gray-700
						font-semibold
						rounded-full
						px-1
						ml-2
						text-xs
					"
					>{{ job.Status }}</span
				>
			</div>
			<div class="text-gray-500" :title="timeStamp(job.Created)">
				Created by {{ job.Creator[0].Name }}
				{{ timeForHumans(job.Created) }}
			</div>

			<div class="w-full text-sm">at {{ job.Property[0].Address1 }}</div>
		</div>
		<!-- related objects -->
		<div class="w-full flex">
			<div class="w-8">
				<ChevronDoubleDown
					@click="expand"
					v-if="!job.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleDown>
				<ChevronDoubleUp
					@click="job.expanded = !job.expanded"
					v-if="job.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleUp>
			</div>
			<div v-if="job.expanded">
				<!-- job Options -->
				<div class="flex gap-2">
					<!-- <Propertyjob :property="property"></Propertyjob> -->
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import ChevronDoubleRight from "../../Buttons/ChevronDoubleRight.vue";
import ChevronDoubleLeft from "../../Buttons/ChevronDoubleLeft.vue";
import ChevronDoubleDown from "../../Buttons/ChevronDoubleDown.vue";
import ChevronDoubleUp from "../../Buttons/ChevronDoubleUp.vue";
import { timeStamp, timeForHumans } from "../../Helpers";
export default {
	props: {
		job: Object,
	},
	components: {
		ChevronDoubleRight,
		ChevronDoubleLeft,
		ChevronDoubleDown,
		ChevronDoubleUp,
	},
	data() {
		return {
			revealed: false,
		};
	},
	methods: {
		timeStamp,
		timeForHumans,
		expand() {
			this.job.expanded = true;
		},
	},
};
</script>

<style>
</style>
