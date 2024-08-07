<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import EditCommandForm from './Partials/EditCommandForm.vue';

const props = defineProps<{
  command: {
    id: number;
    definition: string;
  };
}>();
</script>

<template>
  <AppLayout title="Create Command">
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
      >
        Edit Command
      </h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <EditCommandForm :command="command" />
      </div>
    </div>
  </AppLayout>
</template>
