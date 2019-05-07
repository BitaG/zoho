<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;

class Error extends Controller
{
    /**
     * Error msg array
     * @var array
     */
    private $errorMessage =
        [
            'default'   => ['error' => 'Что-то пошло не так!',  'value' => 'Произошла ошибка, пожалуйста, обратитесь в техподдержку.'],
            '400'       => ['error' => 'Ошибка установки',      'value' => 'Установка происходит с магазина'],
            '401'       => ['error' => 'Сесиия истекла',        'value' => 'Пожалуйста повторите вход в приложение с магазина'],
            '405'       => ['error' => 'Неверная авторизация',  'value' => 'Авторизиция происходит с магазина'],
        ];

    /**
     * Error page
     * @param string $code
     * @return mixed
     */
    public function show( $code='default')
    {
        if(!array_key_exists($code, $this->errorMessage)) {
            $code ='default';
            $url = $this->insaleUrl;
        }

        Log::error($this->errorMessage[$code]['error']);

        return view('error',
            [
                'error' => $this->errorMessage[$code]['error'],
                'value' => $this->errorMessage[$code]['value'],
            ]);
    }


}
