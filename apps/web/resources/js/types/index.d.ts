import { Config } from 'ziggy-js';
import { Team } from './index.d';

export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string;
  current_team: Team;
  current_team_id: number;
  all_teams: Team[];
  profile_photo_url: string;
  profile_photo_path?: string;
  two_factor_confirmed_at?: string;
}

export type Team = {
  id: number;
  user_id: number;
  name: string;
  personal_team: boolean;
  created_at: string;
  updated_at: string;
  owner: User;
  users: User[];
  team_invitations: {
    id: number;
    team_id: number;
    email: string;
    role: string;
    created_at: string;
    updated_at: string;
  }[];
};

export type Token = {
  id: number;
  name: string;
  last_used_ago: string;
  last_used_ip: string;
  abilities: {
    id: number;
    name: string;
  }[];
};

export type PageProps<
  T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
  auth: {
    user: User;
  };
  jetstream: {
    managesProfilePhotos: boolean;
    canCreateTeams: boolean;
    canManageTwoFactorAuthentication: boolean;
    canUpdatePassword: boolean;
    flash: {
      banner: string;
      bannerStyle: string;
    };
    hasAccountDeletionFeatures: boolean;
    hasApiFeatures: boolean;
    hasBillingFeatures: boolean;
    hasProfileFeatures: boolean;
    hasTeamFeatures: boolean;
    hasTermsAndPrivacyPolicyFeature: boolean;
    name: string;
    profile: {
      jetstreamProfile: boolean;
      photoUrl: string;
      username: string;
    };
    teams: {
      id: number;
      name: string;
      personal_team: boolean;
    }[];
  };
  ziggy: Config & { location: string };
};
