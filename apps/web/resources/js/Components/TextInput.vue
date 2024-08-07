<script setup lang="ts">
import { onMounted, ref } from 'vue';

defineProps<{
  modelValue: string;
}>();

defineEmits<{
  (event: 'update:modelValue', value: string): void;
}>();

const input = ref<HTMLElement>();

onMounted(() => {
  if (input.value?.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
  <input
    ref="input"
    class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-600 dark:focus:ring-blue-600"
    :value="modelValue"
    @input="
      $emit(
        'update:modelValue',
        ($event.target as unknown as HTMLInputElement).value,
      )
    "
  />
</template>
