<template>
	<MainLayout :title="$attrs.property.Address1">
		<div class="flex justify-between">
			<div class="flex gap-6">Property</div>
			<div class="flex">
				<!-- <Secondary>Edit</Secondary> -->
			</div>
		</div>
		<div>
			<div class="flex w-full">
				<ObjectNest :val="$attrs.property"></ObjectNest>
			</div>
		</div>
	</MainLayout>
</template>
<script>
import MainLayout from "@/Layouts/Main.vue";
import Primary from "../Buttons/Primary.vue";
import Secondary from "../Buttons/Secondary.vue";

export default {
	components: {
		MainLayout,
		Primary,
		Secondary,
	},
};
</script>
