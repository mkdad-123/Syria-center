<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
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
                                'festival' => 'مهرجان',
                                'volunteering' => 'تطوع',
                                'workshop' => 'ورشة عمل',
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
                    ->columns([
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->schema([
                        Tables\Columns\ImageColumn::make('cover_image')
                            ->label('')
                            ->disk('public')
                            ->height(180)
                            ->grow(false)
                            ->extraImgAttributes([
                                'class' => 'object-cover w-full h-full rounded-t-lg'
                            ]),

                        Tables\Columns\TextColumn::make('title')
                            ->label('')
                            ->weight('bold')
                            ->size('lg')
                            ->wrap()
                            ->extraAttributes(['class' => 'px-4 pt-2']),

                        Tables\Columns\TextColumn::make('type')
                            ->label('')
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
                            ->extraAttributes(['class' => 'px-4']),

                        Tables\Columns\TextColumn::make('start_date')
                            ->label('البداية')
                            ->dateTime('d/m/Y H:i')
                            ->icon('heroicon-o-calendar')
                            ->iconPosition('before')
                            ->extraAttributes(['class' => 'px-4']),

                        Tables\Columns\TextColumn::make('location')
                            ->label('المكان')
                            ->icon('heroicon-o-map-pin')
                            ->iconPosition('before')
                            ->wrap()
                            ->extraAttributes(['class' => 'px-4 pb-3']),
                    ]),
                    Tables\Columns\TextColumn::make('is_published')
                        ->label('')
                        ->formatStateUsing(fn ($state) => $state ? 'منشور' : 'مسودة')
                        ->color(fn ($state) => $state ? 'success' : 'danger')
                        ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                        ->extraAttributes(['class' => 'px-4']),

                    Tables\Columns\TextColumn::make('max_participants')
                        ->label('')
                        ->formatStateUsing(fn ($state) => $state ? "{$state} مشارك" : 'لا يوجد حد')
                        ->icon('heroicon-o-users')
                        ->extraAttributes(['class' => 'px-4']),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('نوع الفعالية')
                    ->options([
                        'festival' => 'مهرجان',
                        'volunteering' => 'تطوع',
                        'workshop' => 'ورشة عمل',
                    ]),

                Tables\Filters\Filter::make('is_published')
                    ->label('الفعاليات المنشورة فقط')
                    ->query(fn ($query) => $query->where('is_published', true)),

                Tables\Filters\Filter::make('upcoming_events')
                    ->label('الفعاليات القادمة')
                    ->query(fn ($query) => $query->where('start_date', '>=', now())),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('primary'),

                    Tables\Actions\EditAction::make()
                        ->color('success'),

                    Tables\Actions\Action::make('publish')
                        ->label('نشر')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Event $record) => $record->update(['is_published' => true]))
                        ->hidden(fn (Event $record) => $record->is_published),
                ])
                    ->dropdown(false)
                    ->icon('heroicon-s-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publish')
                        ->label('نشر المحدد')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_published' => true])),
                ]),
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
            ]);
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
        return Event::where('start_date', '>=', now())->count();
    }
}
