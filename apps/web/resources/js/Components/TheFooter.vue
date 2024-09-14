<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <footer>
    <div
      class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8"
    >
      <div class="flex justify-center space-x-6 md:order-2">
        <Link
          :href="route('policy.show')"
          class="text-neutral-400 hover:text-neutral-500 dark:text-neutral-500 dark:hover:text-neutral-100"
        >
          Privacy Policy
        </Link>

        <Link
          :href="route('terms.show')"
          class="text-neutral-400 hover:text-neutral-500 dark:text-neutral-500 dark:hover:text-neutral-100"
        >
          Terms of Service
        </Link>

        <a
          href="https://github.com/promptify-it/pfy"
          class="text-neutral-400 hover:text-neutral-500 dark:text-neutral-500 dark:hover:text-neutral-100"
          target="_blank"
        >
          <svg
            class="fill-text-neutral-400 h-6 w-6 hover:fill-neutral-500 dark:fill-neutral-500 dark:hover:fill-neutral-100"
            viewBox="0 0 24 24"
          >
            <path
              fill-rule="evenodd"
              d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.11.82-.26.82-.58 0-.29-.01-1.05-.015-2.05-3.338.72-4.042-1.61-4.042-1.61-.546-1.38-1.333-1.75-1.333-1.75-1.09-.74.083-.73.083-.73 1.205.085 1.838 1.235 1.838 1.235 1.07 1.84 2.805 1.31 3.495 1 .108-.775.42-1.31.76-1.61-2.665-.3-5.466-1.34-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.31-.54-1.53.105-3.18 0 0 1.005-.32 3.3 1.23.96-.27 1.98-.41 3-.41 1.02 0 2.04.14 3 .41 2.28-1.55 3.285-1.23 3.285-1.23.645 1.65.24 2.87.12 3.18.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.37.81 1.1.81 2.22 0 1.61-.015 2.91-.015 3.31 0 .32.21.7.825.58C20.565 21.795 24 17.3 24 12c0-6.63-5.37-12-12-12"
            />
          </svg>
        </a>
      </div>

      <div class="mt-8 md:order-1 md:mt-0">
        <p class="text-center text-xs leading-5 text-neutral-500">
          &copy; 2024 Dedecube S.R.L. All rights reserved.
        </p>
      </div>
    </div>
  </footer>
</template>
