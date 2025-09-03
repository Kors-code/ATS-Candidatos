<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class CandidatosExport implements FromCollection
{
    protected $candidatos;

    public function __construct($candidatos)
    {
        $this->candidatos = $candidatos;
    }

    public function collection()
    {
        return $this->candidatos;
    }
}