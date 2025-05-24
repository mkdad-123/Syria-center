<?php

namespace App\Filament\Resources;

use App\Enums\SectionEnum;
use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SettingResource extends Resource
{
    use Translatable;

    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?int $navigationSort = 8;

    public static function getNavigationLabel(): string
    {
        return __('filament.setting.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.setting.model_label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.setting.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.setting.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('section')
                            ->label(__('filament.setting.section.label'))
                            ->required()
                            ->options([
                                SectionEnum::AboutUs->value => __('filament.setting.section.options.about us'),
                                SectionEnum::Vision->value => __('filament.setting.section.options.vision'),
                                SectionEnum::Mission->value => __('filament.setting.section.options.mission'),
                                SectionEnum::TargetGroup->value => __('filament.setting.section.options.target group'),
                            ])
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('title', Str::headline(__('filament.setting.section.options.'.$state)));
                            }),

                        TextInput::make('title')
                            ->label(__('filament.setting.title.label'))
                            ->required(),

                        Forms\Components\FileUpload::make('image')
                            ->label(__('filament.setting.image.label'))
                            ->directory('Setting')
                            ->image()
                            ->imageEditor(),

                        Forms\Components\RichEditor::make('content')
                            ->label(__('filament.setting.content.label'))
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'undo',
                            ])
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\KeyValue::make('extra')
                            ->label(__('filament.setting.extra.label'))
                            ->keyLabel(__('filament.setting.extra.key_label'))
                            ->valueLabel(__('filament.setting.extra.value_label'))
                            ->columnSpanFull()
                            ->hidden(fn (Forms\Get $get) : bool => $get('section') !== SectionEnum::AboutUs->value),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->circular()
                    ->size(50)
                    ->grow(false),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.setting.table.title'))
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->tooltip(fn ($record) => $record->title),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.setting.table.updated_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('filament.setting.actions.edit')),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
