<template>
	<div class="border rounded-lg p-4 w-full">
		<!-- fields -->
		<div class="w-full text-sm">
			<div class="w-full">
				<span class="font-semibold"
					>Tenancy: {{ tenancy.FirstName }} {{ tenancy.LastName }} at
					{{ tenancy.Address1 }}
				</span>
				<span> | User ID:{{ tenancy.UserID }}</span>

				<span
					class="
						bg-green-200
						text-green-700
						font-semibold
						rounded-full
						px-1
						text-xs
					"
					v-if="tenancy.Active == 1"
					>Active</span
				>
			</div>

			<div class="w-full text-sm">
				LeaseStart: {{ dateStamp(tenancy.LeaseStart) }} | LeaseStop:
				{{ dateStamp(tenancy.LeaseStop) }}
				<span> | Vacating: {{ dateStamp(tenancy.Vacating) }}</span>
			</div>
			<div class="w-full text-sm">
				RentArrears: {{ tenancy.RentArrears }} | ArrearsPaidTo:
				{{ dateStamp(tenancy.ArrearsPaidTo) }} | PaidTo:
				{{ dateStamp(tenancy.PaidTo) }}
			</div>
		</div>
		<!-- related objects -->
		<div class="w-full flex">
			<div class="w-8">
				<ChevronDoubleDown
					@click="expand"
					v-if="!tenancy.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleDown>
				<ChevronDoubleUp
					@click="tenancy.expanded = !tenancy.expanded"
					v-if="tenancy.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleUp>
			</div>
			<div v-if="tenancy.expanded">
				<!-- Tenancy Options -->
				<div class="flex gap-2">
					<!-- <PropertyTenancy :property="property"></PropertyTenancy> -->
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
import { timeStamp, dateStamp } from "../../Helpers";
export default {
	props: {
		tenancy: Object,
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
		dateStamp,
		expand() {
			this.tenancy.expanded = true;
		},
	},
};
</script>

<style>
</style>
