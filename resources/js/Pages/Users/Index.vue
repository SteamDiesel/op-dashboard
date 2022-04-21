
<script>
import MainLayout from "@/Layouts/Main.vue";
import { Inertia } from "@inertiajs/inertia";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import { Link } from "@inertiajs/inertia-vue3";
import UsersTable from "./Table.vue";
export default {
	components: {
		ButtonPrimary,
		Link,
		UsersTable,
		MainLayout,
	},
	data() {
		return {
			email: "",
			user_id: "",
			agency_id: "",
			user_type: "PM",
		};
	},

	methods: {
		byEmail() {
			Inertia.get(
				"/users",
				{ email: this.email },
				{ preserveState: true }
			);
		},
		byAgency() {
			Inertia.get(
				"/users",
				{ agency_id: this.agency_id, user_type: this.user_type },
				{ preserveState: true }
			);
		},
		byUserID() {
			Inertia.visit("/user/" + this.user_id);
		},
		userType($val) {
			this.user_type = $val;
		},
	},
};
</script>

<template>
	<MainLayout title="Users">
		<div class="flex justify-start">
			<div class="max-w-xs mr-8">
				<label class="block text-sm font-medium text-gray-700"
					>User email</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="email"
						v-model="email"
						@keydown.enter="byEmail"
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
						placeholder="eg. l_somerville@outlook.com"
						aria-describedby="user's email address"
					/>

					<ButtonPrimary @click="byEmail">Find</ButtonPrimary>
				</div>
			</div>
			<div class="max-w-xs mr-8">
				<label
					for="email"
					class="block text-sm font-medium text-gray-700"
					>By User ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="user_id"
						@keydown.enter="byUserID"
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

					<ButtonPrimary @click="byUserID">Find</ButtonPrimary>
				</div>
			</div>
			<div class="max-w-xs">
				<label
					for="price"
					class="block text-sm font-medium text-gray-700"
					>By Agency ID</label
				>
				<div class="mt-1 flex">
					<div class="relative rounded-md shadow-sm mr-2">
						<div
							class="
								absolute
								inset-y-0
								left-0
								flex
								items-center
								pointer-events-none
							"
						></div>
						<input
							v-model="agency_id"
							@keydown.enter="byAgency"
							autocomplete="off"
							type="text"
							class="
								focus:ring-indigo-500 focus:border-indigo-500
								block
								max-w-xs
								pr-12
								sm:text-sm
								border-gray-300
								rounded-md
							"
							placeholder="eg. 74651"
						/>

						<div
							class="absolute inset-y-0 right-0 flex items-center"
						>
							<label for="user_type" class="sr-only"
								>User Type</label
							>
							<select
								v-model="user_type"
								id="user_type"
								name="user_type"
								class="
									focus:ring-indigo-500
									focus:border-indigo-500
									h-full
									py-0
									pl-2
									pr-7
									border-transparent
									bg-transparent
									text-gray-500
									sm:text-sm
									rounded-md
								"
							>
								<option @click="userType('PM')" value="PM">
									PM
								</option>
								<option @click="userType('LL')" value="LL">
									LL
								</option>
								<option @click="userType('T')" value="T">
									T
								</option>
							</select>
						</div>
					</div>

					<ButtonPrimary @click="byAgency">Find</ButtonPrimary>
				</div>
			</div>
		</div>
		<div>
			<UsersTable :people="$attrs.users"></UsersTable>
		</div>
	</MainLayout>
</template>
