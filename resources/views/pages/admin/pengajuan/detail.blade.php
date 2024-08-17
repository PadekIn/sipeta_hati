<x-app-layout>

    <div class="pagetitle">
        <h1>Detail Pengajuan Surat Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Pengajuan Surat</a></li>
                <li class="breadcrumb-item">Detail</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            {{-- detail --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tiket Pengajuan: #{{ $pengajuan->hashid }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="col-2">Nama Pemohon</td>
                                    <td>{{ $pengajuan->warga->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Surat</td>
                                    <td>{{ $pengajuan->jenis_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</td>
                                    <td>{{ $pengajuan->tanggal }}</td>
                                </tr>
                                <tr>
                                    <th>Perihal</td>
                                    <td>{{ $pengajuan->perihal }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</td>
                                    <td>{{ $pengajuan->keterangan }}</td>
                                </tr>
                                <tr>
                                    <th>Lampiran Pengajuan</td>
                                    <td>
                                        <a target="_blank" href="{{ asset('lampiran/warga/pengajuan').'/'.$pengajuan->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</td>
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
                                <tr>
                                    <th>Respon</td>
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
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <button type="button" class="btn btn-warning text-white" onclick="history.back()">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
