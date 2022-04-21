
<script>
import { Inertia } from "@inertiajs/inertia";
import MainLayout from "@/Layouts/Main.vue";
export default {
	components: {
		MainLayout,
	},
};
</script>

<template>
	<MainLayout title="Ticket">
		<div v-if="!$attrs.ticket" class="flex w-full justify-between">
			<div>
				No results retrieved for the ticket number {{ $attrs.query }}
			</div>
		</div>
		<div v-if="$attrs.ticket" class="flex w-full justify-between">
			<div class="w-full">
				<div>Result for Ticket {{ $attrs.query }}</div>
				<pre>{{ $attrs.ticket }}</pre>
			</div>
		</div>
	</MainLayout>
</template>
