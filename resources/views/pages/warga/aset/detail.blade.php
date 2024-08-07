<x-guest-layout>

    <div class="pagetitle">
        <h1>Detail Data Assets</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asets') }}">Assets</a></li>
                <li class="breadcrumb-item">Assets Detail</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            {{-- detail --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">NIK: {{ $aset->warga->user->nik }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="col-2">Nama</td>
                                    <td>{{ $aset->warga->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Barang</td>
                                    <td>
                                        @if ($aset->jenis_barang == 'tanah')
                                        <span class="badge rounded-pill bg-warning">Tanah</span>
                                        @else
                                        <span class="badge rounded-pill bg-info">Bangunan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Luas</td>
                                    <td>{{ number_format($aset->luas, 0, ',','.') }} Meters</td>
                                </tr>
                                <tr>
                                    <th>Alamat</td>
                                    <td>{{ $aset->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <a href="{{ route('admin.aset.edit',$aset->hashid) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
            {{-- suratan --}}
            <div class="col-6">
                <div class="card p-4">
                    <h5 class="card-title">
                        Surat Sporadik
                    </h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No Surat</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sporadik as $item)
                            <tr>
                                <th><a href="{{ route('aset.sporadik.detail', ['id_aset' => $aset->hashid, 'id_sporadik' => $item->hashid]) }}">{{ $item->no_surat }}</a></th>
                                <td>{{ $item->jenis_surat }}</td>
                                <td>{{ $item->tanggal_surat }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <div class="card p-4">
                    <h5 class="card-title">
                        Surat Pajak Bumi Bangunan (PBB)
                    </h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No Surat</th>
                                <th>Perihal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pbb as $item)
                            <tr>
                                <th><a href="{{ route('aset.pbb.detail', ['id_aset' => $aset->hashid, 'id_pbb' => $item->hashid]) }}">{{ $item->no_surat }}</a></th>
                                <td>{{ $item->perihal }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
