
<script>
import { Inertia } from "@inertiajs/inertia";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";

export default {
	components: {
		ButtonPrimary,
	},
	data() {
		return {
			email: "",
			mobile: "",
			user_id: "",
			agency_id: "",
			user_type: "PM",
		};
	},

	methods: {
		Search() {
			if (this.mobile) {
				Inertia.get(
					"/users",
					{ mobile: this.mobile },
					{ preserveState: true }
				);
			}
			if (this.email) {
				Inertia.get(
					"/users",
					{ email: this.email },
					{ preserveState: true }
				);
			}
			if (this.user_id) {
				Inertia.visit("/user/" + this.user_id);
			}
			if (this.agency_id) {
				Inertia.get(
					"/users",
					{ agency_id: this.agency_id, user_type: this.user_type },
					{ preserveState: true }
				);
			}
		},
		clearFields(field) {
			switch (field) {
				case "email":
					(this.mobile = ""),
						(this.user_id = ""),
						(this.agency_id = "");
					break;
				case "mobile":
					(this.email = ""),
						(this.user_id = ""),
						(this.agency_id = "");
					break;
				case "user_id":
					(this.mobile = ""),
						(this.email = ""),
						(this.agency_id = "");
					break;
				case "agency_id":
					(this.mobile = ""), (this.email = ""), (this.user_id = "");
					break;
			}
		},
		byEmail() {
			Inertia.get(
				"/users",
				{ email: this.email },
				{ preserveState: true }
			);
		},
		byMobile() {
			Inertia.get(
				"/users",
				{ mobile: this.mobile },
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
	<div class="flex justify-start gap-4">
		<div class="max-w-xs">
			<label class="sr-only">User email</label>
			<div class="flex">
				<input
					autocomplete="off"
					type="email"
					v-model="email"
					@click="clearFields('email')"
					@change="clearFields('email')"
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
					placeholder="Email Address"
					aria-describedby="user's email address"
				/>
			</div>
		</div>
		<div class="max-w-xs">
			<label class="sr-only">User Mobile</label>
			<div class="flex">
				<input
					autocomplete="off"
					type="text"
					v-model="mobile"
					@change="clearFields('mobile')"
					@click="clearFields('mobile')"
					@keydown.enter="byMobile"
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
					placeholder="Mobile Number"
					aria-describedby="user's mobile number"
				/>
			</div>
		</div>
		<div class="max-w-xs">
			<label for="email" class="sr-only">By User ID</label>
			<div class="flex">
				<input
					autocomplete="off"
					type="text"
					v-model="user_id"
					@change="clearFields('user_id')"
					@click="clearFields('user_id')"
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
					placeholder="User ID"
					aria-describedby="user's I.D. number"
				/>
			</div>
		</div>
		<div class="max-w-xs">
			<label for="price" class="sr-only">By Agency ID</label>
			<div class="flex">
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
						@change="clearFields('agency_id')"
						@click="clearFields('agency_id')"
						@keydown.enter="byAgency"
						autocomplete="off"
						type="text"
						class="
							focus:ring-indigo-500 focus:border-indigo-500
							block
							w-xs
							pr-12
							sm:text-sm
							border-gray-300
							rounded-md
						"
						placeholder="Agency ID"
					/>

					<div class="absolute inset-y-0 right-0 flex items-center">
						<label for="user_type" class="sr-only">User Type</label>
						<select
							v-model="user_type"
							id="user_type"
							name="user_type"
							class="
								focus:ring-indigo-500 focus:border-indigo-500
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
							<option @click="userType('T')" value="T">T</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="">
			<ButtonPrimary @click="Search">Search</ButtonPrimary>
		</div>
	</div>
</template>
