<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    type?: 'button' | 'submit' | 'reset';
  }>(),
  {
    type: 'submit',
  },
);
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center border border-transparent bg-neutral-900 px-4 py-2 text-sm text-white transition duration-150 ease-in-out hover:bg-neutral-700 focus:bg-neutral-700 focus:outline-none focus:ring-2 dark:bg-blue-600 dark:hover:bg-blue-500"
  >
    <slot />
  </button>
</template>
