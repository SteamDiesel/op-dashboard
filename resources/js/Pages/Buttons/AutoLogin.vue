<template>
	<div class="h-8 w-8">
		<a
			:href="
				'/user/AutoLogin?user_type=' +
				user.UserType +
				'&a=' +
				$page.props.user.id +
				'&user_id=' +
				user.UserID
			"
			class="hover:border-4 hover:border-indigo-500"
			title="Open incognito"
			target="_blank"
		>
			<ImpersonateGray class="h-8" />
		</a>
	</div>
</template>

<script>
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import ImpersonateGray from "../Icons/ImpersonateGray.vue";
import ImpersonateBlue from "../Icons/ImpersonateBlue.vue";
export default {
	components: { ImpersonateGray, ImpersonateBlue, ExternalLinkIcon },
	props: {
		user: Object,
	},
	data() {
		return {};
	},
};
</script>

<style>
</style>
