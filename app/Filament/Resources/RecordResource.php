<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecordResource\Pages;
use App\Filament\Resources\RecordResource\RelationManagers;
use App\Models\Record;
use App\Models\RecordData;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class RecordResource extends Resource
{
    protected static ?string $model = RecordData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->maxLength(255)
                    ->required(),

                FileUpload::make('attachment')
                    ->label('Attachment')
                    ->rules('mimes:csv,xlsx')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('attachment')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('process')
                    ->label('Process')  
                    ->icon('heroicon-o-cog')
                    ->color('success')
                    ->url(fn (RecordData $record) => route('filament.admin.pages.process-data', ['record' => $record->id])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                
                    // ->url(fn (Post $record): string => route('posts.edit', $record))
                    // ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRecords::route('/'),
        ];
    }
}
