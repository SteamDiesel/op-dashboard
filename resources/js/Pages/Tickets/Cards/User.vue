<!-- This example requires Tailwind CSS v2.0+ -->
<template>
	<div class="bg-white px-4 py-5 sm:px-6 border rounded-lg">
		<div class="flex space-x-3">
			<div class="flex-shrink-0">
				<div
					class="
						bg-green-400
						text-green-900
						rounded-full
						uppercase
						h-8
						w-8
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
				<Menu as="div" class="relative z-30 inline-block text-left">
					<div>
						<MenuButton
							class="
								-m-2
								p-2
								rounded-full
								flex
								items-center
								text-gray-400
								hover:text-gray-600
							"
						>
							<span class="sr-only">Open options</span>
							<DotsVerticalIcon
								class="h-5 w-5"
								aria-hidden="true"
							/>
						</MenuButton>
					</div>

					<transition
						enter-active-class="transition ease-out duration-100"
						enter-from-class="transform opacity-0 scale-95"
						enter-to-class="transform opacity-100 scale-100"
						leave-active-class="transition ease-in duration-75"
						leave-from-class="transform opacity-100 scale-100"
						leave-to-class="transform opacity-0 scale-95"
					>
						<MenuItems
							class="
								origin-top-right
								absolute
								right-0
								mt-2
								w-56
								rounded-md
								shadow-lg
								bg-white
								ring-1 ring-black ring-opacity-5
								focus:outline-none
							"
						>
							<div class="py-1">
								<MenuItem v-slot="{ active }">
									<button
										@click="
											$emit('actionMergeTradie', user)
										"
										:class="[
											active
												? 'bg-gray-100 text-gray-900'
												: 'text-gray-700',
											'flex px-4 py-2 text-sm w-full justify-center',
										]"
									>
										<span>Merge Tradies</span>
									</button>
								</MenuItem>
								<MenuItem v-slot="{ active }">
									<div>
										<slot></slot>
									</div>
								</MenuItem>
								<MenuItem v-slot="{ active }">
									<span
										class="
											flex
											px-4
											py-2
											text-sm
											w-full
											justify-center
										"
										>No Options for this User type</span
									>
								</MenuItem>
							</div>
						</MenuItems>
					</transition>
				</Menu>
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
