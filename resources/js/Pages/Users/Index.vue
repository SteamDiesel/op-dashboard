
<script>
import MainLayout from "@/Layouts/Main.vue";
import { Inertia } from "@inertiajs/inertia";
import ButtonPrimary from "@/Pages/Buttons/Primary.vue";
import { Link } from "@inertiajs/inertia-vue3";
import UsersTable from "./Table.vue";
import SearchBar from "./SearchBar.vue";
export default {
	components: {
		ButtonPrimary,
		Link,
		UsersTable,
		MainLayout,
		SearchBar,
	},
	data() {
		return {
			email: "",
			user_id: "",
			agency_id: "",
			user_type: "PM",
		};
	},

	methods: {
		byEmail() {
			Inertia.get(
				"/users",
				{ email: this.email },
				{ preserveState: true }
			);
		},
		byAgency() {
			Inertia.get(
				"/users",
				{ agency_id: this.agency_id, user_type: this.user_type },
				{ preserveState: true }
			);
		},
		byUserID() {
			Inertia.visit("/user/" + this.user_id);
		},
		userType($val) {
			this.user_type = $val;
		},
	},
};
</script>

<template>
	<MainLayout title="Users">
		<template v-slot:searchbar>
			<SearchBar class="mt-4" />
		</template>
		<div>
			<UsersTable :people="$attrs.users"></UsersTable>
		</div>
	</MainLayout>
</template>
