<template>
	<div class="text-sm text-ellipsis whitespace-normal">
		<div class="align-top justify-start" v-for="(i, key) in val" :key="key">
			<div class="flex mt-1" v-if="typeof i !== 'object'">
				<div class="font-bold">{{ key }}:</div>
				<div class="ml-2">
					{{ i }}
				</div>
			</div>
			<div v-if="typeof i == 'object'" class="mt-1">
				<div class="font-bold">{{ key }}:</div>
				<ObjectNest class="pl-8" :val="i" />
			</div>
		</div>
	</div>
</template>

<script>
export default {
	components: {},
	props: { val: Object },
	data() {
		return {
			open: false,
		};
	},
	computed: {
		isArray(item) {
			return item.isArray;
		},
		isObject(item) {
			return typeof item === "object";
		},
	},
};
</script>

<style></style>
