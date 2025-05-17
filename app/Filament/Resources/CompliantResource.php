<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompliantResource\Pages;
use App\Models\Compliants;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CompliantResource extends Resource
{
    use Translatable;

    protected static ?string $model = Compliants::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?int $navigationSort = 9;

    public static function getNavigationLabel(): string
    {
        return __('filament.compliant.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.compliant.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.compliant.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.compliant.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([

                    Tables\Columns\TextColumn::make('customUser.name')
                        ->label(__('filament.compliant.user.label'))
                        ->description(fn ($record) => $record->email)
                        ->searchable()
                        ->sortable()
                        ->color('primary')
                        ->icon('heroicon-o-user-circle')
                        ->iconPosition('before')
                        ->weight('bold')
                        ->extraAttributes(['class' => 'px-4 pt-4']),

                    Tables\Columns\TextColumn::make('content')
                        ->label(__('filament.compliant.content.label'))
                        ->limit(200)
                        ->searchable()
                        ->wrap()
                        ->markdown()
                        ->extraAttributes(['class' => 'px-4 py-3']),

                    Tables\Columns\Layout\Split::make([

                        Tables\Columns\TextColumn::make('date')
                            ->label('')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-calendar')
                            ->color('gray-500')
                            ->size('sm'),

                        Tables\Columns\TextColumn::make('created_at')
                            ->label('')
                            ->since()
                            ->icon('heroicon-o-clock')
                            ->color('gray-500')
                            ->size('sm'),

                    ])->extraAttributes(['class' => 'px-4 pb-4 border-t border-gray-100']),

                ])->extraAttributes(['class' => 'bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow']),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('custom_user_id')
                    ->label(__('filament.compliant.filters.user'))
                    ->relationship('customUser', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('today')
                    ->label(__('filament.compliant.filters.today'))
                    ->query(fn ($query) => $query->whereDate('date', today())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading(__('filament.compliant.actions.view.modal_heading'))
                    ->modalDescription(fn ($record) => Str::limit($record->content, 200)),
                    //->modalContent(fn ($record) => static::getCompliantDetails($record)),

                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->modalHeading(__('filament.compliant.actions.delete.modal_heading'))
                    ->modalDescription(__('filament.compliant.actions.delete.modal_description'))
                    ->modalSubmitActionLabel(__('filament.compliant.actions.delete.modal_submit'))
                    ->modalCancelActionLabel(__('filament.compliant.actions.delete.modal_cancel')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.compliant.bulk_actions.delete'))
                        ->modalHeading(__('filament.compliant.bulk_actions.delete_modal')),

                    Tables\Actions\BulkAction::make('mark_as_important')
                        ->label(__('filament.compliant.bulk_actions.mark_important'))
                        ->icon('heroicon-o-flag')
                        ->color('warning'),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->groups([
                Tables\Grouping\Group::make('customUser.name')
                    ->label(__('filament.compliant.groups.by_user'))
                    ->collapsible(),

                Tables\Grouping\Group::make('date')
                    ->label(__('filament.compliant.groups.by_date'))
                    ->date()
                    ->collapsible(),
            ])
            ->emptyStateHeading(__('filament.compliant.empty_state.heading'))
            ->emptyStateDescription(__('filament.compliant.empty_state.description'));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompliants::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Compliants::query()->where('created_at', today())->count();
    }
}
