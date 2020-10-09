<?php

namespace App\Rules;

use App\Models\User as User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ExistEmail implements Rule
{
    protected $attributes = [];

    /**
     * ExistEmail constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = new User();

        return $user->where('email', $this->attributes['email'])
            ->whereNotNull('email_verified_at')
            ->whereNull('deleted_at')
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeが登録済です。パスワードをお忘れの方は<a href="/user/password">こちら</a>から再設定してください。';
    }
}
