<template>
	<div class="h-8 w-8">
		<a
			:href="tokenizedAutoLogin"
			class="hover:border-4 hover:border-indigo-500"
			title="Open incognito"
			target="_blank"
			@mouseenter="updateToken"
		>
			<ImpersonateGray class="h-8" />
		</a>
	</div>
</template>

<script>
import dayjs from "dayjs";
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
			token: "NULL_ERROR",
		};
	},
	computed: {
		tokenizedAutoLogin() {
			let user_id = this.$page.props.user.id;
			let url =
				"/user/AutoLogin?user_type=" +
				this.user.UserType +
				"&user_id=" +
				this.user.UserID +
				"&token=" +
				this.token +
				"&a=" +
				user_id;

			return url;
		},
	},
	methods: {
		updateToken() {
			let d = Date.now();
			let token = Math.floor(dayjs(d) / 1000) * 36;
			this.token = token;
		},
	},
};
</script>

<style>
</style>
