<!-- This example requires Tailwind CSS v2.0+ -->
<template>
	<button
		type="button"
		class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
	>
		<MinusSmIcon class="h-5 w-5" aria-hidden="true" />
	</button>
</template>

<script>
	import { MinusSmIcon } from "@heroicons/vue/solid";
	export default {
		components: {
			MinusSmIcon,
		},
	};
</script>
