<?php namespace Brutalhost\YandexSmartcaptcha\Components;

use Cms\Classes\ComponentBase;
use Brutalhost\YandexSmartcaptcha\Models\Settings;

class YandexSmartCaptcha extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Yandex SmartCaptcha Component',
            'description' => 'Renders Yandex SmartCaptcha using plugin settings.',
//            'render' => 'default.htm' // Specifies the default template
        ];
    }

    public function defineProperties()
    {
        return [
            'callbackFunction' => [
                'title' => 'Callback Function',
                'description' => 'Enter the name of the JavaScript function to be called',
                'default' => '',
                'type' => 'string'
            ]
        ];
    }

    public function onRender()
    {
        $clientId = Settings::get('client_key');
        $language = Settings::get('language', 'en');
        $callbackFunction = $this->property('callbackFunction');

        return $this->renderPartial('@default', [
            'clientId' => $clientId,
            'language' => $language,
            'callbackFunction' => $callbackFunction,
        ]);
    }
}
