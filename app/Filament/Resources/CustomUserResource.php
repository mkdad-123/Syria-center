<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomUserResource\Pages;
use App\Filament\Resources\CustomUserResource\RelationManagers;
use App\Models\CustomUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class CustomUserResource extends Resource
{

    protected static ?string $model = CustomUser::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'Users';
    protected static ?string $navigationGroup = 'member management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\ImageColumn::make('avatar')
                        ->label('')
                        //->getStateUsing(fn () => 'https://ui-avatars.com/api/?name=' . urlencode($record->name))
                        ->width(80)
                        ->height(80)
                        ->circular(),

                    Tables\Columns\TextColumn::make('name')
                        ->label('الاسم')
                        ->searchable()
                        ->sortable()
                        ->weight('bold'),

                    Tables\Columns\TextColumn::make('email')
                        ->label('البريد')
                        ->searchable()
                        ->icon('heroicon-o-envelope')
                        ->iconPosition('after'),

                    Tables\Columns\TextColumn::make('session_status')
                        ->label('حالة الجلسة')
                        ->badge()
                        ->color(fn ($state) => $state ? 'success' : 'danger')
                        ->formatStateUsing(fn ($state) => $state ? 'نشطة الآن' : 'غير نشطة')
                        ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'),

                    Tables\Columns\TextColumn::make('last_activity')
                        ->label('آخر نشاط')
                        ->dateTime('d/m/Y H:i')
                        ->sortable()
                        ->description(fn ($record) => $record->last_activity ? now()->parse($record->last_activity)->diffForHumans() : ''),

                    Tables\Columns\TextColumn::make('created_at')
                        ->label('تاريخ التسجيل')
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
                Tables\Filters\Filter::make('active_sessions')
                    ->label('جلسات نشطة')
                    ->query(fn ($query) => $query->whereHas('sessions', fn ($q) => $q->where('last_activity', '>', now()->subMinutes(15)))),

                Tables\Filters\Filter::make('registered_this_month')
                    ->label('مسجلون هذا الشهر')
                    ->query(fn ($query) => $query->where('created_at', '>=', now()->startOfMonth())),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye')
                        ->color('primary'),

                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('حذف المستخدم')
                        ->modalDescription('هل أنت متأكد من رغبتك في حذف هذا المستخدم؟ سيتم إزالة جميع البيانات المرتبطة به بشكل دائم.')
                        ->modalSubmitActionLabel('نعم، احذف')
                        ->modalCancelActionLabel('إلغاء'),

                    Tables\Actions\Action::make('sessions')
                        ->label('عرض الجلسات')
                        ->icon('heroicon-o-computer-desktop')
                        ->color('warning')
                        //->url(fn ($record) => SessionResource::getUrl('index', ['user_id' => $record->id])),
                ])
                    ->dropdown(false)
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('sm')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\BulkAction::make('clear_sessions')
                        ->label('مسح الجلسات')
                        ->icon('heroicon-o-arrow-path')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each(function ($user) {
                                DB::table('sessions')
                                    ->where('user_id', $user->id)
                                    ->delete();
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label('حسب تاريخ التسجيل')
                    ->date()
                    ->collapsible(),

                Tables\Grouping\Group::make('session_status')
                    ->label('حالة الجلسة')
                    ->collapsible(),
            ]);
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
            'index' => Pages\ListCustomUsers::route('/'),
            'create' => Pages\CreateCustomUser::route('/create'),
            'edit' => Pages\EditCustomUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['sessions' => function ($query) {
                $query->orderBy('last_activity', 'desc')->limit(1);
            }])
            ->addSelect([
                'last_activity' => DB::table('sessions')
                    ->select('last_activity')
                    ->whereColumn('user_id', 'users.id')
                    ->orderByDesc('last_activity')
                    ->limit(1)
            ]);
    }
}
