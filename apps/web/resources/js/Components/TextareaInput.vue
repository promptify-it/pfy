<script setup lang="ts">
import { onMounted, ref } from 'vue';

defineProps<{
  modelValue: string;
}>();

defineEmits<{
  (event: 'update:modelValue', value: string): void;
}>();

const textarea = ref<HTMLElement>();

onMounted(() => {
  if (textarea.value?.hasAttribute('autofocus')) {
    textarea.value.focus();
  }
});

defineExpose({ focus: () => textarea.value?.focus() });
</script>

<template>
  <textarea
    ref="textarea"
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
