<?php namespace Brutalhost\YandexSmartCaptcha\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // Уникальный код для ваших настроек
    public $settingsCode = 'brutalhost_yandexsmartcaptcha_settings';

    // Поле для хранения настроек в базе данных
    public $settingsFields = 'fields.yaml';
}
