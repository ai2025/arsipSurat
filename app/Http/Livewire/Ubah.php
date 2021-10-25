<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Ubah extends Component
{
    use WithFileUploads;

    public $nomor_surat, $judul, $id_kategori, $file_surat, $fname;
    public $sid, $kategori, $oldfile;

    public function mount($sid)
    {
        $this->sid = $sid;

        $detSrt = DB::select('select s.nomor_surat as nomor_surat, s.judul as judul, k.id as kid,
        s.file_surat as file_surat, k.kategori as kategori, s.created_at as created_at
        from surats as s
        join kategoris as k
        where s.id = ?', [$sid]);

        foreach ($detSrt as $ds) {
            $this->nomor_surat = $ds->nomor_surat;
            $this->judul = $ds->judul;
            $this->kategori = $ds->kategori;
            $this->id_kategori = $ds->kid;
            $this->oldfile = $ds->file_surat;
            $this->created_at = $ds->created_at;
        }
    }

    protected $messages = [
        'nomor_surat.required' => 'Mohon isi kolom Nomor Surat.',
        'nomor_surat.min' => 'Kolom Nomor Surat harus diisi minimal 5 karakter.',
        'judul.required' => 'Mohon isi kolom Judul.',
        'judul.min' => 'Kolom Judul harus diisi minimal 5 karakter.',
        'id_kategori.required' => 'Mohon isi kolom Kategori.',
        'file_surat.required' => 'Mohon unggah File Surat.',
    ];

    protected $rules = [
        'nomor_surat' => 'required|min:5',
        'judul' => 'required|min:5',
        'id_kategori' => 'required',
        'file_surat' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function ubahArsip()
    {

        if ($this->file_surat == null && $this->oldfile != null) {
            $this->file_surat = $this->oldfile;
        }
        $validatedData = $this->validate();
        // $this->validate([
        //     'nomor_surat' => 'required',
        //     'id_kategori' => 'required',
        //     'judul' => 'required',
        //     'file_surat' => 'required',
        // ]);

        if ($this->oldfile == null) {
            if ($this->file_surat != null) {
                $ori = $this->file_surat->getClientOriginalName();
                $this->fname = uniqid() . '_' . $ori;
            }
        }

        $edt = Surat::find($this->sid)->update([
            'nomor_surat' => $this->nomor_surat,
            'id_kategori' => $this->id_kategori,
            'judul' => $this->judul,
            'file_surat' => $this->fname,
        ]);

        if ($edt) {
            if ($this->oldfile == null) {
                $this->file_surat->storeAs('file-surat', $this->fname, 'public');
            }
            session()->flash('pesanB', 'Arsip berhasil diubah');
            return redirect(route('dash'));
        } else {
            session()->flash('pesanG', 'Arsip GAGAL diubah');
            return redirect(route('dash'));
        }

        // $cSurat = Surat::create([
        //     'nomor_surat' => $this->nomor_surat,
        //     'id_kategori' => $this->id_kategori,
        //     'judul' => $this->judul,
        //     'file_surat' => $this->fname,
        // ]);

        // if ($cSurat) {
        //     if ($this->file_surat != null) {
        //         $this->file_surat->storeAs('file-surat', $this->fname, 'public');
        //     }
        //     session()->flash('pesanB', 'Surat berhasil diarsipkan');
        //     return redirect(route('dash'));
        // } else {
        //     session()->flash('pesanG', 'Surat GAGAL diarsipkan');
        //     return redirect(route('dash'));
        // }

        // dd($validatedData);
    }

    public function delSrt()
    {
        $del = Surat::find($this->sid);
        if ($del['file_surat'] != null) {
            $this->oldfile = null;
            unlink($_SERVER['DOCUMENT_ROOT'].'/storage/file-surat/' . $del['file_surat']);
        }
        session()->flash('pesanB', 'Arsip surat berhasil dihapus');
        // return redirect(route('ubah', ['sid' => $this->sid]));
    }

    public function getKategori()
    {
        $kategori = DB::select('select * from kategoris');
        return $kategori;
    }

    public function render()
    {
        return view('livewire.ubah', [
            'dataKategori' => $this->getKategori(),
        ])
        ->layout('template-app');
    }
}
