
<script>
import MainLayout from "@/Layouts/Main.vue";
import PropertyTable from "./Table.vue";
import { Inertia } from "@inertiajs/inertia";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import axios from "axios";
import { reactive } from "vue";

export default {
	setup() {
		var sd = reactive({
			result: [],
			address: "",
			property_id: "",
			agency_id: "",
			pm_id: "",
			loading: false,
			error: "",
			myTimeout: "",
		});

		const search = function () {
			this.sd.loading = true;
			clearTimeout(this.sd.myTimeout);
			this.sd.myTimeout = setTimeout(() => {
				console.log(this.sd.address);
				console.log("running search");
				axios
					.post("/property/search", {
						address: this.sd.address,
					})
					.then((response) => {
						this.sd.result = response.data.properties;
						console.log(response.data.properties);
						this.sd.loading = false;
					})
					.catch((error) => {
						console.log(error);
						this.sd.error = error;
						this.sd.loading = false;
					});
			}, 1000);
		};

		const clearFields = function (field) {
			switch (field) {
				case "address":
					this.sd.property_id = "";
					break;
				case "property_id":
					this.sd.address = "";
					break;
			}
		};

		return { sd, search, clearFields };
	},
	components: {
		PropertyTable,
		MainLayout,
		ButtonPrimary,
	},

	methods: {
		autoSearch() {
			if (this.sd.address.length >= 6) {
				this.search();
			} else {
				console.log("Autosearch needs 6 characters or more.");
			}
		},
		byPropertyId() {
			Inertia.visit("/property/" + this.sd.property_id);
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
							title="will auto-search 1 second after last keystroke if more than 6 characters. press enter to force search."
							autocomplete="off"
							type="text"
							v-model="sd.address"
							@click="clearFields('address')"
							@change="clearFields('address')"
							@keyup="autoSearch"
							@keydown.enter="search"
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
						<div v-if="sd.loading" class="absolute mt-2 ml-40">
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
							v-model="sd.property_id"
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
			<PropertyTable :properties="sd.result"></PropertyTable>
		</div>
		<div v-if="sd.error" class="p-4">
			<span class="text-red-700 font-semibold">{{ sd.error }}</span>
			<br />
			<span class="text-gray-700 text-sm"
				>Check the console and report this error</span
			>
		</div>
	</MainLayout>
</template>
