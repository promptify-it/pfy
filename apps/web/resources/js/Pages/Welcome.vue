<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { Cursor } from '@/misc/cursors/cursor1';
import { utils } from '@/misc/utils';
import { Dialog, DialogPanel } from '@headlessui/vue';
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const docsLink =
  'https://github.com/promptify-it/pfy/blob/main/apps/web/README.md';

const navigation = [
  { name: 'Github', href: 'https://github.com/promptify-it/pfy' },
  {
    name: 'Docs',
    href: docsLink,
  },
  { name: 'Marketplace', href: route('marketplace') },
];

const mobileMenuOpen = ref(false);

onMounted(() => {
  new Cursor();

  window.addEventListener('load', async () => {
    await utils();
  });

  const cursor = document.querySelector('.tiny-cursor')! as HTMLElement;
  const cursorCircles = document.querySelectorAll('.tiny-cursor > circle');

  document.querySelectorAll('a').forEach((el) => {
    el.addEventListener('mouseenter', () => {
      console.log('hovering');
      cursor.classList.add('hovering');
      // cursorCircles[1].setAttribute('filter', 'url(#distort)');
      cursorCircles.forEach((circle) => {
        circle.setAttribute('r', '30');
      });
    });

    el.addEventListener('mouseleave', () => {
      cursor.classList.remove('hovering');
      // cursorCircles[1].setAttribute('filter', 'none');
      cursorCircles.forEach((circle) => {
        circle.setAttribute('r', '15');
      });
    });
  });
});
</script>

<template>
  <Head title="Welcome" />

  <Teleport to="body">
    <div
      id="cursor-container"
      class="cursor-container pointer-events-none fixed left-0 top-0 z-0"
    ></div>
  </Teleport>

  <div class="home flex min-h-screen flex-col justify-between">
    <header class="inset-x-0 top-0 z-50">
      <nav
        class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8"
        aria-label="Global"
      >
        <div class="flex lg:flex-1">
          <Link href="#" class="-m-1.5 flex items-center gap-x-4 p-1.5">
            <ApplicationLogo class="h-6 w-6" />

            <span
              class="inline-block bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-xl uppercase tracking-wider text-transparent"
            >
              Promptify
            </span>
          </Link>
        </div>
        <div class="flex lg:hidden">
          <button
            type="button"
            class="-m-2.5 inline-flex items-center justify-center p-2.5 text-neutral-700 dark:text-white"
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
            class="text-sm leading-6 text-neutral-900 hover:text-neutral-900 dark:text-neutral-300 dark:hover:text-white"
            >{{ item.name }}</a
          >
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <Link
            v-if="!$page.props.auth?.user?.id"
            :href="route('login')"
            class="text-sm leading-6 text-neutral-900 dark:text-white"
          >
            Log in <span aria-hidden="true">&rarr;</span>
          </Link>

          <Link
            v-else
            :href="route('command.index')"
            class="group text-sm leading-6 text-neutral-900 dark:text-neutral-300 dark:hover:text-white"
          >
            Your Commands
            <span aria-hidden="true">&rarr;</span>
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
          class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 dark:bg-neutral-950 dark:ring-neutral-900/50 sm:max-w-sm sm:ring-1 sm:ring-neutral-900/10"
        >
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Dedecube S.R.L.</span>
              <ApplicationLogo class="h-8 w-8" />
            </a>
            <button
              type="button"
              class="-m-2.5 p-2.5 text-neutral-700 dark:text-white"
              @click="mobileMenuOpen = false"
            >
              <span class="sr-only">Close menu</span>
              <XMarkIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div
              class="-my-6 divide-y divide-neutral-500/10 dark:divide-neutral-500/50"
            >
              <div class="space-y-2 py-6">
                <a
                  v-for="item in navigation"
                  :key="item.name"
                  :href="item.href"
                  class="-mx-3 block px-3 py-2 text-base leading-7 text-neutral-900 hover:bg-neutral-50 dark:text-white dark:hover:bg-neutral-900"
                >
                  {{ item.name }}
                </a>
              </div>
              <div class="py-6">
                <Link
                  :href="route('login')"
                  class="-mx-3 block px-3 py-2.5 text-base leading-7 text-neutral-900 hover:bg-neutral-50 dark:text-white dark:hover:bg-neutral-900"
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
            class="text-4xl tracking-tight text-neutral-900 dark:text-white sm:text-6xl"
          >
            Enhance your cli experience
          </h1>

          <p
            class="mt-6 text-lg leading-8 text-neutral-600 dark:text-neutral-300"
          >
            No more args or options, just ui in your terminal.
          </p>

          <div class="mt-10 flex items-center justify-center gap-x-6">
            <Link
              :href="route('command.index')"
              class="border border-blue-600/20 bg-blue-600 bg-opacity-90 px-6 py-4 text-sm text-neutral-100 backdrop-blur-sm hover:bg-blue-600"
            >
              <span>{{
                $page.props.auth?.user?.id ? 'Your Commands' : 'Get Started'
              }}</span>
            </Link>
          </div>
        </div>
      </div>
    </div>

    <TheFooter />
  </div>
</template>

<style>
.cursor-container {
  --dark: #181825;
  --white: #ffffff;
  --primary: #181825d1;
  --secondary: #1d7fffc6;
  width: 100vw;
  height: calc(var(--vh, 1vh) * 100);
}

.cursor-container g {
  transform-origin: center center;
}

.tiny-cursor circle {
  @apply fill-white/5 opacity-0 duration-200 ease-in-out;
}
</style>
