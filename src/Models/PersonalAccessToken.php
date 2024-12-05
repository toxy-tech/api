<?php

namespace ToxyTech\Api\Models;

use ToxyTech\Base\Contracts\BaseModel;
use ToxyTech\Base\Models\Concerns\HasBaseEloquentBuilder;
use ToxyTech\Base\Models\Concerns\HasMetadata;
use ToxyTech\Base\Models\Concerns\HasUuidsOrIntegerIds;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken implements BaseModel
{
    use HasMetadata;
    use HasUuidsOrIntegerIds;
    use HasBaseEloquentBuilder;
}
