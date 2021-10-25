<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $sid;

    public function saveID($sid)
    {
        $this->sid = $sid;
    }

    public function unsaveID()
    {
        $this->sid = null;
    }

    public function delSrt()
    {
        $del = Surat::find($this->sid);
        if ($del['file_surat'] != null) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/storage/file-surat/' . $del['file_surat']);
        }
        $del->delete();
        session()->flash('pesanB', 'Arsip surat berhasil dihapus');
        return redirect(route('dash'));
    }

    public function getAll()
    {
        $surat = DB::select('
        select s.nomor_surat as nomor_surat, s.judul as judul, 
        s.created_at as created_at, k.kategori as kategori, 
        s.id as sid, s.file_surat as file_surat
        from surats as s
        join kategoris as k on s.id_kategori = k.id
        ');
        return $surat;
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'dataSurat' => $this->getAll()
        ])
        ->layout('template-app');
    }
}
