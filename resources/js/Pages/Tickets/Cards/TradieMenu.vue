<template>
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
				<DotsVerticalIcon class="h-5 w-5" aria-hidden="true" />
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
					<button
						class="
							hover:bg-gray-100
							text-gray-700
							flex
							px-4
							py-2
							text-sm
							w-full
							justify-center
							w-full
							h-full
						"
						@click="$emit('actionMergeTradie', user)"
					>
						<span>Merge</span>
					</button>
					<button
						class="
							hover:bg-gray-100
							text-gray-700
							flex
							px-4
							py-2
							text-sm
							w-full
							justify-center
							w-full
							h-full
						"
						@click="$emit('dropUser', user)"
					>
						<span>Drop</span>
					</button>

					<!-- <div class="hover:bg-gray-100">
						<span
							class="flex px-4 py-2 text-sm w-full justify-center"
							>No Options for this User type</span
						>
					</div> -->
				</div>
			</MenuItems>
		</transition>
	</Menu>
</template>

<script>
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
	},
};
</script>

<style>
</style>
