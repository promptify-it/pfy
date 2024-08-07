<script setup lang="ts">
import { Dialog, DialogPanel } from '@headlessui/vue';
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
// import Features from './WelcomePartials/Features.vue'
// import Faqs from './WelcomePartials/Faqs.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import TheFooter from '@/Components/TheFooter.vue';

const navigation = [
  { name: 'Github', href: '#' },
  { name: 'Docs', href: '#' },
  { name: 'Contact', href: '#' },
];
const mobileMenuOpen = ref(false);
</script>

<template>
  <Head title="Welcome" />

  <div
    class="flex min-h-screen flex-col justify-between bg-white dark:bg-gray-900"
  >
    <header class="inset-x-0 top-0 z-50">
      <nav
        class="flex items-center justify-between p-6 lg:px-8"
        aria-label="Global"
      >
        <div class="flex lg:flex-1">
          <a href="#" class="-m-1.5 p-1.5">
            <ApplicationLogo class="h-8 w-8" />
          </a>
        </div>
        <div class="flex lg:hidden">
          <button
            type="button"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-white"
            @click="mobileMenuOpen = true"
          >
            <span class="sr-only">Open main menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
          <a
            v-for="item in navigation"
            :key="item.name"
            :href="item.href"
            class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-900 dark:text-white dark:hover:text-white"
            >{{ item.name }}</a
          >
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <Link
            v-if="!$page.props.auth?.user?.id"
            :href="route('login')"
            class="text-sm font-semibold leading-6 text-gray-900 dark:text-white"
          >
            Log in <span aria-hidden="true">&rarr;</span>
          </Link>

          <Link
            v-else
            :href="route('command.index')"
            class="text-sm font-semibold leading-6 text-gray-900 dark:text-white"
          >
            Dashboard <span aria-hidden="true">&rarr;</span>
          </Link>
        </div>
      </nav>

      <Dialog
        class="lg:hidden"
        :open="mobileMenuOpen"
        @close="mobileMenuOpen = false"
      >
        <div class="fixed inset-0 z-50" />
        <DialogPanel
          class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 dark:bg-gray-900 dark:ring-gray-900/50 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
        >
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <ApplicationLogo class="h-8 w-8" />
            </a>
            <button
              type="button"
              class="-m-2.5 rounded-md p-2.5 text-gray-700 dark:text-white"
              @click="mobileMenuOpen = false"
            >
              <span class="sr-only">Close menu</span>
              <XMarkIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div
              class="-my-6 divide-y divide-gray-500/10 dark:divide-gray-500/50"
            >
              <div class="space-y-2 py-6">
                <a
                  v-for="item in navigation"
                  :key="item.name"
                  :href="item.href"
                  class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-800"
                  >{{ item.name }}</a
                >
              </div>
              <div class="py-6">
                <Link
                  :href="route('login')"
                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-800"
                >
                  Log in
                </Link>
              </div>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </header>

    <div class="relative isolate flex-1 px-6 pt-14 lg:px-8">
      <div class="mx-auto max-w-3xl py-32 sm:py-48 lg:py-56">
        <div class="text-center">
          <h1
            class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl"
          >
            More prompts, less prompt
          </h1>

          <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
            Run commands defined by you or community directly into your console
          </p>

          <div class="mt-10 flex items-center justify-center gap-x-6">
            <Link
              :href="
                $page.props.auth?.user?.id
                  ? route('command.index')
                  : route('register')
              "
              class="rounded-full bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
            >
              {{ $page.props.auth?.user?.id ? 'Dashboard' : 'Get Started' }}
            </Link>
          </div>
        </div>
      </div>
    </div>

    <TheFooter />
  </div>
</template>
