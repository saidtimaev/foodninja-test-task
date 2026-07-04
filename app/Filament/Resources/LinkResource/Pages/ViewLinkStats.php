<?php

namespace App\Filament\Resources\LinkResource\Pages;

use App\Filament\Resources\LinkResource;
use App\Models\Link;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ViewLinkStats extends Page implements HasTable
{
    use InteractsWithTable; 

    protected static string $resource = LinkResource::class;

    protected static string $view = 'filament.resources.link-resource.pages.view-link-stats';

    public $record; 

    public function mount($record): void
    {
        $this->record = Link::withTrashed()->findOrFail($record);
    }

    public function getTitle(): string
    {
        return "Статистика короткой ссылки: {$this->record->code}";
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->record->visits()->getQuery()) 
            ->columns([
                TextColumn::make('ip_address')
                    ->label('IP-адрес')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Дата и время перехода')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc'); 
    }
}