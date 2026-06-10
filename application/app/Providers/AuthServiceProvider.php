<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
  protected $policies = [
    Role::class => RolePolicy::class,
    User::class => \App\Policies\UserPolicy::class,

  ];

  public function boot()
  {
    $this->registerPolicies();

    // Optional: biar admin auto lolos semua policy
    Gate::before(function ($user, $ability) {
      return $user->hasRole('admin') ? true : null;
    });
  }
}
