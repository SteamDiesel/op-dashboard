<script setup>
import MainLayout from "@/Layouts/Main.vue";
import Primary from "./Buttons/Primary.vue";
</script>

<template>
	<MainLayout title="Connect API">
		Connect the API
		<div class="w-full">
			<h3>Check credentials</h3>
			<p>Ensure that the credentials match those in your API.</p>
			<div>Client ID: {{ $attrs.team.client_id }}</div>
			<div>Client Secret: {{ $attrs.team.client_secret }}</div>
			<div class="flex w-full justify-end">
				<a :href="$attrs.url"><Primary>Connect</Primary></a>
			</div>
		</div>
	</MainLayout>
</template>
