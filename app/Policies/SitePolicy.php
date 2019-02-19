<?php

namespace App\Policies;

use App\User;
use App\Models\Site;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    public function before($user, $model)
    {
        return isSuperAdmin() ? true : null;
    }

    public function view(User $user, Site $site)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Site $site)
    {
    }

    public function delete(User $user, Site $site)
    {
        return $user['id'] == $site['user_id'] || isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the site.
     *
     * @param  \App\User $user
     * @param  \App\Models\Site $site
     * @return mixed
     */
    public function restore(User $user, Site $site)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the site.
     *
     * @param  \App\User $user
     * @param  \App\Models\Site $site
     * @return mixed
     */
    public function forceDelete(User $user, Site $site)
    {
        //
    }
}