
<script>
import MainLayout from "@/Layouts/Main.vue";
import UsersTable from "./Table.vue";
import SearchBar from "./SearchBar.vue";
import ChevronDoubleRight from "../Buttons/ChevronDoubleRight.vue";
import { Inertia } from "@inertiajs/inertia";
export default {
	components: {
		UsersTable,
		MainLayout,
		SearchBar,
		ChevronDoubleRight,
	},
	data() {
		return {
			email: "",
			user_id: "",
			agency_id: new URLSearchParams(window.location.search).get(
				"agency_id"
			),
			user_type: new URLSearchParams(window.location.search).get(
				"user_type"
			),
			page: new URLSearchParams(window.location.search).get("page"),
			count: 25,
		};
	},
	methods: {
		next() {
			console.log(window.location.search);
			let URLParams = new URLSearchParams(window.location.search).get(
				"user_type"
			);
			console.log(URLParams);
			Inertia.get(
				"/users",
				{
					agency_id: this.agency_id,
					user_type: this.user_type,
					page: +this.page + 1,
				},
				{ preserveState: false }
			);
		},
		back() {
			console.log(window.location.search);
			let URLParams = new URLSearchParams(window.location.search).get(
				"user_type"
			);
			console.log(URLParams);
			Inertia.get(
				"/users",
				{
					agency_id: this.agency_id,
					user_type: this.user_type,
					page: +this.page - 1,
				},
				{ preserveState: false }
			);
		},
	},
	computed: {
		show_next() {
			if (this.count >= 25) {
				return true;
			}
		},
		show_back() {
			if (this.page >= 1) {
				return true;
			}
		},
	},
	mounted() {
		this.count = this.$attrs.users.length;
	},
};
</script>

<template>
	<MainLayout title="Users">
		<template v-slot:searchbar>
			<SearchBar />
		</template>

		<UsersTable :people="$attrs.users"></UsersTable>
		<div class="flex justify-end">
			<div class="w-full flex justify-start">
				<button
					class="p-4 text-indigo-600 font-semibold"
					@click="back"
					v-if="page > 1"
				>
					Back
				</button>
			</div>
			<div class="w-full flex justify-end">
				<button
					class="p-4 text-indigo-600 font-semibold"
					@click="next"
					v-if="count >= 25"
				>
					Next
				</button>
			</div>
		</div>
	</MainLayout>
</template>
