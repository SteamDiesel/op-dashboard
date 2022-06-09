
<script>
import MainLayout from "@/Layouts/Main.vue";
import PropertyTable from "./Table.vue";
import { Inertia } from "@inertiajs/inertia";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import axios from "axios";
export default {
	components: {
		PropertyTable,
		MainLayout,
		ButtonPrimary,
	},
	data() {
		return {
			result: [],
			address: "",
			property_id: "",
			agency_id: "",
			loading: false,
			error: "",
		};
	},
	methods: {
		search() {
			if (this.address.length >= 6) {
				this.loading = true;
				axios
					.post("/property/search", {
						address: this.address,
					})
					.then((response) => {
						this.result = response.data.properties;
						console.log(response.data.properties);
						this.loading = false;
					})
					.catch((error) => {
						console.log(error);
						this.error = error;
						this.loading = false;
					});
			}
		},
		clearFields(field) {
			switch (field) {
				case "address":
					this.property_id = "";
					break;
				case "property_id":
					this.address = "";
					break;
			}
		},

		byPropertyId() {
			Inertia.visit("/property/" + this.property_id);
		},
	},
};
</script>

<template>
	<MainLayout title="Properties">
		<template v-slot:searchbar>
			<div class="flex justify-start gap-4">
				<div class="max-w-lg">
					<label class="sr-only">Address 1</label>
					<div class="flex">
						<input
							autocomplete="off"
							type="text"
							v-model="address"
							@click="clearFields('address')"
							@change="clearFields('address')"
							@keyup="search"
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
							placeholder="Address"
							aria-describedby="Street address"
						/>
						<div v-if="loading" class="absolute mt-2 ml-40">
							<span
								><img
									class="h-5"
									src="/images/spinner.gif"
									alt="loading"
							/></span>
						</div>
					</div>
				</div>
				<div class="max-w-xs">
					<label class="sr-only">Property ID</label>
					<div class="flex">
						<input
							autocomplete="off"
							type="text"
							v-model="property_id"
							@change="clearFields('property_id')"
							@click="clearFields('property_id')"
							@keydown.enter="byPropertyId"
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
							aria-describedby="Property ID"
						/>
					</div>
				</div>

				<!-- <div class="">
					<ButtonPrimary @click="byPropertyId">Search</ButtonPrimary>
				</div> -->
			</div>
		</template>
		<!-- <div v-if="loading" class="pl-10 absolute -mt-6">
			<span
				><img class="h-5" src="/images/spinner.gif" alt="loading"
			/></span>
		</div> -->
		<div class="">
			<PropertyTable :properties="result"></PropertyTable>
		</div>
		<div v-if="error" class="p-4">
			<span class="text-red-700 font-semibold">{{ error }}</span> <br />
			<span class="text-gray-700 text-sm"
				>Check the console and report this error</span
			>
		</div>
	</MainLayout>
</template>
