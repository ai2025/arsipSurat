@section('title', 'Detail Arsip')
<main>
    <div>
        {{-- Because she competes with no one, no one can compete with her. --}}

        <div class="ms-5">
            <h1>Arsip Surat >> Lihat</h1>
            <hr>
            <p>Nomor: {{ $nomor_surat }}</p>
            <p>Kategori: {{ $kategori }}</p>
            <p>Judul: {{ $judul }}</p>
            <p>Waktu Unggah: {{ $created_at }}</p>
        </div>

        <br>
        	
        <div class="mx-auto" style="width: 90%;">
            <iframe src="{{ asset('/storage/file-surat/' . $file_surat) }}" width="100%" height="500px"></iframe>
        </div>
        <br>

        <div class="ms-5">
            <a name="dash" id="dash" class="btn btn-outline-dark"
                href="{{ route('dash') }}"
                role="button">
                << Kembali
            </a>
            <a name="unduh" id="unduh" class="btn btn-outline-dark"
                href="{{ route('unduh', ['foldname' => $file_surat]) }}"
                role="button">
                Unduh
            </a>
            <a name="ubah" id="ubah" class="btn btn-outline-dark"
                href="{{ route('ubah', ['sid' => $sid]) }}"
                role="button">
                Edit/Ganti File
            </a>
            {{-- <button name="ganti" id="ganti"
                type="button" class="btn btn-outline-dark" 
                data-bs-toggle="modal" data-bs-target="#ganti">
                Edit/Ganti File
            </button> --}}
        </div>

    </div>
</main>
