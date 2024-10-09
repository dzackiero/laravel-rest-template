<?php
if (!function_exists('generatePermission')) {
    function generatePermission($permission): \Spatie\Permission\Models\Permission|null
    {
        if (is_object($permission)
            && (new ReflectionClass($permission))->isEnum()
            && method_exists($permission, 'getFeature')
            && method_exists($permission, 'getPlatform')
        ) {
            $permissionName = $permission->getPlatform() . "-" . $permission->getFeature() . "-" . $permission->value;
            if (\Spatie\Permission\Models\Permission::where("name", $permissionName)->exists()) {
                return null;
            }
            return \Spatie\Permission\Models\Permission::create(["name" => $permissionName, "feature" => $permission->getFeature()]);
        }
        return null;
    }
}

if (!function_exists('getPermission')) {
    function getPermission($permission)
    {
        if (is_object($permission)
            && (new ReflectionClass($permission))->isEnum()
            && method_exists($permission, 'getFeature')
            && method_exists($permission, 'getPlatform')
        ) {
            return $permission->getPlatform() . "-" . $permission->getFeature() . "-" . $permission->value;
        }
        return null;
    }
}

if (!function_exists('generateFeature')) {
    function generateFeature($feature): void
    {
        $permissions = $feature::cases();
        foreach ($permissions as $permission) {
            generatePermission($permission);
        }
    }
}

if (!function_exists('isExceptionUserFriendly')) {
    function isExceptionUserFriendly(Throwable $exception): ?int
    {
        $exceptions = config("exception.friendly");
        foreach ($exceptions as $friendlyException => $errorCode) {
            if ($exception instanceof $friendlyException) {
                return $errorCode;
            }
        }
        return null;
    }
}





