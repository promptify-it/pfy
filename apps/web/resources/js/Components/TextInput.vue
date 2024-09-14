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
    class="border-neutral-300 focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-950 dark:text-neutral-300 dark:focus:border-blue-600 dark:focus:ring-blue-600"
    :value="modelValue"
    @input="
      $emit(
        'update:modelValue',
        ($event.target as unknown as HTMLInputElement).value,
      )
    "
  />
</template>
