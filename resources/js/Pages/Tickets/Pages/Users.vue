<template>
	<div>
		<div class="flex gap-8">
			<div class="max-w-xs">
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

					<Primary @click="byEmail">Find</Primary>
				</div>
			</div>
			<div class="max-w-xs">
				<label class="block text-sm font-medium text-gray-700"
					>User Mobile number</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="phone"
						@keydown.enter="byPhone"
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
						placeholder="eg. 0400696332"
						aria-describedby="user's phone number"
					/>

					<Primary @click="byPhone">Find</Primary>
				</div>
			</div>
			<div class="max-w-xs">
				<label class="block text-sm font-medium text-gray-700"
					>User ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="user_id"
						@keydown.enter="byId"
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
						placeholder="eg. 77356"
						aria-describedby="user's ID number"
					/>

					<Primary @click="byId">Find</Primary>
				</div>
			</div>
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
		<pre>{{ ticket.users }}</pre>
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
		byEmail() {
			console.log("byemail");
			this.people = [];
			axios
				.post("/ticket/api/getUser", {
					email: this.email,
				})
				.then((response) => {
					console.log(response.data.message);
					console.log(response.data.users);
					let $users = response.data.users;
					if ($users.length > 1) {
						console.log("greater than 1");
						this.people = response.data.users;
					} else {
						console.log("1 or less");
						this.$emit("addUser", $users[0]);
					}
				})
				.catch((error) => {
					console.log(error);
				});
		},
		byPhone() {
			console.log("byphone");
			this.people = [];
			axios
				.post("/ticket/api/getUser", {
					phone: this.phone,
				})
				.then((response) => {
					console.log(response.data.message);
					console.log(response.data.users);
					let $users = response.data.users;
					if ($users.length > 1) {
						console.log("greater than 1");
						this.people = response.data.users;
					} else {
						$emit("addUser", $users[0]);
					}
				})
				.catch((error) => {
					console.log(error);
				});
		},
		byId() {
			this.people = [];
			console.log("byID");
			axios
				.post("/ticket/api/getUser", {
					user_id: this.user_id,
				})
				.then((response) => {
					console.log(response.data.message);
					console.log(response.data.users);
					let $users = response.data.users;
					if ($users.length > 1) {
						console.log("greater than 1");
						this.people = response.data.users;
					} else {
						console.log("1 or less");
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
