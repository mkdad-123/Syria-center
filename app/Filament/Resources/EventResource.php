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
    protected static ?string $modelLabel = 'event';
    protected static ?string $pluralModelLabel = 'events';
    protected static ?string $navigationGroup = 'event management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان الفعالية')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),

                        Forms\Components\Select::make('type')
                            ->label('نوع الفعالية')
                            ->options([
                                EventType::Festival->value => 'مهرجان',
                                EventType::Volunteering->value => 'تطوع',
                                EventType::Workshop->value => 'ورشة عمل',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\RichEditor::make('description')
                            ->label('وصف الفعالية')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold', 'italic', 'link',
                                'bulletList', 'orderedList',
                            ]),
                    ])->columns(2),

                Forms\Components\Section::make('التوقيت والمكان')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('تاريخ البداية')
                            ->required()
                            ->native(false),

                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('تاريخ النهاية')
                            ->required()
                            ->native(false)
                            ->minDate(fn (Forms\Get $get) => $get('start_date')),

                        Forms\Components\TextInput::make('location')
                            ->label('المكان')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('max_participants')
                            ->label('العدد الأقصى للمشاركين')
                            ->numeric()
                            ->minValue(1)
                            ->nullable(),
                    ])->columns(2),

                Forms\Components\Section::make('الصورة والإعدادات')
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->label('صورة الغلاف')
                            ->directory('events/cover')
                            ->image()
                            ->imageEditor()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_published')
                            ->label('نشر الفعالية')
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
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'festival' => 'مهرجان',
                                        'volunteering' => 'تطوع',
                                        'workshop' => 'ورشة عمل',
                                    })
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'festival' => 'warning',
                                        'volunteering' => 'success',
                                        'workshop' => 'info',
                                    })
                                    ->extraAttributes(['class' => 'mr-2']),

                                Tables\Columns\IconColumn::make('is_published')
                                    ->label('الحالة')
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
                                    ->label('البداية')
                                    ->dateTime('d/m/Y H:i')
                                    ->icon('heroicon-o-calendar')
                                    ->iconPosition('before')
                                    ->extraAttributes(['class' => 'mr-2']),

                                Tables\Columns\TextColumn::make('max_participants')
                                    ->label('المشاركون')
                                    ->formatStateUsing(fn ($state) => $state ? "{$state} مشارك" : 'لا يوجد حد')
                                    ->icon('heroicon-o-users')
                                    ->iconPosition('before')
                                    ->extraAttributes(['class' => 'ml-2']),
                            ]),

                            Tables\Columns\TextColumn::make('location')
                                ->label('المكان')
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
                    ->label('نوع الفعالية')
                    ->options([
                        'festival' => 'مهرجان',
                        'volunteering' => 'تطوع',
                        'workshop' => 'ورشة عمل',
                    ])
                    ->native(false),

                Tables\Filters\Filter::make('is_published')
                    ->label('الفعاليات المنشورة فقط')
                    ->query(fn ($query) => $query->where('is_published', true)),

                Tables\Filters\Filter::make('upcoming_events')
                    ->label('الفعاليات القادمة')
                    ->query(fn ($query) => $query->where('start_date', '>=', now()))
                    ->indicator('قادمة'),
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
                        ->label('نشر')
                        ->icon('heroicon-o-arrow-up-on-square')
                        ->color('warning')
                        ->action(fn (Event $record) => $record->update(['is_published' => true]))
                        ->hidden(fn (Event $record) => $record->is_published),
                ])
                    ->label('الإجراءات')
                    ->dropdown()
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('lg'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('حذف المحدد'),

                    Tables\Actions\BulkAction::make('publish')
                        ->label('نشر المحدد')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_published' => true])),
                ])->label('إجراءات جماعية'),
            ])
            ->defaultSort('start_date', 'desc')
            ->groups([
                Tables\Grouping\Group::make('start_date')
                    ->label('حسب التاريخ')
                    ->date()
                    ->collapsible(),

                Tables\Grouping\Group::make('type')
                    ->label('حسب النوع')
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
