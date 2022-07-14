<template>
	<MainLayout :title="property.Address1">
		<div class="flex justify-between">
			<div class="flex gap-6">Property</div>
			<div class="flex">
				<!-- <Secondary>Edit</Secondary> -->
			</div>
		</div>
		<div v-if="show_raw">
			<div class="flex w-full">
				<ObjectNest :val="property"></ObjectNest>
			</div>
		</div>
		<div v-else>
			<div class="flex w-full">
				<button @click="go">go</button>
			</div>
		</div>
	</MainLayout>
</template>
<script>
import MainLayout from "@/Layouts/Main.vue";
import Primary from "../Buttons/Primary.vue";
import Secondary from "../Buttons/Secondary.vue";
import dayjs from "dayjs";
export default {
	components: {
		MainLayout,
		Primary,
		Secondary,
	},
	data() {
		return {
			show_raw: true,
			property: {},
		};
	},
	methods: {
		go() {
			let arr = [];
			this.property.Emails.forEach((e) => {
				var obj = {
					type: "email",
					timestamp: e.log_time,
					body: e,
				};
				arr.push(obj);
			});
			this.property.SMS.forEach((e) => {
				var obj = {
					type: "SMS",
					timestamp: e.log_time,
					body: e,
				};
				arr.push(obj);
			});
			arr.sort(function (a, b) {
				return dayjs(a.timestamp).unix() - dayjs(b.timestamp).unix();
			});
			console.log(arr);
		},
	},
	computed: {
		timeline() {
			console.log("starting");
			let arr = [];
			this.property.Emails.forEach((e) => {
				console.log(e);
				arr.push(e);
			});
			return arr;
		},
	},
	mounted() {
		this.property = this.$page.props.property;
	},
};
</script>
