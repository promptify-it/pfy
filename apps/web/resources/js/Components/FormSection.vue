<script setup lang="ts">
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

const emit = defineEmits<{
  (event: 'submitted'): void;
}>();

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <SectionTitle>
      <template #title>
        <slot name="title" />
      </template>
      <template #description>
        <slot name="description" />
      </template>
    </SectionTitle>

    <div class="mt-5 md:col-span-2 md:mt-0">
      <form @submit.prevent="$emit('submitted')">
        <div class="bg-white px-4 py-5 dark:bg-neutral-900 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <slot name="form" />
          </div>
        </div>

        <div
          v-if="hasActions"
          class="flex items-center justify-end bg-neutral-50 px-4 py-3 text-end dark:bg-neutral-900 sm:px-6"
        >
          <slot name="actions" />
        </div>
      </form>
    </div>
  </div>
</template>
