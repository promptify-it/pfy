<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = withDefaults(
  defineProps<{
    active?: boolean;
    href?: string;
    as?: 'button';
  }>(),
  {
    active: false,
    href: undefined,
    as: 'button',
  },
);

const classes = computed(() => {
  return props.active
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-blue-400 dark:border-blue-600 text-start text-base font-medium text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/50 focus:outline-none focus:text-blue-800 dark:focus:text-blue-200 focus:bg-blue-100 dark:focus:bg-blue-900 focus:border-blue-700 dark:focus:border-blue-300 transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-neutral-600 dark:text-neutral-400 hover:text-neutral-800 dark:hover:text-neutral-200 hover:bg-neutral-50 dark:hover:bg-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 focus:outline-none focus:text-neutral-800 dark:focus:text-neutral-200 focus:bg-neutral-50 dark:focus:bg-neutral-700 focus:border-neutral-300 dark:focus:border-neutral-600 transition duration-150 ease-in-out';
});
</script>

<template>
  <div>
    <button v-if="as == 'button'" :class="classes" class="w-full text-start">
      <slot />
    </button>

    <Link v-else :href="href!" :class="classes">
      <slot />
    </Link>
  </div>
</template>
