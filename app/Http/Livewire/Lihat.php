<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Lihat extends Component
{
    public $sid, $nomor_surat, $judul, $kategori, $file_surat, $created_at;

    public function mount($sid)
    {
        $this->sid = $sid;

        $detSrt = DB::select('select s.nomor_surat as nomor_surat, s.judul as judul, 
        s.file_surat as file_surat, k.kategori as kategori, s.created_at as created_at
        from surats as s
        join kategoris as k
        where s.id = ?', [$sid]);

        foreach ($detSrt as $ds) {
            $this->nomor_surat = $ds->nomor_surat;
            $this->judul = $ds->judul;
            $this->kategori = $ds->kategori;
            $this->file_surat = $ds->file_surat;
            $this->created_at = $ds->created_at;
        }
    }

    public function render()
    {
        return view('livewire.lihat')
        ->layout('template-app');
    }
}
