<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  policy: string;
}>();
</script>

<template>
  <Head title="Privacy Policy" />

  <div class="font-sans text-neutral-900 antialiased dark:text-neutral-100">
    <div class="bg-neutral-100 pt-4 dark:bg-neutral-950">
      <div class="flex min-h-screen flex-col items-center pt-6 sm:pt-0">
        <div>
          <ApplicationLogo class="h-16 w-16" />
        </div>

        <div
          class="prose mt-6 w-full overflow-hidden bg-white p-6  dark:prose-invert dark:bg-neutral-900 sm:max-w-2xl "
        >
          <h1>Privacy Policy for Pfy (formerly Promptify-It)</h1>

          <h2>Introduction</h2>

          <p>
            Pfy ("we," "our," or "us") is committed to protecting your privacy.
            This Privacy Policy outlines how we collect, use, store, and
            safeguard your information when you use our tool, Pfy. By using Pfy,
            you agree to the terms outlined in this policy.
          </p>

          <h2>Information We Collect</h2>

          <h3>1. Personal Information</h3>

          <p>
            When you register and log in to Pfy, we collect basic personal
            information, including but not limited to:
          </p>

          <ul>
            <li>Your name</li>
            <li>Email address</li>
            <li>Username</li>
          </ul>

          <h3>2. Script Data</h3>

          <p>
            Users can insert scripts into Pfy. We collect and store these
            scripts in our database to enable the functionality of the tool.
            This data includes:
          </p>

          <ul>
            <li>Script content that you create or insert</li>
            <li>
              Metadata related to the scripts, such as creation and modification
              dates
            </li>
          </ul>

          <h3>3. Activity Data</h3>

          <p>
            We track various activities within Pfy to enhance user experience
            and for security purposes. The data we collect includes:
          </p>

          <ul>
            <li>
              Events related to the creation, deletion, and usage of scripts
            </li>
            <li>Logs of errors that occur when executing scripts</li>
            <li>Usage patterns and frequency</li>
          </ul>

          <h3>4. Backup Data</h3>

          <p>
            To ensure the security and availability of your scripts and data, we
            perform regular backups. These backups include all the script data
            and activity logs.
          </p>

          <h2>How We Use Your Information</h2>

          <p>We use the collected information to:</p>

          <ul>
            <li>Provide, operate, and maintain Pfy</li>
            <li>Improve, personalize, and expand our services</li>
            <li>
              Communicate with you, either directly or through one of our
              partners, for customer service, updates, and other service-related
              information
            </li>
            <li>
              Monitor and analyze usage patterns and error logs to improve the
              tool's performance
            </li>
            <li>Safeguard the security of your data through regular backups</li>
          </ul>

          <h2>Data Sharing and Disclosure</h2>

          <p>
            We do not sell, trade, or rent your personal information to third
            parties. However, we may share your information in the following
            situations:
          </p>

          <ul>
            <li>
              <strong>With Service Providers:</strong> We may share your data
              with third-party vendors, service providers, or contractors who
              perform services on our behalf.
            </li>
            <li>
              <strong>For Legal Reasons:</strong> We may disclose your
              information if required by law or in response to valid legal
              requests by public authorities.
            </li>
          </ul>

          <h2>Data Security</h2>

          <p>
            We take reasonable measures to protect the security of your
            information. However, no method of transmission over the internet or
            electronic storage is completely secure. While we strive to use
            commercially acceptable means to protect your personal information,
            we cannot guarantee its absolute security.
          </p>

          <h2>Your Rights</h2>

          <p>You have the right to:</p>

          <ul>
            <li>
              Access, update, or delete your personal information stored in Pfy
            </li>
            <li>Request a copy of your stored data</li>
            <li>Opt-out of any communications from us</li>
          </ul>

          <p>
            To exercise these rights, please contact us at [your contact email].
          </p>

          <h2>Changes to This Privacy Policy</h2>

          <p>
            We may update this Privacy Policy from time to time. Any changes
            will be posted on this page with an updated revision date. We
            encourage you to review this policy periodically to stay informed
            about how we are protecting your information.
          </p>

          <h2>Contact Us</h2>

          <p>
            If you have any questions about this Privacy Policy or our data
            practices, please contact us at [your contact email].
          </p>

          <p><strong>Effective Date</strong>: [Insert Date Here]</p>
        </div>
      </div>
    </div>
  </div>
</template>
