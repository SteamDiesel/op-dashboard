
<template>
	<div class="flow-root">
		<ul role="list" class="-mb-8">
			<li
				v-for="(activityItem, activityItemIdx) in activity"
				:key="activityItem.id"
			>
				<div class="relative pb-8">
					<span
						v-if="activityItemIdx !== activity.length - 1"
						class="
							absolute
							top-5
							left-5
							-ml-px
							h-full
							w-0.5
							bg-gray-200
						"
						aria-hidden="true"
					/>
					<div class="relative flex items-start space-x-3">
						<!-- Create -->
						<template v-if="activityItem.type === 'create'">
							<div class="relative">
								<img
									class="
										h-10
										w-10
										rounded-full
										bg-gray-400
										flex
										items-center
										justify-center
										ring-8 ring-white
									"
									:src="activityItem.user.profile_photo_url"
									alt=""
								/>

								<span
									class="
										absolute
										-bottom-0.5
										-right-1
										bg-white
										rounded-tl
										px-0.5
										py-px
									"
								>
									<SparklesIcon
										class="h-5 w-5 text-gray-400"
										aria-hidden="true"
									/>
								</span>
							</div>
							<div class="min-w-0 flex-1">
								<div>
									<div class="text-sm">
										<a class="font-medium text-gray-900">{{
											activityItem.user.name
										}}</a>
									</div>
									<p
										class="mt-0.5 text-sm text-gray-500"
										:title="
											activityItem.details +
											' ' +
											timeStamp(activityItem.created_at)
										"
									>
										Created this ticket
										{{
											timeForHumans(
												activityItem.created_at
											)
										}}
									</p>
								</div>
							</div>
						</template>
						<!-- Comment -->
						<template v-else-if="activityItem.type === 'comment'">
							<div class="relative">
								<img
									class="
										h-10
										w-10
										rounded-full
										bg-gray-400
										flex
										items-center
										justify-center
										ring-8 ring-white
									"
									:src="activityItem.user.profile_photo_url"
									alt=""
								/>

								<span
									class="
										absolute
										-bottom-0.5
										-right-1
										bg-white
										rounded-tl
										px-0.5
										py-px
									"
								>
									<ChatAltIcon
										class="h-5 w-5 text-gray-400"
										aria-hidden="true"
									/>
								</span>
							</div>
							<div class="min-w-0 flex-1">
								<div>
									<div class="text-sm">
										<a class="font-medium text-gray-900">{{
											activityItem.user.name
										}}</a>
									</div>
									<p
										class="mt-0.5 text-sm text-gray-500"
										:title="
											timeStamp(activityItem.created_at)
										"
									>
										Commented
										{{
											timeForHumans(
												activityItem.created_at
											)
										}}
									</p>
								</div>
								<div class="mt-2 text-sm text-gray-700">
									<p>
										{{ activityItem.details }}
									</p>
								</div>
							</div>
						</template>
						<!-- Close -->
						<template v-else-if="activityItem.type === 'close'">
							<div>
								<div class="relative px-1">
									<div
										class="
											h-8
											w-8
											bg-gray-100
											rounded-full
											ring-8 ring-white
											flex
											items-center
											justify-center
										"
									>
										<CheckIcon
											class="h-5 w-5 text-gray-500"
											aria-hidden="true"
										/>
									</div>
								</div>
							</div>
							<div class="min-w-0 flex-1 py-1.5">
								<div class="text-sm text-gray-500">
									<p
										class="mt-0.5 text-sm text-gray-500"
										:title="
											activityItem.details +
											' ' +
											timeStamp(activityItem.created_at)
										"
									>
										{{ activityItem.user.name }}
										{{ activityItem.details }}

										{{
											timeForHumans(
												activityItem.created_at
											)
										}}
									</p>
								</div>
							</div>
						</template>
						<!-- Open -->
						<template v-else-if="activityItem.type === 'open'">
							<div>
								<div class="relative px-1">
									<div
										class="
											h-8
											w-8
											bg-gray-100
											rounded-full
											ring-8 ring-white
											flex
											items-center
											justify-center
										"
									>
										<InboxInIcon
											class="h-5 w-5 text-gray-500"
											aria-hidden="true"
										/>
									</div>
								</div>
							</div>
							<div class="min-w-0 flex-1 py-1.5">
								<div class="text-sm text-gray-500">
									<p
										class="mt-0.5 text-sm text-gray-500"
										:title="
											activityItem.details +
											' ' +
											timeStamp(activityItem.created_at)
										"
									>
										{{ activityItem.user.name }}
										{{ activityItem.details }}

										{{
											timeForHumans(
												activityItem.created_at
											)
										}}
									</p>
								</div>
							</div>
						</template>
						<!-- Assignment -->
						<template v-else-if="activityItem.type === 'reassign'">
							<div>
								<div class="relative px-1">
									<div
										class="
											h-8
											w-8
											bg-gray-100
											rounded-full
											ring-8 ring-white
											flex
											items-center
											justify-center
										"
									>
										<UserCircleIcon
											class="h-5 w-5 text-gray-500"
											aria-hidden="true"
										/>
									</div>
								</div>
							</div>
							<div class="min-w-0 flex-1 py-1.5">
								<div class="text-sm text-gray-500">
									<p
										class="mt-0.5 text-sm text-gray-500"
										:title="
											activityItem.details +
											' ' +
											timeStamp(activityItem.created_at)
										"
									>
										{{ activityItem.user.name }}
										{{ activityItem.details }}

										{{
											timeForHumans(
												activityItem.created_at
											)
										}}
									</p>
								</div>
							</div>
						</template>
					</div>
				</div>
			</li>
		</ul>
	</div>
</template>
<script setup>
import {
	ChatAltIcon,
	TagIcon,
	UserCircleIcon,
	SparklesIcon,
	CheckIcon,
	InboxInIcon,
} from "@heroicons/vue/solid";
</script>

<script>
import { timeStamp, timeForHumans } from "../../Helpers.js";

export default {
	props: {
		activity: Array,
	},
	methods: {
		timeStamp,
		timeForHumans,
	},
};
</script>

