@section('title', 'Ubah Arsip')
<main>
    <div>
        {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
        <h1>Arsip Surat >> Edit</h1>
        <hr>
        <p>Silakan edit arsip yang telah Anda unggah.
            <br>Catatan:
            <ul>
                <li>Gunakan file berformat PDF</li>
            </ul>
        </p>

        @if (session()->has('pesanB'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('pesanB') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif (session()->has('pesanG'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Wah!</strong> {{ session('pesanG') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card m-5 p-lg-3">
            <div class="card-body">
                {{-- <form> --}}
                    <div class="row mb-3">
                      <label for="nomorSurat" class="col-sm-2 col-form-label">Nomor Surat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nomor_surat" wire:model="nomor_surat">
                        @error('nomor_surat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Kategori" wire:model="id_kategori">
                                <option selected>-- Pilih Kategori Surat --</option>
                                @foreach ($dataKategori as $i)
                                <option value="{{ $i->id }}">{{ $i->kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                      <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" wire:model="judul">
                        @error('judul') <span class="error" style="color:red">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    @if ($oldfile != null)
                        <button name="delete" id="delete"
                        type="button" class="btn btn-danger" 
                        wire:click="delSrt">
                            Hapus File Arsip
                        </button>
                        <span>{{ $oldfile }}</span>
                    @elseif ($oldfile == null)
                        <div class="row mb-3">
                        <label for="fileSurat" class="col-sm-2 col-form-label">File Surat (PDF)</label>
                        <div class="col-sm-10">

                                <input id="file_surat" name="file_surat" type="file" class="form-control" 
                                wire:model="file_surat" accept=".pdf" required>

                                @error('file_surat') <span class="error" style="color:red">{{ $message }}</span> @enderror

                                <div wire:loading wire:target="file_surat"><b style="color:red">Sedang Mengunggah... Mohon TUnggu...</b></div>

                        </div>
                        
                    </div>
                    @endif
                    
                {{-- </form> --}}
            </div>
        </div>

        <a name="dash" id="dash" class="btn btn-outline-dark"
            href="{{ route('dash') }}"
            role="button">
            << Kembali
        </a>
        <span>&ensp; || &ensp;</span>
        <button name="save" id="save" class="btn btn-primary" wire:click="ubahArsip">
            Simpan
        </button>

        {{-- modal baru --}}
        <!-- Modal -->
        

    </div>
</main>
