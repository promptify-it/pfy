<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    type: 'button' | 'submit' | 'reset';
  }>(),
  {
    type: 'button',
  },
);
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center border border-neutral-300 bg-white px-4 py-2 text-xs uppercase tracking-widest text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 dark:border-neutral-500 dark:bg-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:ring-offset-neutral-800"
  >
    <slot />
  </button>
</template>
