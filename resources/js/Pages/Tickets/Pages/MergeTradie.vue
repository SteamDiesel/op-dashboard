<template>
	<div>
		<div class="">
			<div class="mb-8">
				<h2 class="font-semibold">Merge Tradies</h2>
				<p class="text-gray-700 text-sm">
					Select the parent account and child accounts. The parent
					will absorb the child accounts.
				</p>
			</div>

			<div class="flex">
				<div class="mt-8 flex flex-col">
					<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
						<div
							class="
								inline-block
								min-w-full
								py-2
								align-middle
								md:px-6
								lg:px-8
							"
						>
							<div
								class="
									overflow-hidden
									shadow
									ring-1 ring-black ring-opacity-5
									md:rounded-lg
								"
							>
								<table
									class="min-w-full divide-y divide-gray-300"
								>
									<thead class="bg-gray-50">
										<tr>
											<th
												scope="col"
												class="
													py-3.5
													pl-4
													pr-3
													text-left text-sm
													font-semibold
													text-gray-900
													sm:pl-6
												"
											>
												Tradie
											</th>
											<th
												scope="col"
												class="
													px-3
													py-3.5
													text-left text-sm
													font-semibold
													text-gray-900
												"
											>
												Parent
											</th>
											<th
												scope="col"
												class="
													px-3
													py-3.5
													text-left text-sm
													font-semibold
													text-gray-900
												"
											>
												Children
											</th>
										</tr>
									</thead>
									<tbody
										class="
											divide-y divide-gray-200
											bg-white
										"
									>
										<tr
											v-for="person in tradies"
											:key="person.id"
										>
											<td
												class="
													whitespace-nowrap
													py-4
													pl-4
													pr-3
													text-sm
													font-medium
													text-gray-900
													sm:pl-6
												"
											>
												<p>
													{{ person.FirstName }}
													{{ person.LastName }}
												</p>
												<p>{{ person.Email }}</p>
												<p>{{ person.Mobile }}</p>
												<p>{{ person.UserID }}</p>
											</td>
											<td
												class="
													whitespace-nowrap
													px-3
													py-4
													text-sm text-gray-500
												"
											>
												<Primary
													@click="toParent(person)"
													><ChevronDoubleRightIcon
														class="h-4"
													></ChevronDoubleRightIcon
												></Primary>
											</td>
											<td
												class="
													whitespace-nowrap
													px-3
													py-4
													text-sm text-gray-500
												"
											>
												<Primary
													@click="toChildren(person)"
													><ChevronDoubleRightIcon
														class="h-4"
													></ChevronDoubleRightIcon
												></Primary>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="w-full flex border rounded-lg my-4 p-4 gap-4">
				<div class="font-semibold text-gray-700">The parent:</div>
				<div>{{ parent }}</div>
				<div class="font-semibold text-gray-700">will absorb:</div>
				<div>
					<div v-for="(i, index) in children" :key="index">
						{{ i }}
						<button @click="dropChild(index)">
							<XIcon class="h-3"></XIcon>
						</button>
					</div>
				</div>
			</div>
			<div class="flex justify-end">
				<Primary @click="mergeTradies">Merge</Primary>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";
import Primary from "../../Buttons/Primary.vue";
import { ChevronDoubleRightIcon, XIcon } from "@heroicons/vue/outline";

export default {
	components: { Primary, ChevronDoubleRightIcon, XIcon },
	props: {
		ticket: Object,
	},
	data() {
		return { waiting: true, parent: "", children: [], message: "" };
	},
	computed: {
		tradies() {
			let tradies = [];
			this.ticket.users.map((u) => {
				if (u.UserType == "tr") {
					tradies.push(u);
				}
			});
			return tradies;
		},
		merge_url() {
			return (
				"The parent account: " +
				this.parent +
				" will absorb the child accounts: " +
				this.children
			);
		},
	},
	methods: {
		toParent(u) {
			this.parent = u.Email;
		},
		toChildren(u) {
			this.children.push(u.Email);
		},
		dropChild(index) {
			this.children.splice(index, 1);
		},
		mergeTradies() {
			this.waiting = true;
			axios
				.post("/ticket/api/mergeTradies", {
					parent: this.parent,
					children: this.children,
				})
				.then((response) => {
					console.log(response.data);
					if (response.data.success) {
						this.waiting = true;
					} else {
						this.waiting = false;
					}
					this.message = response.data.message;
				})
				.catch((error) => {
					console.log(error);
				});
		},
	},
};
</script>

<style>
</style>
