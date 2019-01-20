<?php

namespace App\Providers;

use App\Models\Messages;
use App\Repositories\MessRepository;
use DateTime;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('adminAction', function ($user) {
            return $user->isAdmin;
        });

        Gate::define('makeMess', function ($user) {
            $messRepository = new MessRepository(new Messages());
            $latestMess = $messRepository->getLatestUserMess($user->id);
            if($latestMess != null){
                $dateTimestamp1 = new DateTime($latestMess->created_at);
                $now = new DateTime();
                $canMakeMess = $dateTimestamp1->diff($now)->days >= 1 ? true : false;
                return $canMakeMess;
            }
            else 
                return true;
        });
    }
}
