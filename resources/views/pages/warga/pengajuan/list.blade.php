<x-guest-layout>

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
                                    <th>Jenis Surat</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Respon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td><a href="{{ route('pengajuan.detail', $pengajuan->hashid) }}">#{{ $pengajuan->hashid }}</a></td>
                                    <td>
                                        @if ($pengajuan->jenis_surat == 'pbb')
                                        <span class="badge bg-primary">PBB</span>
                                        @elseif ($pengajuan->jenis_surat == 'sporadik')
                                        <span class="badge bg-success">Sporadik</span>
                                        @endif
                                    </td>
                                    <td>{{ $pengajuan->tanggal }}</td>
                                    <td>{{ $pengajuan->perihal }}</td>
                                    <td><a target="_blank" href="{{ asset('lampiran/warga/pengajuan').'/'.$pengajuan->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a></td>
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
                                        @if ($pengajuan->status == 'Diproses')
                                        <span class="">Belum Ada Tanggapan</span>
                                        @elseif ($pengajuan->status == 'Diterima')
                                            @if ($pengajuan->jenis_surat == 'pbb')
                                            <a href="{{ route('aset.pbb.detail', $pengajuan->pbb->hashid) }}">Lihat Balasan</a>
                                            @elseif ($pengajuan->jenis_surat == 'sporadik')
                                            <a href="{{ route('aset.sporadik.detail', $pengajuan->sporadik->hashid) }}">Lihat Balasan</a>
                                            @endif
                                        @elseif ($pengajuan->status == 'Ditolak')
                                        <span class="text-danger">{{ $pengajuan->pesan }}</span>
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

</x-guest-layout>
