@section('title', 'Arsipkan Surat')
<main>
    <div>
        {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
        <h1>Arsip Surat >> Unggah</h1>
        <hr>
        <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.
            <br>Catatan:
            <ul>
                <li>Gunakan file berformat PDF</li>
            </ul>
        </p>

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
                    <div class="row mb-3">
                        <label for="fileSurat" class="col-sm-2 col-form-label">File Surat (PDF)</label>
                        <div class="col-sm-10">

                                <input id="file_surat" name="file_surat" type="file" class="form-control" 
                                wire:model="file_surat" accept=".pdf" required>

                                @error('file_surat') <span class="error" style="color:red">{{ $message }}</span> @enderror

                                <div wire:loading wire:target="file_surat"><b style="color:red">Sedang Mengunggah... Mohon TUnggu...</b></div>

                        </div>
                        
                    </div>
                {{-- </form> --}}
            </div>
        </div>

        <a name="dash" id="dash" class="btn btn-outline-dark"
            href="{{ route('dash') }}"
            role="button">
            << Kembali
        </a>
        <span>&ensp; || &ensp;</span>
        <button name="save" id="save" class="btn btn-primary" wire:click="saveArsip">
            Simpan
        </button>
    </div>
</main>
