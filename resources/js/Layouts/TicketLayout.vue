<template>
	<div>
		<TransitionRoot as="template" :show="sidebarOpen">
			<Dialog
				as="div"
				class="fixed inset-0 flex z-40 md:hidden"
				@close="sidebarOpen = false"
			>
				<TransitionChild
					as="template"
					enter="transition-opacity ease-linear duration-300"
					enter-from="opacity-0"
					enter-to="opacity-100"
					leave="transition-opacity ease-linear duration-300"
					leave-from="opacity-100"
					leave-to="opacity-0"
				>
					<DialogOverlay
						class="fixed inset-0 bg-gray-600 bg-opacity-75"
					/>
				</TransitionChild>
				<TransitionChild
					as="template"
					enter="transition ease-in-out duration-300 transform"
					enter-from="-translate-x-full"
					enter-to="translate-x-0"
					leave="transition ease-in-out duration-300 transform"
					leave-from="translate-x-0"
					leave-to="-translate-x-full"
				>
					<div
						class="
							relative
							flex-1 flex flex-col
							max-w-xs
							w-full
							bg-white
						"
					>
						<TransitionChild
							as="template"
							enter="ease-in-out duration-300"
							enter-from="opacity-0"
							enter-to="opacity-100"
							leave="ease-in-out duration-300"
							leave-from="opacity-100"
							leave-to="opacity-0"
						>
							<div class="absolute top-0 right-0 -mr-12 pt-2">
								<button
									type="button"
									class="
										ml-1
										flex
										items-center
										justify-center
										h-10
										w-10
										rounded-full
										focus:outline-none
										focus:ring-2
										focus:ring-inset
										focus:ring-white
									"
									@click="sidebarOpen = false"
								>
									<span class="sr-only">Close sidebar</span>
									<XIcon
										class="h-6 w-6 text-white"
										aria-hidden="true"
									/>
								</button>
							</div>
						</TransitionChild>
						<div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
							<nav class="mt-5 px-2 space-y-1">
								<Link
									v-for="item in navigation"
									:key="item.name"
									:href="item.href"
									:class="[
										$page.url.startsWith(item.href)
											? 'bg-gray-100 text-gray-900'
											: 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
										'group flex items-center px-2 py-2 text-base font-medium rounded-md',
									]"
								>
									<component
										:is="item.icon"
										:class="[
											$page.url.startsWith(item.href)
												? 'text-gray-500'
												: 'text-gray-400 group-hover:text-gray-500',
											'mr-4 flex-shrink-0 h-6 w-6',
										]"
										aria-hidden="true"
									/>
									{{ item.name }}
								</Link>
							</nav>
						</div>
						<!-- <div
								class="
									flex-shrink-0 flex
									border-t border-gray-200
									p-4
								"
							>
								<a href="#" class="flex-shrink-0 group block">
									<div class="flex items-center">
										<div>
											<img
												class="
													inline-block
													h-10
													w-10
													rounded-full
												"
												src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
												alt=""
											/>
										</div>
										<div class="ml-3">
											<p
												class="
													text-base
													font-medium
													text-gray-700
													group-hover:text-gray-900
												"
											>
												Tom Cook
											</p>
											<p
												class="
													text-sm
													font-medium
													text-gray-500
													group-hover:text-gray-700
												"
											>
												View profile
											</p>
										</div>
									</div>
								</a>
							</div> -->
					</div>
				</TransitionChild>
				<div class="flex-shrink-0 w-14">
					<!-- Force sidebar to shrink to fit close icon -->
				</div>
			</Dialog>
		</TransitionRoot>

		<!-- Static sidebar for desktop -->
		<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
			<!-- Sidebar component, swap this element with another sidebar if you like -->
			<div
				class="
					flex-1 flex flex-col
					min-h-0
					border-r border-gray-200
					bg-white
				"
			>
				<div class="flex-1 flex flex-col pb-4 overflow-y-auto">
					<Link
						href="/tickets"
						class="
							flex
							items-center
							flex-shrink-0
							px-4
							py-3
							bg-slate-500
							text-gray-700
							hover:text-indigo-700
						"
					>
						<LogoutIcon class="h-10 rotate-180" />
						<div class="ml-2 font-bold">Tickets</div>
					</Link>
					<div>
						<Sidebar :team="team" :ticket="ticket"></Sidebar>
						<Tasks :tasks="ticket.tasks"></Tasks>
						<slot name="sidebar"></slot>
					</div>
				</div>
				<!-- <div
						class="flex-shrink-0 flex border-t border-gray-200 p-4"
					>
						<a href="#" class="flex-shrink-0 w-full group block">
							<div class="flex items-center">
								<div>
									<img
										class="
											inline-block
											h-9
											w-9
											rounded-full
										"
										src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
										alt=""
									/>
								</div>
								<div class="ml-3">
									<p
										class="
											text-sm
											font-medium
											text-gray-700
											group-hover:text-gray-900
										"
									>
										Tom Cook
									</p>
									<p
										class="
											text-xs
											font-medium
											text-gray-500
											group-hover:text-gray-700
										"
									>
										View profile
									</p>
								</div>
							</div>
						</a>
					</div> -->
			</div>
		</div>
		<div class="md:pl-64 flex flex-col flex-1">
			<div
				class="
					sticky
					top-0
					z-10
					md:hidden
					pl-1
					pt-1
					sm:pl-3 sm:pt-3
					bg-white
				"
			>
				<button
					type="button"
					class="
						-ml-0.5
						-mt-0.5
						h-12
						w-12
						inline-flex
						items-center
						justify-center
						rounded-md
						text-gray-500
						hover:text-gray-900
						focus:outline-none
						focus:ring-2
						focus:ring-inset
						focus:ring-indigo-500
					"
					@click="sidebarOpen = true"
				>
					<span class="sr-only">Open sidebar</span>
					<MenuIcon class="h-6 w-6" aria-hidden="true" />
				</button>
			</div>
			<main class="flex-1">
				<div class="py-4">
					<div
						class="
							w-full
							flex
							justify-between
							mx-auto
							px-4
							sm:px-6
							md:px-8
						"
					>
						<div class="w-full">
							<div class="sm:hidden">
								<label for="tabs" class="sr-only"
									>Select a tab</label
								>
								<!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
								<select
									id="tabs"
									name="tabs"
									class="
										block
										w-full
										pl-3
										pr-10
										py-2
										text-base
										border-gray-300
										focus:outline-none
										focus:ring-indigo-500
										focus:border-indigo-500
										sm:text-sm
										rounded-md
									"
								>
									<option
										v-for="tab in tabs"
										:key="tab.name"
										:selected="tab.current"
									>
										{{ tab.name }}
									</option>
								</select>
							</div>
							<div class="hidden sm:block">
								<div class="border-b border-gray-200">
									<nav
										class="-mb-px flex space-x-8"
										aria-label="Tabs"
									>
										<Link
											v-for="tab in tabs"
											:key="tab.name"
											:href="tab.href"
											:class="[
												$page.url.startsWith(tab.href)
													? 'border-indigo-500 text-indigo-600'
													: 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
												'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm',
											]"
										>
											{{ tab.name }}
										</Link>
									</nav>
								</div>
							</div>
						</div>
					</div>
					<div class="w-full mx-auto px-4 sm:px-6 md:px-8">
						<!-- Replace with your content -->
						<div class="py-4">
							<slot></slot>
						</div>
						<!-- /End replace -->
					</div>
				</div>
			</main>
		</div>
	</div>
</template>

<script>
import { ref } from "vue";
const navigation = [
	{
		name: "Tickets",
		href: "/tickets",
		prefix: "/ticket",
		icon: HomeIcon,
	},

	{ name: "Users", href: "/users", prefix: "/user", icon: UsersIcon },
	{ name: "Jobs", href: "/jobs", prefix: "/job", icon: FolderIcon },
	{
		name: "Test Connection",
		href: "/test_connection",
		icon: ChartBarIcon,
		current: false,
	},
];
import { Head, Link } from "@inertiajs/inertia-vue3";
import {
	Dialog,
	DialogOverlay,
	TransitionChild,
	TransitionRoot,
} from "@headlessui/vue";
import {
	MenuIcon,
	XIcon,
	LogoutIcon,
	HomeIcon,
	UsersIcon,
	FolderIcon,
	ChartBarIcon,
} from "@heroicons/vue/outline";
import Tasks from "../Pages/Tickets/Tasks.vue";
import Sidebar from "../Pages/Tickets/Sidebar.vue";

export default {
	components: {
		Dialog,
		DialogOverlay,
		TransitionChild,
		TransitionRoot,
		MenuIcon,
		XIcon,
		Link,
		Head,
		LogoutIcon,
		Tasks,
		Sidebar,
		HomeIcon,
		UsersIcon,
		FolderIcon,
		ChartBarIcon,
	},
	props: {
		team: Object,
		ticket: Object,
	},
	data() {
		return {
			tabs: [
				{
					name: "Users",
					href: "/ticket/" + this.ticket.id + "/users",
				},
				{
					name: "Dive",
					href: "/ticket/" + this.ticket.id + "/dive",
				},
				{
					name: "Data",
					href: "/ticket/" + this.ticket.id + "/data",
				},
				{
					name: "Activity",
					href: "/ticket/" + this.ticket.id + "/activity",
				},
			],
		};
	},

	setup() {
		const sidebarOpen = ref(false);

		return {
			sidebarOpen,
			navigation,
		};
	},
};
</script>
