<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { useTheme } from '../composables/use-theme';

defineProps<{
  title: string;
}>();

const { toggleTheme, init } = useTheme();

onMounted(() => {
  init();
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team: { id: number; name: string }) => {
  router.put(
    route('current-team.update'),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    },
  );
};

const logout = () => {
  router.post(route('logout'));
};
</script>

<template>
  <div>
    <Head :title="title" />

    <Banner />

    <div class="min-h-screen">
      <nav class="border-b border-neutral-200 dark:border-neutral-900">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">
              <!-- Logo -->
              <div class="flex shrink-0 items-center">
                <Link
                  :href="route('welcome')"
                  class="flex items-center gap-x-4"
                >
                  <ApplicationLogo class="block h-6 w-auto" />

                  <span
                    class="inline-block bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-xl uppercase tracking-wider text-transparent"
                  >
                    Promptify
                  </span>
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink
                  :href="route('command.index')"
                  :active="route().current('command.index')"
                >
                  Commands
                </NavLink>
              </div>

              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink
                  :href="route('command.index')"
                  :active="route().current('marketplace.index')"
                >
                  Marketplace
                </NavLink>
              </div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center">
              <div class="relative ms-3">
                <!-- Teams Dropdown -->
                <Dropdown
                  v-if="$page.props.jetstream.hasTeamFeatures"
                  align="right"
                  width="60"
                >
                  <template #trigger>
                    <span class="inline-flex">
                      <button
                        type="button"
                        class="inline-flex items-center border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-neutral-500 transition duration-150 ease-in-out hover:text-neutral-700 focus:bg-neutral-50 focus:outline-none active:bg-neutral-50 dark:bg-neutral-900 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:active:bg-neutral-700"
                      >
                        {{ $page.props.auth.user.current_team.name }}

                        <svg
                          class="-me-0.5 ms-2 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <div class="w-60">
                      <!-- Team Management -->
                      <div class="block px-4 py-2 text-xs text-neutral-400">
                        Manage Team
                      </div>

                      <!-- Team Settings -->
                      <DropdownLink
                        :href="
                          route(
                            'teams.show',
                            $page.props.auth.user.current_team,
                          )
                        "
                      >
                        Team Settings
                      </DropdownLink>

                      <DropdownLink
                        v-if="$page.props.jetstream.canCreateTeams"
                        :href="route('teams.create')"
                      >
                        Create New Team
                      </DropdownLink>

                      <!-- Team Switcher -->
                      <template
                        v-if="$page.props.auth.user.all_teams.length > 1"
                      >
                        <div
                          class="border-t border-neutral-200 dark:border-neutral-600"
                        />

                        <div class="block px-4 py-2 text-xs text-neutral-400">
                          Switch Teams
                        </div>

                        <template
                          v-for="team in $page.props.auth.user.all_teams"
                          :key="team.id"
                        >
                          <form @submit.prevent="switchToTeam(team)">
                            <DropdownLink as="button">
                              <div class="flex items-center">
                                <svg
                                  v-if="
                                    team.id ==
                                    $page.props.auth.user.current_team_id
                                  "
                                  class="me-2 h-5 w-5 text-green-400"
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                  />
                                </svg>

                                <div>{{ team.name }}</div>
                              </div>
                            </DropdownLink>
                          </form>
                        </template>
                      </template>
                    </div>
                  </template>
                </Dropdown>
              </div>

              <!-- Settings Dropdown -->
              <div class="relative ms-3">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <button
                      v-if="$page.props.jetstream.managesProfilePhotos"
                      class="flex border-2 border-transparent text-sm transition focus:border-neutral-300 focus:outline-none"
                    >
                      <img
                        class="h-8 w-8 object-cover"
                        :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name"
                      />
                    </button>

                    <span v-else class="inline-flex">
                      <button
                        type="button"
                        class="inline-flex items-center border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-neutral-500 transition duration-150 ease-in-out hover:text-neutral-700 focus:bg-neutral-50 focus:outline-none active:bg-neutral-50 dark:bg-neutral-900 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:active:bg-neutral-700"
                      >
                        {{ $page.props.auth.user.name }}

                        <svg
                          class="-me-0.5 ms-2 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-neutral-400">
                      Manage Account
                    </div>

                    <div @click="toggleTheme">
                      <DropdownLink as="button"> Toggle Theme </DropdownLink>
                    </div>

                    <DropdownLink :href="route('profile.show')">
                      Profile
                    </DropdownLink>

                    <DropdownLink
                      v-if="$page.props.jetstream.hasApiFeatures"
                      :href="route('api-tokens.index')"
                    >
                      API Tokens
                    </DropdownLink>

                    <div
                      class="border-t border-neutral-200 dark:border-neutral-800"
                    />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <DropdownLink as="button"> Log Out </DropdownLink>
                    </form>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
              <button
                class="inline-flex items-center justify-center p-2 text-neutral-400 transition duration-150 ease-in-out hover:bg-neutral-100 hover:text-neutral-500 focus:bg-neutral-100 focus:text-neutral-500 focus:outline-none dark:text-neutral-500 dark:hover:bg-neutral-900 dark:hover:text-neutral-400 dark:focus:bg-neutral-900 dark:focus:text-neutral-400"
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="space-y-1 pb-3 pt-2">
            <ResponsiveNavLink
              :href="route('command.index')"
              :active="route().current('command.index')"
            >
              Dashboard
            </ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div
            class="border-t border-neutral-200 pb-1 pt-4 dark:border-neutral-600"
          >
            <div class="flex items-center px-4">
              <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="me-3 shrink-0"
              >
                <img
                  class="w-10ll h-10 object-cover"
                  :src="$page.props.auth.user.profile_photo_url"
                  :alt="$page.props.auth.user.name"
                />
              </div>

              <div>
                <div
                  class="text-base font-medium text-neutral-800 dark:text-neutral-200"
                >
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="text-sm font-medium text-neutral-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink
                :href="route('profile.show')"
                :active="route().current('profile.show')"
              >
                Profile
              </ResponsiveNavLink>

              <ResponsiveNavLink
                v-if="$page.props.jetstream.hasApiFeatures"
                :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')"
              >
                API Tokens
              </ResponsiveNavLink>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <ResponsiveNavLink as="button"> Log Out </ResponsiveNavLink>
              </form>

              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div
                  class="border-t border-neutral-200 dark:border-neutral-600"
                />

                <div class="block px-4 py-2 text-xs text-neutral-400">
                  Manage Team
                </div>

                <!-- Team Settings -->
                <ResponsiveNavLink
                  :href="
                    route('teams.show', $page.props.auth.user.current_team)
                  "
                  :active="route().current('teams.show')"
                >
                  Team Settings
                </ResponsiveNavLink>

                <ResponsiveNavLink
                  v-if="$page.props.jetstream.canCreateTeams"
                  :href="route('teams.create')"
                  :active="route().current('teams.create')"
                >
                  Create New Team
                </ResponsiveNavLink>

                <!-- Team Switcher -->
                <template v-if="$page.props.auth.user.all_teams.length > 1">
                  <div
                    class="border-t border-neutral-200 dark:border-neutral-600"
                  />

                  <div class="block px-4 py-2 text-xs text-neutral-400">
                    Switch Teams
                  </div>

                  <template
                    v-for="team in $page.props.auth.user.all_teams"
                    :key="team.id"
                  >
                    <form @submit.prevent="switchToTeam(team)">
                      <ResponsiveNavLink as="button">
                        <div class="flex items-center">
                          <svg
                            v-if="
                              team.id == $page.props.auth.user.current_team_id
                            "
                            class="me-2 h-5 w-5 text-green-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                          </svg>
                          <div>{{ team.name }}</div>
                        </div>
                      </ResponsiveNavLink>
                    </form>
                  </template>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header
        v-if="$slots.header"
        class="border-b border-neutral-200 bg-white dark:border-neutral-900 dark:bg-neutral-950"
      >
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
