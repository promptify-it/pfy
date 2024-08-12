<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = withDefaults(
  defineProps<{
    href?: string;
    as?: 'button' | 'a';
  }>(),
  {
    href: undefined,
    as: undefined,
  },
);
</script>

<template>
  <div>
    <button
      v-if="as == 'button'"
      type="submit"
      class="block w-full px-4 py-2 text-start text-sm leading-5 text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-100 focus:bg-neutral-100 focus:outline-none dark:text-neutral-300 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
    >
      <slot />
    </button>

    <a
      v-else-if="as == 'a'"
      :href="href"
      class="block px-4 py-2 text-sm leading-5 text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-100 focus:bg-neutral-100 focus:outline-none dark:text-neutral-300 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
    >
      <slot />
    </a>

    <Link
      v-else
      :href="href!"
      class="block px-4 py-2 text-sm leading-5 text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-100 focus:bg-neutral-100 focus:outline-none dark:text-neutral-300 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
    >
      <slot />
    </Link>
  </div>
</template>
