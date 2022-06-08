<script>
import MainLayout from "@/Layouts/Main.vue";
import AutoLogin from "../Buttons/AutoLogin.vue";
import axios from "axios";
import SearchBar from "./SearchBar.vue";

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
const getAgency = function (u) {
	u.Agency = "please wait...";
	axios
		.post("/getAgency", {
			agency_id: u.AgencyId,
		})
		.then((response) => {
			u.Agency = response.data;
		})
		.catch((error) => {
			u.Agency = "Error. Check the console log OR try again.";
			console.log(error);
		});
};
export default {
	components: {
		SearchBar,
		MainLayout,
		AutoLogin,
	},
};
</script>

<template>
	<MainLayout :title="$attrs.u.FirstName + ' ' + $attrs.u.LastName">
		<template v-slot:searchbar>
			<SearchBar class="mt-4" />
		</template>
		<div class="flex justify-between">
			<div class="flex gap-6">
				<!-- <Primary @click.prevent="getProperties($attrs.u)"
					>+ Properties</Primary
				>

				<Primary @click.prevent="getTenancy($attrs.u)"
					>+ Tenancy Info</Primary
				>
				<Primary @click.prevent="getAgency($attrs.u)"
					>+ Agency Details</Primary
				> -->
				<AutoLogin :user="$attrs.u"></AutoLogin>
			</div>
			<div class="flex">
				<!-- <Secondary>Edit</Secondary> -->
			</div>
		</div>
		<div>
			<div class="flex w-full">
				<ObjectNest :val="$attrs.u"></ObjectNest>
			</div>
		</div>
	</MainLayout>
</template>
