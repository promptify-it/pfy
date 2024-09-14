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
    <div class="bg-white px-4 pb-4 pt-5 dark:bg-neutral-900 sm:p-6 sm:pb-4">
      <div class="sm:flex sm:items-start">
        <div
          class="justify-centerll mx-auto flex h-12 w-12 shrink-0 items-center bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
        >
          <svg
            class="h-6 w-6 text-red-600 dark:text-red-400"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
            />
          </svg>
        </div>

        <div class="mt-3 text-center sm:ms-4 sm:mt-0 sm:text-start">
          <h3
            class="text-lg font-medium text-neutral-900 dark:text-neutral-100"
          >
            <slot name="title" />
          </h3>

          <div class="mt-4 text-sm text-neutral-600 dark:text-neutral-400">
            <slot name="content" />
          </div>
        </div>
      </div>
    </div>

    <div
      class="flex flex-row justify-end bg-neutral-100 px-6 py-4 text-end dark:bg-neutral-900"
    >
      <slot name="footer" />
    </div>
  </Modal>
</template>
