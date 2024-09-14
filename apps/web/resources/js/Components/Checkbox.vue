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
    class="border-neutral-300 text-blue-600  focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-950 dark:focus:ring-blue-600 dark:focus:ring-offset-neutral-800"
  />
</template>
