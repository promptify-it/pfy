<?php

namespace Pfy\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Pfy\Web\Actions\Jetstream\AddTeamMember;
use Pfy\Web\Actions\Jetstream\CreateTeam;
use Pfy\Web\Actions\Jetstream\DeleteTeam;
use Pfy\Web\Actions\Jetstream\DeleteUser;
use Pfy\Web\Actions\Jetstream\InviteTeamMember;
use Pfy\Web\Actions\Jetstream\RemoveTeamMember;
use Pfy\Web\Actions\Jetstream\UpdateTeamName;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
        Jetstream::useTeamModel(\Pfy\Web\Models\Team::class);
        Jetstream::useUserModel(\Pfy\Web\Models\User::class);
        Jetstream::useMembershipModel(\Pfy\Web\Models\Membership::class);
        Jetstream::useTeamInvitationModel(\Pfy\Web\Models\TeamInvitation::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
