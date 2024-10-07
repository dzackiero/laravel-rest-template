<?php

namespace App\Enums\Features;


/**
 * This is Feature Enum Example.
 * The Name structure is FeaturePlatform
 * it need to have getPlatform and getFeature methods.
 * You need to register the Feature Enum to the config
 */
enum AuthWeb: string
{
    public function getPlatform(): string
    {
        return 'web';
    }

    public function getFeature(): string
    {
        return "auth";
    }

    case Login = "login";
    case Logout = "logout";
}
