<x-app-layout>

    <div class="pagetitle">
        <h1>Data Pengajuan Surat Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Pengajuan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Pengajuan Surat Warga
                        </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Tiket Pengajuan</th>
                                    <th>Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Keterangan</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td><a href="{{ route('admin.pengajuan.detail', $pengajuan->hashid) }}">#{{ $pengajuan->hashid }}</a></td>
                                    <td>{{ $pengajuan->warga->nama }}</td>
                                    <td>
                                        @if ($pengajuan->jenis_surat == 'pbb')
                                        <span class="badge bg-primary">PBB</span>
                                        @elseif ($pengajuan->jenis_surat == 'sporadik')
                                        <span class="badge bg-success">Sporadik</span>
                                        @endif
                                    </td>
                                    <td>{{ $pengajuan->tanggal }}</td>
                                    <td>{{ $pengajuan->perihal }}</td>
                                    <td>{{ $pengajuan->keterangan }}</td>
                                    <td>
                                        <a target="_blank" href="{{ asset('lampiran/warga/pengajuan').'/'.$pengajuan->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a>
                                    </td>
                                    <td>
                                        @if ($pengajuan->status == 'Diproses')
                                        <span class="badge bg-warning">Diproses</span>
                                        @elseif ($pengajuan->status == 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                        @elseif ($pengajuan->status == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($pengajuan->status == 'Diproses')
                                        <div class="d-flex">
                                            <a href="{{ route('admin.pengajuan.approved', [$pengajuan->jenis_surat, $pengajuan->hashid]) }}" class="btn btn-sm btn-success text-white">Terima</a>
                                            <div style="width: 10px;"></div>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-bs-id-pengajuan ="{{ $pengajuan->hashid }}"
                                                data-bs-nama-pemohon = "{{ $pengajuan->warga->nama }}">
                                                Tolak
                                            </button>
                                        </div>
                                        @else
                                        <span class="badge bg-info">Selesai</span>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="/admin/pengajuan/rejected/" method="post" id="rejected-form">
                                @csrf
                                @method('PATCH')
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-weight: bold" id="staticBackdropLabel">Tolak Pengajuan Surat <span id="pemohon">Warga</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Pesan/Alasan Penolakan</label>
                                        <textarea type="text" name="pesan" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget

            let id = button.getAttribute('data-bs-id-pengajuan');
            let nama = button.getAttribute('data-bs-nama-pemohon');
            let pemohon = document.getElementById('pemohon');
            pemohon.innerHTML = nama;

            const form = document.getElementById('rejected-form');
            form.action = `/admin/pengajuan/rejected/${id}`;
        })
    </script>

</x-app-layout>
