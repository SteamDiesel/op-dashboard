<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

const props = defineProps({
	team: Object,
	permissions: Object,
});

const form = useForm({
	name: props.team.name,
	client_id: props.team.client_id,
	client_secret: props.team.client_secret,
});

const updateTeamName = () => {
	form.put(route("teams.update", props.team), {
		errorBag: "updateTeamName",
		preserveScroll: true,
	});
};
</script>
<script>
export default {
	computed: {
		auth_link() {
			let $state = Math.round(Math.random() * 100000);

			let $link =
				"https://propertymanager.our.property/api/authorize?" +
				"response_type=code" +
				"&client_id=" +
				this.team.client_id +
				"&authorize=1" +
				"&redirect_uri=" +
				"http://localhost/authenticated" +
				"&state=" +
				$state;

			return $link;
		},
	},
};
</script>

<template>
	<JetFormSection @submitted="updateTeamName">
		<template #title> Team Name </template>

		<template #description>
			The team's name and owner information.
		</template>

		<template #form>
			<!-- Team Owner Information -->
			<div class="col-span-6">
				<JetLabel value="Team Owner" />

				<div class="flex items-center mt-2">
					<img
						class="w-12 h-12 rounded-full object-cover"
						:src="team.owner.profile_photo_url"
						:alt="team.owner.name"
					/>

					<div class="ml-4 leading-tight">
						<div>{{ team.owner.name }}</div>
						<div class="text-gray-700 text-sm">
							{{ team.owner.email }}
						</div>
					</div>
				</div>
			</div>

			<!-- Team Name -->
			<div class="col-span-6 sm:col-span-4">
				<JetLabel for="name" value="Team Name" />

				<JetInput
					id="name"
					v-model="form.name"
					type="text"
					class="mt-1 block w-full"
					:disabled="!permissions.canUpdateTeam"
				/>

				<JetInputError :message="form.errors.name" class="mt-2" />
			</div>

			<!-- Team Client ID -->
			<div class="col-span-6 sm:col-span-4">
				<JetLabel for="client_id" value="Client ID" />

				<JetInput
					id="client_id"
					v-model="form.client_id"
					type="text"
					class="mt-1 block w-full"
					:disabled="!permissions.canUpdateTeam"
				/>

				<JetInputError :message="form.errors.client_id" class="mt-2" />
			</div>
			<!-- Team Client SXecxret -->
			<div class="col-span-6 sm:col-span-4">
				<JetLabel for="client_secret" value="Client Secret" />

				<JetInput
					id="client_secret"
					v-model="form.client_secret"
					type="text"
					class="mt-1 block w-full"
					:disabled="!permissions.canUpdateTeam"
				/>

				<JetInputError
					:message="form.errors.client_secret"
					class="mt-2"
				/>
			</div>
			<!-- Team Authenticate with server Status -->
			<div class="col-span-6 sm:col-span-4">
				<div>
					<a :href="auth_link">
						<div
							class="
								inline-flex
								items-center
								px-4
								py-2
								bg-gray-800
								border border-transparent
								rounded-md
								font-semibold
								text-xs text-white
								uppercase
								tracking-widest
								hover:bg-gray-700
								active:bg-gray-900
								focus:outline-none
								focus:border-gray-900
								focus:ring
								focus:ring-gray-300
								disabled:opacity-25
								transition
							"
						>
							Connect
						</div>
					</a>
				</div>
			</div>
		</template>

		<template v-if="permissions.canUpdateTeam" #actions>
			<JetActionMessage :on="form.recentlySuccessful" class="mr-3">
				Saved.
			</JetActionMessage>

			<JetButton
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				Save
			</JetButton>
		</template>
	</JetFormSection>
</template>
