<script setup>
import PageTabs from "../Components/PageTabs.vue";
import Users from "./Pages/Users.vue";
import Jobs from "./Pages/Jobs.vue";
import User from "./Cards/User.vue";
import MergeTradie from "./Pages/MergeTradie.vue";
import TradieMenu from "./Cards/TradieMenu.vue";
import UserCard from "./Dive/User.vue";
import ObjectCard from "./Dive/Object.vue";
</script>

<script>
import { Inertia } from "@inertiajs/inertia";
import TicketLayout from "@/Layouts/TicketLayout.vue";
import Sidebar from "./Sidebar.vue";
import ObjectNest from "../Components/ObjectNest.vue";
import Tasks from "./Tasks.vue";
import axios from "axios";
import { FolderIcon, UsersIcon } from "@heroicons/vue/outline";

export default {
	components: {
		TicketLayout,
		Sidebar,
		ObjectNest,
		Tasks,
		FolderIcon,
		UsersIcon,
	},
	data() {
		return {
			navigation: [
				// {
				// 	name: "Users",
				// 	href: "ticket/" + this.$page.props.ticket.id + "/users",
				// 	prefix: "ticket/" + this.$page.props.ticket.id + "/user",
				// 	icon: UsersIcon,
				// },
				// {
				// 	name: "Jobs",
				// 	href: "ticket/" + this.$page.props.ticket.id + "/jobs",
				// 	prefix: "ticket/" + this.$page.props.ticket.id + "/job",
				// 	icon: FolderIcon,
				// },
			],
			tabs: [
				{
					name: "Users",
					page: "users",
				},
				{
					name: "Dive",
					page: "dive",
				},
				{
					name: "Data",
					page: "data",
				},
			],
			active_tab: "users",
		};
	},
	methods: {
		addUser(u) {
			console.log("addUser fired");

			console.log(u);
			if (this.$page.props.ticket.users == null) {
				this.$page.props.ticket.users = [];
			}
			if (u !== null) {
				this.$page.props.ticket.users.push(u);
			}
			this.saveTicket(this.$page.props.ticket);
		},
		dropUser(user) {
			console.log(user);
			let index = this.$page.props.ticket.users.findIndex((u) => {
				return u.UserID == user.UserID;
			});
			console.log(index);

			this.$page.props.ticket.users.splice(index, 1);
			this.saveTicket(this.$page.props.ticket);
		},
		addTask() {
			console.log("adding task");
			console.log(this.$page.props.ticket);
			let $task = {
				title: "",
				is_complete: false,
			};
			if (this.$page.props.ticket.tasks !== null) {
				this.$page.props.ticket.tasks.push($task);
			} else {
				this.$page.props.ticket.tasks = [];
				this.$page.props.ticket.tasks.push($task);
			}

			console.log(this.$page.props.ticket.tasks);
		},
		saveTask(task, index) {
			console.log("drop" + task.index);
			if (task.title == "") {
				console.log("dropping " + index);
				this.$page.props.ticket.tasks.splice(index, 1);
			}
			this.saveTicket(this.$page.props.ticket);
		},
		saveTicket(ticket) {
			axios
				.post("/ticket/update/" + ticket.id, {
					ticket: ticket,
				})
				.then((response) => {
					console.log(response.data.message);
				})
				.catch((error) => {
					console.log(error);
				});
		},
		changeTab(tab) {
			this.active_tab = tab;
		},
		actionMergeTradie(tradie) {
			this.active_tab = "merge_tradie";
		},
	},
};
</script>

<template>
	<TicketLayout
		:ticket="$attrs.ticket"
		:title="'Ticket: ' + $attrs.ticket.title"
		:navigation="navigation"
	>
		<!-- Named slots -->
		<template v-slot:sidebar>
			<Sidebar
				:team="$attrs.team"
				@save-ticket="saveTicket"
				:ticket="$attrs.ticket"
			></Sidebar>
			<Tasks
				@add-task="addTask"
				@save-task="saveTask"
				@save-ticket="saveTicket"
				:tasks="$attrs.ticket.tasks"
			></Tasks>
		</template>
		<template v-slot:header>
			<PageTabs
				:tabs="tabs"
				:active="active_tab"
				@change-tab="changeTab"
			></PageTabs>
		</template>

		<!--  -->
		<!-- Base slot -->
		<!--  -->

		<!-- Users -->
		<Users
			v-if="active_tab == 'users'"
			:ticket="$attrs.ticket"
			@save-ticket="saveTicket"
			@add-user="addUser"
			@action-merge-tradie="actionMergeTradie"
		>
			<div v-if="$attrs.ticket.users">
				<User
					class="mb-4"
					v-for="(u, index) in $attrs.ticket.users"
					:key="index"
					:user="u"
				>
					<TradieMenu
						:user="u"
						@action-merge-tradie="actionMergeTradie"
						@drop-user="dropUser"
					></TradieMenu>
				</User>
			</div>
		</Users>
		<!-- Jobs -->
		<Jobs
			v-if="active_tab == 'jobs'"
			:ticket="$attrs.ticket"
			@save-ticket="saveTicket"
			@add-user="addUser"
		></Jobs>
		<!-- Dive -->
		<div
			v-if="active_tab == 'dive'"
			class="w-full h-full grid grid-cols-1 gap-4 divide-y"
		>
			<div>
				<h2 class="font-semibold">Dive</h2>
				<p class="text-sm">
					Use this page to retrieve and explore related objects.
				</p>
			</div>
			<ObjectCard v-if="$attrs.ticket.users" name="Users">
				<UserCard
					v-for="(u, index) in $attrs.ticket.users"
					:key="index"
					:user="u"
					@save-ticket="saveTicket"
				></UserCard>
			</ObjectCard>
			<ObjectCard v-if="$attrs.ticket.properties" name="Properties">
				Properties
			</ObjectCard>
		</div>
		<!-- Data -->
		<div v-if="active_tab == 'data'" class="w-full h-full">
			<h2>Ticket Data</h2>
			<div class="w-full pl-4">
				<ObjectNest :val="$attrs.ticket"></ObjectNest>
			</div>
		</div>
		<!-- Merge User -->
		<MergeTradie
			v-if="active_tab == 'merge_tradie'"
			:ticket="$attrs.ticket"
		></MergeTradie>
	</TicketLayout>
</template>
