<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps<{
  commands: Array;
}>();

const deleteCommand = (command) => {
  router.delete(route('command.destroy', command.id), { preserveScroll: true });
};
</script>

<template>
  <AppLayout title="Commands">
    <template #header>
      <div class="flex justify-between">
        <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
          Commands
        </h2>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-end">
          <Link :href="route('command.create')">
            <PrimaryButton> New Command </PrimaryButton>
          </Link>
        </div>
        <div
          class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg"
        >
          <div class="px-4 py-5 sm:px-6">
            <div class="flex justify-between">
              <div>
                <h3
                  class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200"
                >
                  Commands
                </h3>
                <p
                  class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400"
                >
                  List of available commands
                </p>
              </div>
            </div>
            <div class="mt-5 border-t border-gray-200 dark:border-gray-700">
              <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                <template v-for="command in commands" :key="command.id">
                  <div class="flex w-full justify-between py-4">
                    <div>
                      <dt class="mb-2 font-medium dark:text-gray-400">
                        Signature:
                        <span class="text-blue-500">
                          {{ command.signature }}
                        </span>
                      </dt>

                      <dd
                        class="mb-2 mt-1 text-sm font-medium text-gray-900 dark:text-gray-200 sm:col-span-2"
                      >
                        {{ command.description }}
                      </dd>
                    </div>

                    <div class="flex justify-between gap-4">
                      <div>
                        <Link :href="route('command.edit', command.id)">
                          <PrimaryButton> Edit </PrimaryButton>
                        </Link>
                      </div>

                      <form @submit.prevent="deleteCommand(command)">
                        <PrimaryButton
                          type="submit"
                          class="!hover:bg-red-600 !bg-red-500"
                        >
                          Delete
                        </PrimaryButton>
                      </form>
                    </div>
                  </div>
                </template>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
