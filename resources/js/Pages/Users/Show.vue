<script setup>
import MainLayout from "@/Layouts/Main.vue";

import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
import Primary from "../Buttons/Primary.vue";
import Secondary from "../Buttons/Secondary.vue";
import axios from "axios";

const getProperties = function (u) {
	u.properties = "please wait...";
	axios
		.post("/user/getProperties", {
			user_id: u.UserID,
		})
		.then((response) => {
			u.properties = response.data;
		})
		.catch((error) => {
			u.properties = "Error. Check the console log OR try again.";
			console.log(error);
		});
};
const getTenancy = function (u) {
	u.Tenancy = "please wait...";
	axios
		.post("/user/getTenancy", {
			user_id: u.UserID,
		})
		.then((response) => {
			u.Tenancy = response.data;
		})
		.catch((error) => {
			u.Tenancy = "Error. Check the console log OR try again.";
			console.log(error);
		});
};
</script>
<script>
export default {
	data() {
		return {
			p: "",
		};
	},
	methods: {},
};
</script>

<template>
	<MainLayout :title="$attrs.u.FirstName + ' ' + $attrs.u.LastName">
		<div v-if="$attrs.u"></div>

		<div class="flex justify-between">
			<div class="flex gap-6">
				<Primary @click.prevent="getProperties($attrs.u)"
					>+ Properties</Primary
				>

				<Primary @click.prevent="getTenancy($attrs.u)"
					>+ Tenancy Info</Primary
				>
				<Primary>+ Agency Details</Primary>
			</div>
			<div class="flex">
				<!-- <Secondary>Edit</Secondary> -->
			</div>
		</div>
		<div>
			<div class="flex w-full">
				<pre>{{ $attrs.u }}</pre>
			</div>
		</div>
	</MainLayout>
</template>
