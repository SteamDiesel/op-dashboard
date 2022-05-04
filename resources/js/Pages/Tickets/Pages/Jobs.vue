<template>
	<div>
		<div class="flex gap-8">
			<div class="max-w-xs">
				<label class="block text-sm font-medium text-gray-700"
					>By Property ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="email"
						v-model="property_id"
						@keydown.enter="byProperty"
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
						placeholder="eg. 633052"
						aria-describedby="property I.D. "
					/>

					<Primary @click="byProperty">Find</Primary>
				</div>
			</div>
			<div class="max-w-xs">
				<label
					for="email"
					class="block text-sm font-medium text-gray-700"
					>By Job ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="job_id"
						@keydown.enter="byJobID"
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

					<Primary @click="byJobID">Find</Primary>
				</div>
			</div>
			<div class="max-w-xs">
				<label
					for="email"
					class="block text-sm font-medium text-gray-700"
					>By Agency ID</label
				>
				<div class="mt-1 flex">
					<input
						autocomplete="off"
						type="text"
						v-model="agency_id"
						@keydown.enter="byAgency"
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
						aria-describedby="agency's I.D. number"
					/>

					<Primary @click="byAgency">Find</Primary>
				</div>
			</div>
		</div>
		<div v-if="people.length" class="flex mt-4 flex-col gap-4">
			<p>
				Your search returned multiple results, select the one you want.
			</p>
		</div>
		<pre>{{ ticket.jobs }}</pre>
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
			property_id: "",
			job_id: "",
			agency_id: "",
			user_type: "PM",
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
