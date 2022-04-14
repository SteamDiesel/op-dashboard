<script setup>
import MainLayout from "@/Layouts/Main.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
</script>

<template>
	<MainLayout title="Job">
		<div v-if="!$attrs.job" class="flex w-full justify-between">
			<div>
				No results retrieved for the job number {{ $attrs.query }}
			</div>
		</div>
		<div v-if="$attrs.job" class="flex w-full justify-between">
			<div class="w-full">
				<div>Result for job ID {{ $attrs.query }}</div>
				<pre>{{ $attrs.job }}</pre>
			</div>
		</div>
	</MainLayout>
</template>
