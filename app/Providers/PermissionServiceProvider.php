<?php

namespace App\Providers;

use App\Models\User\Permission;
use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * Create a guard for each permission
     * @return void
     */
    public function boot()
    {
        try {
            /**
             * The map method iterates through the collection and passes each value to the given callback.
             *  The callback is free to modify the item and return it,
             *  thus forming a new collection of modified items.
             */
            Permission::get()->map(function ($permission) {
                /**
                 * Gates are simply closures that determine if a user is authorized to perform a given action.
                 * Typically, gates are defined within the boot method of the
                 * App\Providers\AuthServiceProvider class using the Gate facade.
                 * Gates always receive a user instance as their first argument and
                 * may optionally receive additional arguments such as a relevant Eloquent model.
                 * In this example, we'll define a gate to determine if a user has permission to perform the action.
                 * The gate will accomplish this by comparing the user's id against the user_id of the user
                 * that created the record
                 */
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (Exception $e) {
            report($e);
            return false;
        }


        // Custom directive for check if user has the role ?
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole($role)): ?>";
        });

        Blade::directive('else', function ($role) {
            return "<?php else: ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
