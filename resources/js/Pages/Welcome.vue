<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
	canLogin: Boolean,
	canRegister: Boolean,
	laravelVersion: String,
	phpVersion: String,
});
</script>

<template>
	<Head title="Welcome" />

	<div
		class="
			flex
			w-full
			items-top
			justify-center
			min-h-screen
			bg-gray-100 bg-gradient-to-b
			from-indigo-200
			via-blue-900
			to-indigo-600
			dark:bg-gray-900
			sm:items-center sm:pt-0
		"
	>
		<div
			v-if="canLogin"
			class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
		>
			<Link
				v-if="$page.props.user"
				:href="route('dashboard')"
				class="text-sm text-gray-700 underline"
			>
				Dashboard
			</Link>

			<template v-else>
				<Link
					:href="route('login')"
					class="text-sm text-gray-700 underline"
				>
					Log in
				</Link>

				<!-- <Link
					v-if="canRegister"
					:href="route('register')"
					class="ml-4 text-sm text-gray-700 underline"
				>
					Register
				</Link> -->
			</template>
		</div>

		<div class="h-full w-full items-center justify-center">
			<div>
				<img class="mx-auto" src="/images/logo2-1.png" alt="" />
			</div>
		</div>
	</div>
</template>

