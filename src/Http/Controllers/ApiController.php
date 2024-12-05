<?php

namespace ToxyTech\Api\Http\Controllers;

use ToxyTech\Api\Http\Requests\ApiSettingRequest;
use ToxyTech\Base\Facades\Assets;
use ToxyTech\Base\Facades\PageTitle;
use ToxyTech\Base\Http\Controllers\BaseController;
use ToxyTech\Base\Http\Responses\BaseHttpResponse;
use ToxyTech\Base\Supports\Breadcrumb;

class ApiController extends BaseController
{
    public function settings()
    {
        PageTitle::setTitle(trans('packages/api::api.settings'));

        Assets::addScriptsDirectly('vendor/core/core/setting/js/setting.js');
        Assets::addStylesDirectly('vendor/core/core/setting/css/setting.css');

        if (version_compare('7.0.0', get_core_version(), '>')) {
            return view('packages/api::settings-v6');
        }

        $this->breadcrumb()
            ->add(trans('core/setting::setting.title'), route('settings.index'))
            ->add(trans('packages/api::api.settings'));

        return view('packages/api::settings');
    }

    public function storeSettings(ApiSettingRequest $request, BaseHttpResponse $response)
    {
        $this->saveSettings($request->validated());

        return $response
            ->setPreviousUrl(route('api.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    protected function saveSettings(array $data)
    {
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue));
            }

            setting()->set($settingKey, (string)$settingValue);
        }

        setting()->save();
    }
}
