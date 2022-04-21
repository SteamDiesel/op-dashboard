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
		<div v-if="$attrs.job" class="w-full">
			<div class="w-full flex"></div>
			<div class="w-full">
				<ObjectNest :val="$attrs.job"></ObjectNest>
			</div>
		</div>
	</MainLayout>
</template>
