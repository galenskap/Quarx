<?php

namespace Yab\Quarx\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Yab\Quarx\Services\ModuleService;

class QuarxModuleProvider extends ServiceProvider
{
    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $modulePath = base_path(Config::get('quarx.module-directory').'/');
        $modules = glob($modulePath.'*');

        foreach ($modules as $module) {
            if (is_dir($module)) {
                $module = lcfirst(str_replace($modulePath, '', $module));
                $this->app->register('\Quarx\Modules\\'. ucfirst($module) . '\\' . ucfirst($module) . 'ModuleProvider');
            }
        }
    }
}
