<x-guest-layout>

    <div class="pagetitle">
        <h1>Data Assets</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Aset</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('asets.create') }}" class="btn btn-primary">Daftarkan Aset</a>
                        </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Jenis Barang</th>
                                    <th>Luas</th>
                                    <th>Alamat</th>
                                    <th>Lampiran</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asets as $aset)
                                <tr>
                                    <td>
                                        <a href="{{ route('aset.detail', $aset->hashid) }}">
                                            #{{ $aset->hashid }}
                                        </a>
                                    </td>
                                    <td>{{ $aset->jenis_barang }}</td>
                                    <td>{{ $aset->luas }} meter</td>
                                    <td>{{ $aset->alamat }}</td>
                                    <td>
                                        <a target="_blank" href="{{ asset('lampiran/warga/aset').'/'.$aset->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a>
                                    </td>
                                    {{-- <td>
                                        <div class="d-flex">
                                            <a href="{{ route('asets.edit', $aset->hashid) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <div style="width: 10px;"></div>
                                            <button type="button" onclick="destroy('{{ $aset->hashid }}')" class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </td> --}}
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
