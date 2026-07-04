<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkVisitResource\Pages;
use App\Models\LinkVisit;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;

class LinkVisitResource extends Resource
{
    protected static ?string $model = LinkVisit::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'История переходов';

    protected static ?string $pluralModelLabel = 'История переходов';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('link.code')
                    ->label('Короткий код')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('link.original_url')
                    ->label('Оригинальный URL')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP-адрес')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Время перехода')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') 
            ->filters([
                TernaryFilter::make('link_status')
                    ->label('Переходы')
                    ->placeholder('Все переходы')
                    ->trueLabel('Только по активным ссылкам')
                    ->falseLabel('Только только по удалённым ссылкам')
                    ->default(true) 
                    ->queries(
                        true: fn (Builder $query) => $query->whereHas('link', fn ($q) => $q->whereNull('deleted_at')), 
                        false: fn (Builder $query) => $query->whereHas('link', fn ($q) => $q->whereNotNull('deleted_at')), 
                    )
            ])
            ->actions([
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLinkVisits::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with([
            'link' => fn ($query) => $query->withTrashed()
        ]);
    }
}
