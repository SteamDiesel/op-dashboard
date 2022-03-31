<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tinkering from "@/Pages/Tinkering.vue";
</script>

<template>
	<AppLayout title="Dashboard">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Tinkering
			</h2>
		</template>
		<!-- http://localhost/dashboard?code=85424fce1b3dd3ca3bdd1eb6e264b01f8cbff8ae&state=63761 -->

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<Tinkering :props="param_code" />
				</div>
			</div>
		</div>
	</AppLayout>
</template>
