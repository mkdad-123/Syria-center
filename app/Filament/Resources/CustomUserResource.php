<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomUserResource\Pages;
use App\Models\CustomUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomUserResource extends Resource
{
    protected static ?string $model = CustomUser::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('filament.user.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.user.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.user.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.user.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\TextColumn::make('name')
                        ->label(__('filament.user.columns.name'))
                        ->searchable()
                        ->sortable()
                        ->weight('bold'),

                    Tables\Columns\TextColumn::make('email')
                        ->label(__('filament.user.columns.email'))
                        ->searchable()
                        ->icon('heroicon-o-envelope')
                        ->iconPosition('after'),

                    Tables\Columns\TextColumn::make('created_at')
                        ->label(__('filament.user.columns.registration_date'))
                        ->date('d/m/Y')
                        ->sortable(),
                ])
                    ->extraAttributes(['class' => 'bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm'])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                Tables\Filters\Filter::make('registered_this_month')
                    ->label(__('filament.user.filters.registered_this_month'))
                    ->query(fn ($query) => $query->where('created_at', '>=', now()->startOfMonth())),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading(__('filament.user.actions.delete.modal_heading'))
                        ->modalDescription(__('filament.user.actions.delete.modal_description'))
                        ->modalSubmitActionLabel(__('filament.user.actions.delete.modal_submit'))
                        ->modalCancelActionLabel(__('filament.user.actions.delete.modal_cancel')),
                ])
                    ->dropdown(false)
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('sm')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.user.bulk_actions.delete')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->label(__('filament.user.bulk_actions.restore')),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label(__('filament.user.groups.by_registration_date'))
                    ->date()
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomUsers::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return CustomUser::count();
    }
}
