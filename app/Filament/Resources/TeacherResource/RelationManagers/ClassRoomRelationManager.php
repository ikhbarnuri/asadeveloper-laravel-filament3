<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use App\Models\ClassRoom;
use App\Models\Periode;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\GlobalSearch\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

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
                    ->preload()
                    ->searchable()
                    ->required()
                    ->relationship('classRoom', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->live()
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),
                        Hidden::make('slug')
                            ->required(),
                    ])
                    ->createOptionAction(function (\Filament\Forms\Components\Actions\Action $action) {
                        return $action
                            ->modalHeading('Add Class Room')
                            ->modalSubmitActionLabel('Add Class Room')
                            ->modalWidth('2xl');
                    }),
                Select::make('periode_id')
                    ->label('Select Periode')
                    ->options(Periode::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->relationship('periode', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Add Periode')
                            ->required(),
                    ])
                    ->createOptionAction(function (\Filament\Forms\Components\Actions\Action $action) {
                        return $action
                            ->modalHeading('Add Periode')
                            ->modalSubmitActionLabel('Add Periode')
                            ->modalWidth('2xl');
                    }),
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
