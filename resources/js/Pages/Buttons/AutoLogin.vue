<template>
	<div>
		<div v-if="!loading">
			<button
				@click="getAutoLogin"
				v-if="!autologin_url"
				class=""
				title="Get an AutoLogin Link"
			>
				<ImpersonateGray class="h-8" />
			</button>
			<a
				v-if="autologin_url"
				:href="autologin_url"
				title="remember to open in incognito window"
			>
				<ExternalLinkIcon class="h-8" />
			</a>
		</div>
		<div v-if="loading">
			<img class="h-8" src="/images/spinner.gif" alt="loading" />
		</div>
	</div>
</template>

<script>
import axios from "axios";
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import ImpersonateGray from "../Icons/ImpersonateGray.vue";
import ImpersonateBlue from "../Icons/ImpersonateBlue.vue";
export default {
	components: { ImpersonateGray, ImpersonateBlue, ExternalLinkIcon },
	props: {
		user: Object,
	},
	data() {
		return {
			loading: false,
			autologin_url: "",
		};
	},
	methods: {
		getAutoLogin() {
			this.loading = true;
			let portal = "PM";
			switch (this.user.UserType) {
				case "t":
					portal = "T";
					break;
				case "":
					portal = "O";
					break;
				case "ll":
					portal = "LL";
					break;
				case "tr":
					portal = "TR";
					break;
				case "pm":
					portal = "PM";
					break;
				case "OA":
					portal = "PM";
					break;
				case "OM":
					portal = "PM";
					break;
			}

			axios
				.post("/user/getAutoLogin", {
					user_id: this.user.UserID,
					portal: portal,
				})
				.then((response) => {
					console.log(response.data.url);
					this.autologin_url = response.data.url;
					this.loading = false;
				})
				.catch((error) => {
					console.log(error);
					this.loading = false;
				});
		},
	},
};
</script>

<style>
</style>
