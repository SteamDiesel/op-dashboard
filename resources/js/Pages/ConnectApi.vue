<script setup>
import MainLayout from "@/Layouts/Main.vue";
import Primary from "./Buttons/Primary.vue";
</script>

<template>
	<MainLayout title="Connect API">
		<div class="max-w-4xl mx-auto">
			<div class="mb-8">
				<h3 class="text-lg font-bold">Important</h3>
				<p class="mb-4">
					The OPSupport app is created to support multiple teams. A
					user can be a member of different teams as needed.
				</p>
				<p class="mb-4">
					There should be unique API keys for each team that is
					authorised to access the system. Don't refresh the API key
					without knowing 100% that you are authorised to update your
					team account in this system. If you make changes and it
					breaks the connection, it can cause downtime for your team
					while we fix it.
				</p>
				<p class="mb-4">
					If you are unsure, then ask a manager or Jason Law for help
					before attempting to connect or generating new API keys.
				</p>
			</div>
			<div class="mb-8">
				<h3 class="text-lg font-bold">Check credentials</h3>
				<p class="mb-4">
					Ensure that the credentials below match those in your API
					screen in the User API Access API Access screen.
				</p>
				<p class="mb-4">
					If the crednetials don't show up below, go back to the team
					management screen and enter them. ensure you press "Save"
					before pressing the connect button to come back to this
					page.
				</p>
				<div class="mb-4">
					<span class="font-bold">Client ID: </span>
					{{ $attrs.team.client_id }}
				</div>
				<div class="mb-4">
					<span class="font-bold">Client Secret: </span
					>{{ $attrs.team.client_secret }}
				</div>
			</div>

			<div class="mb-8">
				<h3 class="text-lg font-bold">How to connect</h3>
				<p class="mb-4">
					1. After checking that the API details are entered and saved
					in the system correctly, ensure that you are also logged
					into the API account via the 'AutoLogin' link in a
					non-incognito browser tab or window. This will ensure that
					clicking the 'connect' button will take you to the next
					step.
				</p>
				<img src="/images/how_to_connect_01.png" alt="" />
				<img
					src="/images/how_to_connect_02.png"
					title="make sure the redirect uri is correct"
				/>
				<p class="mb-4">
					2. Stay signed into this account where you got the API keys.
				</p>
				<p class="mb-4">
					3. Click the purple connect button at the bottom of this
					page and you should be taken to this screen:
				</p>
				<img
					src="/images/how_to_connect_03.png"
					title="Click Authorize"
				/>
				<p class="mb-4">
					4. Click "Authorize" to connect this team to the API.
				</p>
				<p class="mb-4">
					5. After successfully connecting, the process will deliver
					you back to the Tickets page. This means that the connection
					was a success.
				</p>
			</div>
			<div class="flex w-full justify-end">
				<a :href="$attrs.url"><Primary>Connect</Primary></a>
			</div>
		</div>
	</MainLayout>
</template>
