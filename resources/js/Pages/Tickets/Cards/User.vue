<!-- This example requires Tailwind CSS v2.0+ -->
<template>
	<div class="bg-white px-4 py-5 sm:px-6 border rounded-lg max-w-2xl">
		<div class="flex space-x-3">
			<div class="flex-shrink-0">
				<div
					class="
						bg-green-200
						text-green-600
						rounded-full
						uppercase
						h-8
						w-8
						font-semibold
						items-center
						content-center
						align-middle
						text-center
					"
				>
					{{ user.UserType }}
				</div>
			</div>
			<div class="min-w-0 flex-1">
				<p class="font-medium text-gray-900">
					{{ user.FirstName }}
					{{ user.LastName }}
				</p>
				<p class="text-sm text-gray-500">
					{{ user.Email }}
				</p>
				<p class="text-sm text-gray-500">
					<span v-if="user.Mobile">{{ user.Mobile }}</span>
					<span v-if="user.PhoneNumber">
						- {{ user.PhoneNumber }}</span
					>
				</p>
			</div>
			<div class="flex-shrink-0 flex">
				<slot></slot>
			</div>
		</div>
	</div>
</template>

<script>
import { objectExpression } from "@babel/types";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
	CodeIcon,
	DotsVerticalIcon,
	FlagIcon,
	StarIcon,
} from "@heroicons/vue/solid";

export default {
	components: {
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		CodeIcon,
		DotsVerticalIcon,
		FlagIcon,
		StarIcon,
	},
	props: {
		user: Object,
		active: Boolean,
	},
};
</script>
