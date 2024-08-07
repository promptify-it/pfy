<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateCommandForm from '@/Pages/Commands/Partials/CreateCommandForm.vue';
</script>

<template>
  <AppLayout title="Create Command">
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
      >
        Create Command
      </h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <CreateCommandForm />
      </div>
    </div>
  </AppLayout>
</template>
