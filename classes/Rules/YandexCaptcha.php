<?php

namespace Brutalhost\YandexSmartCaptcha\Classes\Rules;

use Brutalhost\YandexSmartCaptcha\Models\Settings;
use Illuminate\Contracts\Validation\Rule;
use Mockery\Exception;
use Winter\Storm\Support\Facades\Http;

class YandexCaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        try {
            $args = http_build_query([
                'secret' => Settings::get('server_key'),
                'token' => $value,
                'ip' => request()->ip(),
            ]);

            $response = Http::get('https://captcha-api.yandex.ru/validate?' . $args);
            $body = json_decode($response->body);

            if ($response->code !== 200) {
                $this->errorMessage = $body->message;
                return false;
            }

            if ($body->status === 'failed') {
                $this->errorMessage = empty($body->message) ? 'Error with Yandex SmartCaptcha validation' : $body->message;
                return false;
            }

            return $body->status === 'ok';
        } catch (Exception $exception) {
            dd($exception);
        }

    }

    public function message()
    {
        return $this->errorMessage;
    }
}
