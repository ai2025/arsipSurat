@section('title', 'Dashboard Arsip')
<main>
    <div>
        {{-- The whole world belongs to you. --}}
        <h1>Arsip Surat</h1>
        <hr>
        <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.
            <br>Klik "Lihat" pada kolom aksi untuk menampilkan surat.
        </p>

        <br>

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
        

        <div class="m-3" wire:ignore>
            <table id="list_arsip" class="table table-striped" style="width:100%;">
                <thead>
                    <tr>
                        {{-- <th>No.</th> --}}
                        <th>Nomor Surat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Waktu Pengarsipan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @php
                        $count = 1;
                    @endphp --}}
                    @foreach ($dataSurat as $i)
                        <tr>
                            {{-- <td>{{ $count++; }}</td> --}}
                            <td>{{ $i->nomor_surat }}</td>
                            <td>{{ $i->kategori }}</td>
                            <td>{{ $i->judul }}</td>
                            <td>{{ $i->created_at }}</td>
                            <td>
                                {{-- <button name="delete" id="delete" class="btn btn-danger"
                                wire:click="saveID({{ $i->sid }})"
                                data-toggle="modal" data-target="#mdlDelSrt">
                                    Hapus{{ $i->sid }}
                                </button> --}}
                                <!-- Button trigger modal -->
                                <button name="delete" id="delete"
                                type="button" class="btn btn-danger" 
                                data-bs-toggle="modal" data-bs-target="#mdlDelSrt"
                                wire:click="saveID({{ $i->sid }})">
                                    Hapus
                                </button>
                                <a name="unduh" id="unduh" class="btn btn-warning"
                                    href="{{ route('unduh', ['foldname' => $i->file_surat]) }}"
                                    role="button">
                                    Unduh
                                </a>
                                <a name="detail" id="detail" class="btn btn-primary"
                                    href="{{ route('detail', ['sid' => $i->sid]) }}"
                                    role="button">
                                    Lihat>>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            <a name="arsipkan" id="arsipkan" class="btn btn-outline-dark"
                href="{{ route('arsipkan') }}"
                role="button">
                Arsipkan Surat
            </a>
        </div>

        {{-- modal baru --}}
        <!-- Modal -->
        <div wire:ignore class="modal fade" id="mdlDelSrt" 
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdlDelSrtLabel" 
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="mdlDelSrtLabel">Alert!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="unsaveID"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Apakah Anda yakin ingin <strong>MENGHAPUS</strong> arsip surat ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal" wire:click="unsaveID">Batal</button>
                    <button type="button" class="btn btn-danger ms-auto" wire:click="delSrt">Ya!</button>
                    {{-- <div class="position-relative">
                        <div class="position-absolute top-50 start-0 translate-middle-y">
                            
                        </div>
                        <div class="position-absolute top-50 end-0 translate-middle-y">
                            
                        </div> --}}
                        
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
</main>