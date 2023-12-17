<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Imports\ImportStudents;
use App\Models\Student;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ListStudents extends ListRecords
{
    public $file = '';

    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        return view('filament.custom.upload-file', [
            'data' => Actions\CreateAction::make(),
        ]);
    }

    public function save()
    {
        if ($this->file != '') {
            Excel::import(new ImportStudents, $this->file);
        }
    }
}
