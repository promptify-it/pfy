<script setup lang="ts">
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Link from '@/Components/Link.vue';
import { useInertia } from '@inertiajs/inertia-vue3';
import markdownit from 'markdown-it';

const props = defineProps<{
  content: string;
}>();

const md = markdownit();

const markdownToProse = computed(() => {
  return md.render(props.content);
});
</script>

<template>
  <AppLayout title="Docs">
    <template #header>
      <div class="flex justify-between">
        <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
          Documentation
        </h2>
      </div>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <div
          class="prose !w-full !max-w-none dark:prose-invert"
          v-html="markdownToProse"
        ></div>
      </div>
    </div>
  </AppLayout>
</template>
