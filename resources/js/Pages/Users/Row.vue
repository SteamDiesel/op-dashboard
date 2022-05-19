<!-- This example requires Tailwind CSS v2.0+ -->
<template>
	<tr>
		<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
			<div class="flex items-center">
				<div class="">
					<div class="font-medium text-gray-900">
						{{ person.FirstName }}
						{{ person.LastName }}
					</div>
					<div class="text-gray-500">
						{{ person.Email }}
					</div>
					<div class="text-gray-500">
						{{ person.PhoneNumber }}
					</div>
					<div class="text-gray-500">
						{{ person.Mobile }}
					</div>
				</div>
			</div>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<div class="text-gray-900">
				{{ person.UserName }}
			</div>
			<div class="text-gray-500">
				{{ person.department }}
			</div>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			<span
				v-if="person.Active == 1"
				class="
					inline-flex
					rounded-full
					bg-green-100
					px-2
					text-xs
					font-semibold
					leading-5
					text-green-800
				"
				>Active</span
			>
			<span
				v-if="person.Active == 0"
				class="
					inline-flex
					rounded-full
					bg-red-100
					px-2
					text-xs
					font-semibold
					leading-5
					text-red-800
				"
				>Inactive</span
			>
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ person.UserType.toUpperCase() }}
		</td>
		<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
			{{ person.AgencyId }}
		</td>

		<td
			class="
				relative
				whitespace-nowrap
				py-4
				text-right text-sm
				font-medium
				w-12
			"
		>
			<div v-if="!auto_loading">
				<button @click="AutoLoginButton" v-if="!autologin_url" class="">
					<ImpersonateGray class="h-8" />
				</button>
				<a v-if="autologin_url" :href="autologin_url">
					<ImpersonateBlue class="h-8" />
				</a>
			</div>
			<div v-if="auto_loading">
				<img class="h-8" src="/images/spinner.gif" alt="loading" />
			</div>
		</td>
		<td
			class="
				relative
				whitespace-nowrap
				py-4
				pl-3
				pr-4
				text-right text-sm
				font-medium
				sm:pr-6
			"
		>
			<Link
				:href="'/user/' + person.UserID"
				class="text-indigo-600 hover:text-indigo-900"
				>View<span class="sr-only">, {{ person.UserID }}</span></Link
			>
		</td>
	</tr>
</template>

<script>
import { getAutoLogin } from "../Helpers";
import Secondary from "../Buttons/Secondary.vue";
import ImpersonateGray from "../Icons/ImpersonateGray.vue";
import ImpersonateBlue from "../Icons/ImpersonateBlue.vue";
export default {
	setup() {
		return {};
	},
	props: {
		person: Object,
	},
	data() {
		return {
			auto_loading: false,
			autologin_url: "",
		};
	},
	methods: {
		getAutoLogin,
		AutoLoginButton() {
			this.auto_loading = true;
			this.getAutoLogin(this.person);
		},
	},
	components: { Secondary, ImpersonateGray, ImpersonateBlue },
};
</script>
