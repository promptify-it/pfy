<script setup lang="ts">
defineProps<{
  value: string;
}>();
</script>

<template>
  <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
    <span v-if="value">{{ value }}</span>
    <span v-else><slot /></span>
  </label>
</template>
