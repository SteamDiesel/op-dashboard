<template>
	<div class="border rounded-lg p-4 w-full">
		<!-- fields -->
		<div class="w-full text-sm">
			<div class="w-full">
				<span class="font-semibold"
					>Property: {{ property.Address1 }} {{ property.Address2 }}
					{{ property.Suburb }} {{ property.Postcode }}</span
				>
				ID:{{ property.PropertyID }}

				<span
					class="
						bg-green-200
						text-green-700
						font-semibold
						rounded-full
						px-1
						text-xs
					"
					v-if="property.Active == 1"
					>Active</span
				>
			</div>

			<!-- <div class="w-full text-sm">
				PM: {{ property.ManagerID }} | Agency ID:
				{{ property.AgencyID }} | Owner IDs: {{ property.OwnerIDs }} |
				Tenant IDs: {{ property.TenantIDs }}
			</div> -->
		</div>
		<!-- related objects -->
		<div class="w-full flex">
			<div class="w-8">
				<ChevronDoubleDown
					@click="expand"
					v-if="!property.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleDown>
				<ChevronDoubleUp
					@click="property.expanded = !property.expanded"
					v-if="property.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleUp>
			</div>
			<div v-if="property.expanded">
				<!-- Property Options -->
				<div class="gap-2">
					<Tenancies :parent="property"></Tenancies>
					<Jobs :parent="property"></Jobs>
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
import Tenancies from "./Fetchers/Tenancies.vue";
import Jobs from "./Fetchers/Jobs.vue";
import Tenancy from "./Tenancy.vue";

export default {
	props: {
		property: Object,
	},
	components: {
		ChevronDoubleRight,
		ChevronDoubleLeft,
		ChevronDoubleDown,
		ChevronDoubleUp,
		Tenancies,
		Jobs,
		Tenancy,
	},
	data() {
		return {
			revealed: false,
		};
	},
	methods: {
		expand() {
			this.property.expanded = true;
		},
	},
};
</script>

<style>
</style>
