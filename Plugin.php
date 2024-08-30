<?php

namespace Brutalhost\YandexSmartCaptcha;

use Backend;
use Backend\Models\UserRole;
use Brutalhost\YandexSmartCaptcha\Models\Settings;
use System\Classes\PluginBase;
use Winter\Storm\Support\Facades\Config;

/**
 * yandex-smartcaptcha Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'Yandex SmartCaptcha',
            'description' => 'Yandex SmartCaptcha components and validation rule',
            'author'      => 'brutalhost',
            'icon'        => 'icon-shield'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {
        Config::set('yandexsmartcaptcha.client_key', Settings::get('client_key'));
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents()
    {
        return [
            'Brutalhost\YandexSmartCaptcha\Components\YandexSmartCaptcha' => 'yandexSmartCaptcha',
        ];
    }


    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'brutalhost.yandexsmartcaptcha.manage_settings' => [
                'label' => 'Manage Yandex Smartcaptcha settings',
                'tab'   => 'Yandex Smartcaptcha',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Yandex SmartCaptcha Settings',
                'description' => 'Manage API keys for Yandex Smartcaptcha.',
//                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-shield',
                'class'       => 'Brutalhost\YandexSmartCaptcha\Models\Settings',
                'order'       => 1000,
                'keywords'    => 'yandex smartcaptcha api keys settings',
                'permissions' => ['brutalhost.yandexsmartcaptcha.manage_settings']
            ]
        ];
    }

}
