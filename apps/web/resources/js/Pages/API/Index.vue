<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue';

defineProps<{
  tokens: {
    id: number;
    name: string;
    last_used_ago: string;
    last_used_ip: string;
    abilities: {
      id: number;
      name: string;
    }[];
  }[];
  availablePermissions: {
    id: number;
    name: string;
  }[];
  defaultPermissions: {
    id: number;
    name: string;
  }[];
}>();
</script>

<template>
  <AppLayout title="API Tokens">
    <template #header>
      <h2 class="text-xl leading-tight text-neutral-800 dark:text-neutral-200">
        API Tokens
      </h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <ApiTokenManager
          :tokens="tokens"
          :available-permissions="availablePermissions"
          :default-permissions="defaultPermissions"
        />
      </div>
    </div>
  </AppLayout>
</template>
