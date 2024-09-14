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
  <AppLayout title="Update Command">
    <template #header>
      <h2 class="text-xl leading-tight text-neutral-800 dark:text-neutral-200">
        Update Command
      </h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <EditCommandForm :command="command" />
      </div>
    </div>
  </AppLayout>
</template>
