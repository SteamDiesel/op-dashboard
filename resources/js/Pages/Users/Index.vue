
<script>
import MainLayout from "@/Layouts/Main.vue";
import UsersTable from "./Table.vue";
import SearchBar from "./SearchBar.vue";
export default {
	components: {
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
