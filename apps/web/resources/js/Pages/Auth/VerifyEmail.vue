<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  status: string;
}>();

const form = useForm({});

const submit = () => {
  form.post(route('verification.send'));
};

const verificationLinkSent = computed(
  () => props.status === 'verification-link-sent',
);
</script>

<template>
  <Head title="Email Verification" />

  <AuthenticationCard>
    <template #logo>
      <ApplicationLogo class="h-16 w-16" />
    </template>

    <div class="mb-4 text-sm text-neutral-600 dark:text-neutral-400">
      Before continuing, could you verify your email address by clicking on the
      link we just emailed to you? If you didn't receive the email, we will
      gladly send you another.
    </div>

    <div
      v-if="verificationLinkSent"
      class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
    >
      A new verification link has been sent to the email address you provided in
      your profile settings.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Resend Verification Email
        </PrimaryButton>

        <div>
          <Link
            :href="route('profile.show')"
            class=" text-sm text-neutral-600 underline hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-neutral-400 dark:hover:text-neutral-100 dark:focus:ring-offset-neutral-800"
          >
            Edit Profile</Link
          >

          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="ms-2 text-sm text-neutral-600 underline hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-neutral-400 dark:hover:text-neutral-100 dark:focus:ring-offset-neutral-800"
          >
            Log Out
          </Link>
        </div>
      </div>
    </form>
  </AuthenticationCard>
</template>
