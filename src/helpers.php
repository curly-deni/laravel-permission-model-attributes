<?php

if (! function_exists('canUserDoActionOnModel')) {
    function canUserDoActionOnModel($action, $model, $user = null)
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return \Illuminate\Support\Facades\Gate::forUser($user)->allows($action, $model);
    }
}

if (! function_exists('checkModelAction')) {
    function checkModelAction($model, $action)
    {
        if (! config('permission-model-attributes.'.$action, false)) {
            return true;
        }

        if (app()->runningInConsole()) {
            return true;
        }

        return canUserDoActionOnModel($action, $model);
    }

}
