<?php

namespace ToxyTech\Api\Forms\Settings;

use ToxyTech\Api\Facades\ApiHelper;
use ToxyTech\Api\Http\Requests\ApiSettingRequest;
use ToxyTech\Base\Forms\FieldOptions\OnOffFieldOption;
use ToxyTech\Base\Forms\Fields\OnOffCheckboxField;
use ToxyTech\Setting\Forms\SettingForm;

class ApiSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setValidatorClass(ApiSettingRequest::class)
            ->setSectionTitle(trans('packages/api::api.setting_title'))
            ->setSectionDescription(trans('packages/api::api.setting_description'))
            ->contentOnly()
            ->add(
                'api_enabled',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label(trans('packages/api::api.api_enabled'))
                    ->value(ApiHelper::enabled())
                    ->toArray()
            );
    }
}
