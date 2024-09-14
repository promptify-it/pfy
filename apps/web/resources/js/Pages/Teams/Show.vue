<script setup lang="ts">
import SectionBorder from '@/Components/SectionBorder.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Team } from '@/types';
import DeleteTeamForm from './Partials/DeleteTeamForm.vue';
import TeamMemberManager from './Partials/TeamMemberManager.vue';
import UpdateTeamNameForm from './Partials/UpdateTeamNameForm.vue';

const props = defineProps<{
  team: Team;
  availableRoles: {
    key: string;
    name: string;
    description: string;
    permissions: string[];
  }[];
  permissions: {
    canAddTeamMembers: boolean;
    canDeleteTeam: boolean;
    canRemoveTeamMembers: boolean;
    canUpdateTeam: boolean;
  };
}>();
</script>

<template>
  <AppLayout title="Team Settings">
    <template #header>
      <h2 class="text-xl leading-tight text-neutral-800 dark:text-neutral-200">
        Team Settings
      </h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <UpdateTeamNameForm :team="team" :permissions="permissions" />

        <TeamMemberManager
          class="mt-10 sm:mt-0"
          :team="team"
          :available-roles="availableRoles"
          :user-permissions="permissions"
        />

        <template v-if="permissions.canDeleteTeam && !team.personal_team">
          <SectionBorder />

          <DeleteTeamForm class="mt-10 sm:mt-0" :team="team" />
        </template>
      </div>
    </div>
  </AppLayout>
</template>
