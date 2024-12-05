<?php

namespace ToxyTech\Api\Tables;

use ToxyTech\Api\Models\PersonalAccessToken;
use ToxyTech\Table\Abstracts\TableAbstract;
use ToxyTech\Table\Actions\DeleteAction;
use ToxyTech\Table\BulkActions\DeleteBulkAction;
use ToxyTech\Table\Columns\Column;
use ToxyTech\Table\Columns\CreatedAtColumn;
use ToxyTech\Table\Columns\DateTimeColumn;
use ToxyTech\Table\Columns\IdColumn;
use ToxyTech\Table\Columns\NameColumn;
use ToxyTech\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class SanctumTokenTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->setView('packages/api::table')
            ->model(PersonalAccessToken::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('api.sanctum-token.create'))
            ->addAction(DeleteAction::make()->route('api.sanctum-token.destroy'))
            ->addColumns([
                IdColumn::make(),
                NameColumn::make(),
                Column::make('abilities')
                    ->label(trans('packages/api::sanctum-token.abilities')),
                DateTimeColumn::make('last_used_at')
                    ->label(trans('packages/api::sanctum-token.last_used_at')),
                CreatedAtColumn::make(),
            ])
            ->addBulkAction(DeleteBulkAction::make())
            ->queryUsing(fn (Builder $query) => $query->select([
                'id',
                'name',
                'abilities',
                'last_used_at',
                'created_at',
            ]));
    }
}
