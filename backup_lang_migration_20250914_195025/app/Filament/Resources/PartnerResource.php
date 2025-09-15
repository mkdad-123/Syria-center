<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?int $navigationSort = 7;

    public static function getNavigationLabel(): string
    {
        return __('filament.partner.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.partner.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.partner.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.partner.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.partner.sections.basic_info'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('filament.partner.fields.logo'))
                            ->directory('partners/logos')
                            ->image()
                            ->imageEditorViewportWidth('500')
                            ->imageEditorViewportHeight('300')
                            ->imageResizeMode('cover')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->label(__('filament.partner.fields.name'))
                            ->required(),

                        Forms\Components\RichEditor::make('description')
                            ->label(__('filament.partner.fields.description'))
                            ->toolbarButtons([
                                'bold', 'italic', 'link',
                                'bulletList', 'orderedList',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\ImageColumn::make('image')
                        ->label(__('filament.partner.fields.logo'))
                        ->size(100)
                        ->grow(false)
                        ->extraImgAttributes(['class' => 'rounded-lg']),

                    Tables\Columns\TextColumn::make('name')
                        ->label(__('filament.partner.fields.name'))
                        ->searchable()
                        ->weight('bold')
                        ->size('lg'),

                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('description')
                            ->label(__('filament.partner.fields.description'))
                            ->html()
                            ->wrap(),
                    ])->extraAttributes(['class' => 'px-4 pb-4 border-t border-gray-100']),
                ])->extraAttributes(['class' => 'bg-white dark:bg-gray-800 p-4 rounded-xl shadow hover:shadow-md transition-shadow']),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil')
                        ->label(__('filament.partner.actions.edit')),

                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament.partner.actions.delete.modal_heading'))
                        ->modalDescription(__('filament.partner.actions.delete.modal_description'))
                        ->successNotificationTitle(__('filament.partner.actions.delete.success_message'))
                        ->label(__('filament.partner.actions.delete.label')),
                ])
                    ->dropdown(false)
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('sm')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.partner.bulk_actions.delete'))
                        ->modalHeading(__('filament.partner.bulk_actions.delete_modal')),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label(__('filament.partner.groups.by_date'))
                    ->date()
                    ->collapsible(),
            ])
            ->emptyStateHeading(__('filament.partner.empty_state.heading'))
            ->emptyStateDescription(__('filament.partner.empty_state.description'));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
