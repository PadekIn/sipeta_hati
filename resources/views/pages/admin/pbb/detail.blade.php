<x-app-layout>

    <div class="pagetitle">
        <h1>Detail Surat PBB</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pbb') }}">Surat</a></li>
                <li class="breadcrumb-item">PBB</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            {{-- detail --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nomor Surat: {{ $pbb->no_surat }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="col-2">Tiket Pengajuan</td>
                                    <td> <a href="{{ route('admin.pengajuan.detail', $pbb->pengajuan->hashid) }}">{{ $pbb->pengajuan->hashid }}</a></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Nama Warga</td>
                                    <td>{{ $pbb->pengajuan->warga->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</td>
                                    <td>{{ $pbb->tanggal_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Perihal</td>
                                    <td>{{ $pbb->pengajuan->perihal }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</td>
                                    <td>{{ $pbb->pengajuan->keterangan }}</td>
                                </tr>
                                <tr>
                                    <th>Aset</td>
                                    <td>{{ $pbb->jenis_barang }} - {{ $pbb->luas }} meter</td>
                                </tr>
                                <tr>
                                    <th>Lokasi Aset</td>
                                    <td>{{ $pbb->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Lampiran</td>
                                    <td>
                                        <a target="_blank" href="{{ asset('lampiran/admin/pbb').'/'.$pbb->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a>
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
