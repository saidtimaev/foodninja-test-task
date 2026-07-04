<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkResource\Pages;
use App\Filament\Resources\LinkResource\RelationManagers;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $modelLabel = 'ссылку';

    protected static ?string $pluralModelLabel = 'Ссылки';

    protected static ?string $navigationLabel = 'Мои ссылки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о ссылке')
                    ->description('Укажите исходный URL. Короткая ссылка будет сгенерирована автоматически.')
                    ->schema([
                        Forms\Components\TextInput::make('original_url')
                            ->label('Оригинальный URL')
                            ->required()
                            ->url()
                            ->placeholder('https://example.com/very-long-url')
                            ->rules(['url', 'active_url'])
                            ->validationMessages([
                                'active_url' => 'Этот домен не существует или недоступен.',
                                'url' => 'Введите корректный URL-адрес.',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('code')
                            ->label('Короткий код')
                            ->prefix(fn () => request()->getHost() . '/')
                            ->hiddenOn('create') 
                            ->disabled() 
                            ->dehydrated(false), 
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Короткая ссылка')
                    ->formatStateUsing(fn (string $state) => route('redirect', ['code' => $state]))
                    ->url(fn (string $state) => route('redirect', ['code' => $state]))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->copyable() 
                    ->copyableState(fn (string $state) => route('redirect', ['code' => $state])),

                Tables\Columns\TextColumn::make('original_url')
                    ->label('Куда ведет')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('visits_count')
                    ->counts('visits') 
                    ->label('Всего кликов')
                    ->sortable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), 
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(), 
                Tables\Actions\Action::make('stats')
                    ->label('Статистика')
                    ->icon('heroicon-o-chart-bar')
                    ->color('success')
                    ->url(fn (Link $record): string => LinkResource::getUrl('stats', ['record' => $record])),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), 
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'stats' => Pages\ViewLinkStats::route('/{record}/stats')
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                \Illuminate\Database\Eloquent\SoftDeletingScope::class,
            ]);
    }
}
