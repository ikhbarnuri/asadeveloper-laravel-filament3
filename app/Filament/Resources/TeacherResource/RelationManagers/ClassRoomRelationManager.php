<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use App\Models\ClassRoom;
use App\Models\Periode;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ClassRoomRelationManager extends RelationManager
{
    protected static string $relationship = 'classRoom';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('class_room_id')
                    ->label('Select Class')
                    ->options(ClassRoom::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('periode_id')
                    ->label('Select Periode')
                    ->options(Periode::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('classroom.name'),
                TextColumn::make('periode.name'),
                ToggleColumn::make('is_open')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
