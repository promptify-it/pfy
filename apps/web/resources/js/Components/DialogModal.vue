<script setup lang="ts">
import Modal from './Modal.vue';

const props = withDefaults(
  defineProps<{
    show: boolean;
    maxWidth: string;
    closeable: boolean;
  }>(),
  {
    show: false,
    maxWidth: '2xl',
    closeable: true,
  },
);

const emit = defineEmits<{
  (event: 'close'): void;
}>();

const close = () => {
  emit('close');
};
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="px-6 py-4">
      <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
        <slot name="title" />
      </div>

      <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
        <slot name="content" />
      </div>
    </div>

    <div
      class="flex flex-row justify-end bg-gray-100 px-6 py-4 text-end dark:bg-gray-800"
    >
      <slot name="footer" />
    </div>
  </Modal>
</template>
