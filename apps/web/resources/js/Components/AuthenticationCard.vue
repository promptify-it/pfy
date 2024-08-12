<template>
  <div
    class="flex min-h-screen flex-col items-center bg-neutral-100 pt-6 dark:bg-neutral-950 sm:justify-center sm:pt-0"
  >
    <div>
      <slot name="logo" />
    </div>

    <div
      class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md dark:bg-neutral-900 sm:max-w-md sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>
