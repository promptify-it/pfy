<template>
  <div class="flex justify-between md:col-span-1">
    <div class="px-4 sm:px-0">
      <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
        <slot name="title" />
      </h3>

      <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
        <slot name="description" />
      </p>
    </div>

    <div class="px-4 sm:px-0">
      <slot name="aside" />
    </div>
  </div>
</template>
