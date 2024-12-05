<?php

namespace ToxyTech\Api\Http\Controllers;

use ToxyTech\Api\Forms\Settings\ApiSettingForm;
use ToxyTech\Api\Http\Requests\ApiSettingRequest;
use ToxyTech\Api\Tables\SanctumTokenTable;
use ToxyTech\Setting\Http\Controllers\SettingController;

class ApiController extends SettingController
{
    public function edit(SanctumTokenTable $sanctumTokenTable)
    {
        $this->pageTitle(trans('packages/api::api.settings'));

        $this->breadcrumb()
            ->add(trans('core/setting::setting.title'), route('settings.index'))
            ->add(trans('packages/api::api.settings'));

        $form = ApiSettingForm::create();

        $sanctumTokenTable->setAjaxUrl(route('api.sanctum-token.index'));

        return view('packages/api::settings', compact('form', 'sanctumTokenTable'));
    }

    public function update(ApiSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
