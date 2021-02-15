<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    private function getFormattedMessage(\Illuminate\Support\MessageBag $msgBag)
    {
        return Arr::collapse($msgBag->getMessages())[0];
    }

    abstract public function rules();
}
