<script setup>
import MainLayout from "@/Layouts/Main.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
</script>

<template>
	<MainLayout title="Job">
		<div class="flex w-full justify-between">
			<div>{{ $attrs.function }} {{ $attrs.job }}</div>
			<div><button>Edit</button></div>
		</div>
		<div>
			<div class="flex w-full"></div>
		</div>
	</MainLayout>
</template>
