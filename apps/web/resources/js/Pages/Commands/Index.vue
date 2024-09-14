<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

interface Command {
  id: number;
  signature: string;
  description: string;
}

const props = defineProps<{
  commands: Array<Command>;
}>();

const deleteCommand = (command: Command) => {
  const result = confirm('Are you sure you want to delete this command?');

  if (!result) {
    return;
  }

  router.delete(route('command.destroy', command.id), { preserveScroll: true });
};

const cloneCommand = (command: Command) => {
  router.post(route('command.clone', command.id), { preserveScroll: true });
};
</script>

<template>
  <AppLayout title="Commands">
    <template #header>
      <h2 class="text-xl leading-tight text-neutral-800 dark:text-neutral-200">
        Commands
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-end">
          <Link :href="route('command.create')">
            <PrimaryButton> New Command </PrimaryButton>
          </Link>
        </div>

        <dl class="grid grid-cols-1 gap-y-4">
          <template v-for="command in commands" :key="command.id">
            <Link
              :href="route('command.edit', command.id)"
              class="flex w-full items-center justify-between border border-neutral-200 px-4 py-2 backdrop-blur-lg hover:border-blue-600 dark:border-neutral-800"
            >
              <div>
                <dt class="mb-2 font-medium dark:text-neutral-400">
                  <span class="mr-3 text-green-500">~</span>
                  <span>pfy </span>
                  <span class="text-blue-500">
                    {{ command.signature }}
                  </span>
                </dt>

                <dd
                  v-show="false"
                  class="mb-2 mt-1 text-sm font-medium text-neutral-900 dark:text-neutral-200 sm:col-span-2"
                >
                  <span>{{ command.description }}</span>
                </dd>
              </div>

              <div class="flex justify-end">
                <button
                  class="rounded px-2 py-1 text-xs text-neutral-400 hover:text-blue-500 hover:underline"
                >
                  Edit
                </button>

                <button
                  class="rounded px-2 py-1 text-xs text-neutral-400 hover:text-blue-500 hover:underline"
                  @click.stop.prevent="cloneCommand(command)"
                >
                  Clone
                </button>

                <button
                  class="rounded px-2 py-1 text-xs text-neutral-400 hover:text-red-500 hover:underline"
                  @click.stop.prevent="deleteCommand(command)"
                >
                  Delete
                </button>
              </div>
            </Link>
          </template>
        </dl>
      </div>
    </div>
  </AppLayout>
</template>
