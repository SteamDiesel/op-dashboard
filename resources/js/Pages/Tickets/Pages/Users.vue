<template>
	<div>
		<div class="flex gap-4">
			<div class="max-w-xs">
				<label class="sr-only text-sm font-medium text-gray-700"
					>User email</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="email"
						v-model="email"
						@change="clearFields('email')"
						@keydown.enter="enterSearch('email')"
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
						aria-describedby="email address"
					/>

					<!-- <Primary @click="byEmail">Find</Primary> -->
				</div>
			</div>
			<div class="max-w-xs">
				<label class="sr-only text-sm font-medium text-gray-700"
					>User Mobile number</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="phone"
						@change="clearFields('phone')"
						@keydown.enter="enterSearch('phone')"
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
						aria-describedby="user's phone number"
					/>

					<!-- <Primary @click="byPhone">Find</Primary> -->
				</div>
			</div>
			<div class="max-w-xs">
				<label class="sr-only text-sm font-medium text-gray-700"
					>User ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="user_id"
						@change="clearFields('user_id')"
						@keydown.enter="enterSearch('user_id')"
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
						aria-describedby="user's ID number"
					/>
				</div>
			</div>
			<Primary
				@click="search"
				title="You can also just hit enter in the field you want to search from."
				>Search</Primary
			>
		</div>
		<div v-if="people.length" class="flex mt-4 flex-col gap-4">
			<p>
				Your search returned multiple results, select the one you want.
			</p>
			<div v-for="u in people" class="border rounded-lg p-4 flex">
				<div class="sm:w-1/2">
					<div
						class="flex align-top justify-start"
						v-for="(i, key) in u"
						:key="key"
					>
						<div class="font-bold">{{ key }}:</div>
						<div class="ml-2">
							{{ i }}
						</div>
					</div>
				</div>
				<div class="sm:w-1/2 flex justify-center items-center">
					<Secondary @click="$emit('addUser', u)">Select</Secondary>
				</div>
			</div>
		</div>
		<div class="w-full mt-8">
			<slot></slot>
		</div>
	</div>
</template>

<script>
import axios from "axios";
import Primary from "../../Buttons/Primary.vue";
import Secondary from "../../Buttons/Secondary.vue";

export default {
	components: {
		Primary,
		Secondary,
	},
	props: {
		ticket: Object,
	},
	data() {
		return {
			email: "",
			phone: "",
			people: "",
			user_id: "",
		};
	},
	methods: {
		enterSearch(field) {
			this.clearFields(field);
			this.search();
		},

		clearFields(field) {
			switch (field) {
				case "email":
					(this.phone = ""), (this.user_id = ""), (this.people = []);
					break;
				case "phone":
					(this.email = ""), (this.user_id = ""), (this.people = []);
					break;
				case "user_id":
					(this.phone = ""), (this.email = ""), (this.people = []);
					break;
			}
		},

		search() {
			console.log("search");
			this.people = [];
			axios
				.post("/ticket/api/getUser", {
					email: this.email,
					phone: this.phone,
					user_id: this.user_id,
				})
				.then((response) => {
					console.log(response.data);
					console.log(response.data.users);
					let $users = response.data.users;
					if ($users.length > 1) {
						this.people = response.data.users;
					} else {
						this.$emit("addUser", $users[0]);
					}
				})
				.catch((error) => {
					console.log(error);
				});
		},
	},
};
</script>

<style>
</style>
