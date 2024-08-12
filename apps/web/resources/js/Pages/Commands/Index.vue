<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps<{
  commands: Array;
}>();

const deleteCommand = (command) => {
    const result = confirm('Are you sure you want to delete this command?');

    if (!result) {
        return;
    }

    router.delete(route('command.destroy', command.id), { preserveScroll: true });
};
</script>

<template>
  <AppLayout title="Commands">
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-end">
          <Link :href="route('command.create')">
            <PrimaryButton> New Command </PrimaryButton>
          </Link>
        </div>
        <div
          class="overflow-hidden bg-white shadow-xl dark:bg-neutral-900 sm:rounded-lg"
        >
          <div class="px-4 py-5 sm:px-6">
            <div>
              <dl class="divide-y divide-neutral-200 dark:divide-neutral-700">
                <template v-for="command in commands" :key="command.id">
                  <div class="flex w-full justify-between py-4">
                    <div>
                      <dt class="mb-2 font-medium dark:text-neutral-400">
                        Name:
                        <span class="text-blue-500">
                          {{ command.signature }}
                        </span>
                      </dt>

                      <dd
                        class="mb-2 mt-1 text-sm font-medium text-neutral-900 dark:text-neutral-200 sm:col-span-2"
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
