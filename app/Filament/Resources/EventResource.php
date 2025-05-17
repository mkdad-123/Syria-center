<?php

namespace App\Filament\Resources;

use App\Enums\EventType;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    use Translatable;

    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('filament.event.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.event.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.event.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.event.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.event.sections.basic_info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament.event.fields.title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),

                        Forms\Components\Select::make('type')
                            ->label(__('filament.event.fields.type'))
                            ->options([
                                EventType::Festival->value => __('filament.event.types.festival'),
                                EventType::Volunteering->value => __('filament.event.types.volunteering'),
                                EventType::Workshop->value => __('filament.event.types.workshop'),
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\RichEditor::make('description')
                            ->label(__('filament.event.fields.description'))
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold', 'italic', 'link',
                                'bulletList', 'orderedList',
                            ]),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.event.sections.time_location'))
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label(__('filament.event.fields.start_date'))
                            ->required()
                            ->native(false),

                        Forms\Components\DateTimePicker::make('end_date')
                            ->label(__('filament.event.fields.end_date'))
                            ->required()
                            ->native(false)
                            ->minDate(fn (Forms\Get $get) => $get('start_date')),

                        Forms\Components\TextInput::make('location')
                            ->label(__('filament.event.fields.location'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('max_participants')
                            ->label(__('filament.event.fields.max_participants'))
                            ->numeric()
                            ->minValue(1)
                            ->nullable(),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.event.sections.image_settings'))
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->label(__('filament.event.fields.cover_image'))
                            ->directory('events/cover')
                            ->image()
                            ->imageEditor()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_published')
                            ->label(__('filament.event.fields.is_published'))
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Grid::make()
                    ->schema([
                        Tables\Columns\ImageColumn::make('cover_image')
                            ->label('')
                            ->disk('public')
                            ->height(300)
                            ->width('100%')
                            ->grow(false)
                            ->extraImgAttributes([
                                'class' => 'object-cover w-full h-full rounded-lg shadow-md'
                            ]),

                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('title')
                                ->label('')
                                ->weight(FontWeight::Bold)
                                ->size('lg')
                                ->wrap()
                                ->extraAttributes(['class' => 'mb-4']),

                            Tables\Columns\Layout\Split::make([
                                Tables\Columns\TextColumn::make('type')
                                    ->formatStateUsing(fn ($state): string => match ($state->value) {
                                        EventType::Festival->value => __('filament.event.types.festival'),
                                        EventType::Volunteering->value => __('filament.event.types.volunteering'),
                                        EventType::Workshop->value => __('filament.event.types.workshop'),
                                    })
                                    ->badge()
                                    ->color(fn ($state): string => match ($state->value) {
                                        EventType::Festival->value => 'warning',
                                        EventType::Volunteering->value => 'success',
                                        EventType::Workshop->value => 'info',
                                    })
                                    ->extraAttributes(['class' => 'mr-2']),

                                Tables\Columns\IconColumn::make('is_published')
                                    ->label(__('filament.event.fields.status'))
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger')
                                    ->size('lg')
                                    ->extraAttributes(['class' => 'ml-2']),
                            ]),

                            Tables\Columns\TextColumn::make('')
                                ->label('')
                                ->formatStateUsing(fn () => '')
                                ->extraAttributes(['class' => 'h-4']),

                            Tables\Columns\Layout\Split::make([
                                Tables\Columns\TextColumn::make('start_date')
                                    ->label(__('filament.event.fields.start'))
                                    ->dateTime('d/m/Y H:i')
                                    ->icon('heroicon-o-calendar')
                                    ->iconPosition('before')
                                    ->extraAttributes(['class' => 'mr-2']),

                                Tables\Columns\TextColumn::make('max_participants')
                                    ->label(__('filament.event.fields.participants'))
                                    ->formatStateUsing(fn ($state) => $state ? __('filament.event.participants_count', ['count' => $state]) : __('filament.event.no_limit'))
                                    ->icon('heroicon-o-users')
                                    ->iconPosition('before')
                                    ->extraAttributes(['class' => 'ml-2']),
                            ]),

                            Tables\Columns\TextColumn::make('location')
                                ->label(__('filament.event.fields.location'))
                                ->icon('heroicon-o-map-pin')
                                ->iconPosition('before')
                                ->wrap()
                                ->color('gray')
                                ->extraAttributes(['class' => 'mt-4 mb-2']),
                        ])
                            ->extraAttributes([
                                'class' => 'p-6 bg-black rounded-lg shadow-md space-y-4'
                            ]),
                    ])
                    ->extraAttributes([
                        'class' => 'gap-6'
                    ])
            ])
            ->contentGrid([
                'md' => 1,
                'xl' => 2,
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('filament.event.filters.type'))
                    ->options([
                        EventType::Festival->value => __('filament.event.types.festival'),
                        EventType::Volunteering->value => __('filament.event.types.volunteering'),
                        EventType::Workshop->value => __('filament.event.types.workshop'),
                    ])
                    ->native(false),

                Tables\Filters\Filter::make('is_published')
                    ->label(__('filament.event.filters.published_only'))
                    ->query(fn ($query) => $query->where('is_published', true)),

                Tables\Filters\Filter::make('upcoming_events')
                    ->label(__('filament.event.filters.upcoming'))
                    ->query(fn ($query) => $query->where('start_date', '>=', now()))
                    ->indicator(__('filament.event.filters.upcoming_indicator')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('primary')
                        ->icon('heroicon-o-eye'),

                    Tables\Actions\EditAction::make()
                        ->color('success')
                        ->icon('heroicon-o-pencil'),

                    Tables\Actions\Action::make('publish')
                        ->label(__('filament.event.actions.publish'))
                        ->icon('heroicon-o-arrow-up-on-square')
                        ->color('warning')
                        ->action(fn (Event $record) => $record->update(['is_published' => true]))
                        ->hidden(fn (Event $record) => $record->is_published),
                ])
                    ->label(__('filament.event.actions.label'))
                    ->dropdown()
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('lg'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.event.bulk_actions.delete')),

                    Tables\Actions\BulkAction::make('publish')
                        ->label(__('filament.event.bulk_actions.publish'))
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_published' => true])),
                ])->label(__('filament.event.bulk_actions.label')),
            ])
            ->defaultSort('start_date', 'desc')
            ->groups([
                Tables\Grouping\Group::make('start_date')
                    ->label(__('filament.event.groups.by_date'))
                    ->date()
                    ->collapsible(),

                Tables\Grouping\Group::make('type')
                    ->label(__('filament.event.groups.by_type'))
                    ->collapsible(),
            ])
            ->paginated([10, 25, 50, 'all']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Event::query()->where('start_date', '>=', now())->count();
    }
}
