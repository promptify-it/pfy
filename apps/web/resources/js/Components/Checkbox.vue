<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
  checked: boolean;
  value?: string;
}>();

const emit = defineEmits<{
  (event: 'update:checked', value: boolean): void;
}>();

const proxyChecked = computed({
  get() {
    return props.checked;
  },

  set(val) {
    emit('update:checked', val);
  },
});
</script>

<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
  />
</template>
