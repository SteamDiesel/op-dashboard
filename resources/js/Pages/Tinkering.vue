

<template>
	<Head title="Tinkering" />

	<div class="p-6 space-y-8 divide-y divide-gray-200 sm:space-y-5">
		<div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
			<div class="space-y-6 sm:space-y-5">
				<div
					class="
						sm:grid
						sm:grid-cols-3
						sm:gap-4
						sm:items-start
						sm:border-t
						sm:border-gray-200
						sm:pt-5
					"
				>
					<label
						for="first-name"
						class="
							block
							text-sm
							font-medium
							text-gray-700
							sm:mt-px sm:pt-2
						"
					>
						Client ID
					</label>
					<div class="mt-1 sm:mt-0 sm:col-span-2">
						<input
							type="text"
							v-model="client_id"
							@change="saveCredentials"
							class="
								max-w-lg
								block
								w-full
								shadow-sm
								focus:ring-indigo-500 focus:border-indigo-500
								sm:max-w-xs sm:text-sm
								border-gray-300
								rounded-md
							"
						/>
					</div>
				</div>

				<div
					class="
						sm:grid
						sm:grid-cols-3
						sm:gap-4
						sm:items-start
						sm:border-t
						sm:border-gray-200
						sm:pt-5
					"
				>
					<label
						for="last-name"
						class="
							block
							text-sm
							font-medium
							text-gray-700
							sm:mt-px sm:pt-2
						"
					>
						Client Secret
					</label>
					<div class="mt-1 sm:mt-0 sm:col-span-2">
						<input
							type="text"
							v-model="client_secret"
							@change="saveCredentials"
							class="
								max-w-lg
								block
								w-full
								shadow-sm
								focus:ring-indigo-500 focus:border-indigo-500
								sm:max-w-xs sm:text-sm
								border-gray-300
								rounded-md
							"
						/>
					</div>
				</div>
			</div>

			<div class="space-y-8 divide-y divide-gray-200">
				<div
					class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
				>
					<div class="sm:col-span-4">
						<p>
							This will take you to the OP Admin Panel and ask you
							to Authorize this application.
						</p>
						<a class="hover:underline" :href="auth_link"
							><button
								type="submit"
								class="
									ml-3
									inline-flex
									justify-center
									py-2
									px-4
									border border-transparent
									shadow-sm
									text-sm
									font-medium
									rounded-md
									text-white
									bg-indigo-600
									hover:bg-indigo-700
									focus:outline-none
									focus:ring-2
									focus:ring-offset-2
									focus:ring-indigo-500
								"
							>
								Authorize
							</button>
						</a>
					</div>
				</div>
			</div>
			<div class="space-y-8 divide-y divide-gray-200">
				<div
					class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
				>
					<div class="sm:col-span-4">
						<p>
							Now send the post request to api to get the access
							token for future requests.
						</p>
						<button
							type="submit"
							class="
								ml-3
								inline-flex
								justify-center
								py-2
								px-4
								border border-transparent
								shadow-sm
								text-sm
								font-medium
								rounded-md
								text-white
								bg-indigo-600
								hover:bg-indigo-700
								focus:outline-none
								focus:ring-2
								focus:ring-offset-2
								focus:ring-indigo-500
							"
							@click="getToken"
						>
							getToken
						</button>
					</div>
				</div>
			</div>
			<div class="space-y-8 divide-y divide-gray-200">
				<div
					class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
				>
					<div class="sm:col-span-4">
						<p>
							Test the connection and view the response in the
							devtools console.
						</p>
						<button
							type="submit"
							class="
								ml-3
								inline-flex
								justify-center
								py-2
								px-4
								border border-transparent
								shadow-sm
								text-sm
								font-medium
								rounded-md
								text-white
								bg-indigo-600
								hover:bg-indigo-700
								focus:outline-none
								focus:ring-2
								focus:ring-offset-2
								focus:ring-indigo-500
							"
							@click="testAuth"
						>
							Test Auth
						</button>
					</div>
				</div>
			</div>
			<div class="pt-5">
				<div class="flex justify-end">
					<button
						type="button"
						class="
							bg-white
							py-2
							px-4
							border border-gray-300
							rounded-md
							shadow-sm
							text-sm
							font-medium
							text-gray-700
							hover:bg-gray-50
							focus:outline-none
							focus:ring-2
							focus:ring-offset-2
							focus:ring-indigo-500
						"
					>
						Cancel
					</button>
					<button
						type="submit"
						class="
							ml-3
							inline-flex
							justify-center
							py-2
							px-4
							border border-transparent
							shadow-sm
							text-sm
							font-medium
							rounded-md
							text-white
							bg-indigo-600
							hover:bg-indigo-700
							focus:outline-none
							focus:ring-2
							focus:ring-offset-2
							focus:ring-indigo-500
						"
					>
						Save
					</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
// import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
	components: {},
	props: {
		canLogin: Boolean,
		canRegister: Boolean,
		laravelVersion: String,
		phpVersion: String,
		param_code: String,
	},
	data() {
		return {
			client_id: "",
			client_secret: "",
			confirm: "",
			redirect: "http://localhost/authenticated",
			code: "",
			access_token: "",
		};
	},
	computed: {
		auth_link() {
			let $state = Math.round(Math.random() * 100000);
			return (
				"https://propertymanager.our.property/api/authorize?" +
				"response_type=code" +
				"&client_id=" +
				this.client_id +
				"&authorize=1" +
				"&redirect_uri=" +
				this.redirect +
				"&state=" +
				$state
			);
		},
	},
	methods: {
		getToken() {
			const instance = this.axios.create({
				baseURL: "https://propertymanager.our.property/api/",
				headers: {
					"Access-Control-Allow-Origin": "*",
					"Access-Control-Allow-Methods": "POST, GET, OPTIONS",
					"Access-Control-Allow-Headers":
						"Content-Type, Authorization, X-Requested-With",
				},
			});

			const link = "token";

			instance
				.post(link, {
					code: this.code,
					client_id: this.client_id,
					client_secret: this.client_secret,
					grant_type: "authorization_code",
				})
				.then((response) => {
					console.log(response);
					this.access_token = response.data.access_token;
					localStorage.access_token = this.access_token;
				})
				.catch((error) => {
					console.log(error);
				});
		},

		// Javascript (client)
		// Using Axios to compose the http request.
		testAuth() {
			let token = this.access_token;
			const instance = this.axios.create({
				baseURL: "https://propertymanager.ourtradie.com.au/api/",
				headers: {
					Authorization: "Bearer " + token,
				},
			});
			const link = "GetAgencyInfo";

			instance
				.get(link)
				.then((response) => {
					console.log(response.data);
				})
				.catch((error) => {
					console.log(error);
				});
		},

		loadCredentials() {
			this.client_id = localStorage.client_id;
			this.client_secret = localStorage.client_secret;
			this.code = localStorage.code;
			console.log("credentials loaded");
		},
		saveCredentials() {
			localStorage.client_id = this.client_id;
			localStorage.client_secret = this.client_secret;
			console.log("credentials saved to local storage");
		},
	},
	mounted() {
		console.log("param_code: " + this.param_code);
		this.loadCredentials();
		// console.log(window.location.href);
		// console.log(window.location.params);

		// console.log("The code is: " + this.code);
		// this.access_token = this.$route.query.code;
		if (this.param_code) {
			localStorage.code = this.param_code;
			this.code = this.param_code;
			console.log("Code updated in local storage.");
		}
	},
};
</script>

