<template>
	<div class="border rounded-lg p-4 w-full">
		<!-- fields -->
		<div class="w-full text-sm">
			<div class="w-full">
				<span class="font-semibold"
					>User: {{ user.FirstName }} {{ user.LastName }}</span
				>
				ID: {{ user.UserID }}

				<span
					class="
						bg-green-200
						text-green-700
						font-semibold
						rounded-full
						px-1
						text-xs
					"
					v-if="user.Active == 1"
					>Active</span
				><span class="mx-2 uppercase"> {{ user.UserType }}</span>
			</div>

			<div class="w-full">
				Email: {{ user.Email }} | Mobile: {{ user.Mobile }} | Agency ID:
				{{ user.AgencyId }}
			</div>
			<div class="w-1/4"></div>
		</div>
		<!-- related objects -->
		<div class="w-full flex">
			<div class="w-8">
				<ChevronDoubleDown
					@click="expand"
					v-if="!user.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleDown>
				<ChevronDoubleUp
					@click="user.expanded = !user.expanded"
					v-if="user.expanded"
					class="h-5 text-gray-500"
				></ChevronDoubleUp>
			</div>
			<div class="w-full" v-if="user.expanded">
				<!-- Tenant options -->
				<div class="flex gap-2" v-if="user.UserType == 't'">
					<UserTenancy :user="user"></UserTenancy>
					<Property :user="user"></Property>
				</div>
				<!-- Landlord Options -->
				<div class="flex gap-2" v-if="user.UserType == 'll'">
					<Property :user="user"></Property>
				</div>
				<!-- Tradie Options -->
				<div class="flex gap-2" v-if="user.UserType == 'tr'">
					Tradie Options
				</div>
				<!-- PM Options -->
				<div class="flex gap-2" v-if="user.UserType == 'pm'">
					PM Options
				</div>
				<div class="w-full">
					<PropertyCard
						v-for="(p, index) in user.properties"
						:key="index"
						:property="p"
					></PropertyCard>
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
import UserTenancy from "./Fetchers/UserTenancy.vue";
import Property from "./Fetchers/Property.vue";
import PropertyCard from "./Property.vue";

export default {
	props: {
		user: Object,
	},
	components: {
		ChevronDoubleRight,
		ChevronDoubleLeft,
		ChevronDoubleDown,
		ChevronDoubleUp,
		UserTenancy,
		Property,
		PropertyCard,
	},
	data() {
		return {
			expanded: false,
		};
	},
	methods: {
		expand() {
			this.user.expanded = true;
		},
	},
};
</script>

<style>
</style>
