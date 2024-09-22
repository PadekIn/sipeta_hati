<x-app-layout>

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">
                                Pengajuan Surat Warga
                            </h5>
                        </div>
                        <!-- Table with stripped rows -->
                        <table id="listTable" class="table datatable">
                            <thead>
                                <tr style="font-weight: bold">
                                    <td>Tiket Pengajuan</td>
                                    <td>Pemohon</td>
                                    <td>Jenis Surat</td>
                                    <td>Tanggal</td>
                                    <td>Perihal</td>
                                    {{-- <td class="no-print">Lampiran</td> --}}
                                    <td>Status</td>
                                    <td>Tanggapan</td>
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
                                    {{-- <td class="no-print">
                                        <a target="_blank" href="{{ asset('lampiran/warga/pengajuan').'/'.$pengajuan->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a>
                                    </td> --}}
                                    <td>
                                        @if ($pengajuan->status == 'Diproses')
                                        <span class="badge bg-warning">Diproses</span>
                                        @elseif ($pengajuan->status == 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                        @elseif ($pengajuan->status == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$pengajuan->pesan)
                                        <span class="">Dalam Proses</span>
                                        @else
                                        <span class="">{{ $pengajuan->pesan }}</span>
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

</x-app-layout>
