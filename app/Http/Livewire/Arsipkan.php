<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Arsipkan extends Component
{
    use WithFileUploads;

    public $nomor_surat, $judul, $id_kategori, $file_surat, $fname;

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

    public function saveArsip()
    {

        $validatedData = $this->validate();
        // $this->validate([
        //     'nomor_surat' => 'required',
        //     'id_kategori' => 'required',
        //     'judul' => 'required',
        //     'file_surat' => 'required',
        // ]);

        if ($this->file_surat != null) {
            $ori = $this->file_surat->getClientOriginalName();
            $this->fname = uniqid() . '_' . $ori;
        }

        $cSurat = Surat::create([
            'nomor_surat' => $this->nomor_surat,
            'id_kategori' => $this->id_kategori,
            'judul' => $this->judul,
            'file_surat' => $this->fname,
        ]);

        if ($cSurat) {
            if ($this->file_surat != null) {
                $this->file_surat->storeAs('file-surat', $this->fname, 'public');
            }
            session()->flash('pesanB', 'Surat berhasil diarsipkan');
            return redirect(route('dash'));
        } else {
            session()->flash('pesanG', 'Surat GAGAL diarsipkan');
            return redirect(route('dash'));
        }

        // dd($validatedData);
    }

    public function getKategori()
    {
        $kategori = DB::select('select * from kategoris');
        return $kategori;
    }

    public function render()
    {
        return view('livewire.arsipkan', [
            'dataKategori' => $this->getKategori(),
        ])->layout('template-app');
    }
}
