<x-app-layout>

    <div class="pagetitle">
        <h1>Data Pengajuan Surat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
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
                            <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">Buat Pengajuan Baru</a>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td>#{{ $pengajuan->hashid }}</td>
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
                                    <td>{{ $pengajuan->lampiran }}</td>
                                    <td>
                                        @if ($pengajuan->status == 'Diproses')
                                        <span class="badge bg-warning">Diproses</span>
                                        @elseif ($pengajuan->status == 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                        @elseif ($pengajuan->status == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>
