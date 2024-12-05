<?php

namespace ToxyTech\Api\Forms;

use ToxyTech\Api\Http\Requests\StoreSanctumTokenRequest;
use ToxyTech\Api\Models\PersonalAccessToken;
use ToxyTech\Base\Forms\FieldOptions\NameFieldOption;
use ToxyTech\Base\Forms\Fields\TextField;
use ToxyTech\Base\Forms\FormAbstract;

class SanctumTokenForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->setupModel(new PersonalAccessToken())
            ->setValidatorClass(StoreSanctumTokenRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->toArray());
    }
}
