<template>
	<div class="py-4">
		<div class="flex">
			<h2 class="font-semibold mb-2 mr-2">{{ name }}</h2>
			<ChevronDoubleDown
				v-if="!expanded"
				class="h-5 text-gray-500"
				@click="expand('open')"
			></ChevronDoubleDown>
			<ChevronDoubleUp
				v-if="expanded"
				class="h-5 text-gray-500"
				@click="expand('close')"
			></ChevronDoubleUp>
		</div>

		<div v-if="expanded" class="grid grid-cols-1 gap-4">
			<slot></slot>
		</div>
	</div>
</template>

<script>
import ChevronDoubleDown from "../../Buttons/ChevronDoubleDown.vue";
import ChevronDoubleUp from "../../Buttons/ChevronDoubleUp.vue";
export default {
	props: {
		name: String,
		parent: Object,
	},
	data() {
		return {
			expanded: true,
		};
	},
	components: { ChevronDoubleDown, ChevronDoubleUp },
	methods: {
		expand(type) {
			switch (type) {
				case "open":
					this.expanded = true;
					break;
				case "close":
					this.expanded = false;
					break;
			}
		},
	},
};
</script>

<style>
</style>
