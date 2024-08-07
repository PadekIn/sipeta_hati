<x-app-layout>

    <div class="pagetitle">
        <h1>Detail Data PBB</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pbb') }}">PBB</a></li>
                <li class="breadcrumb-item">PBB Detail</li>
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
                                    <th class="col-2">Nama</td>
                                    <td>{{ $pbb->aset->warga->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Aset</td>
                                    <td>{{ $pbb->aset->jenis_barang }} - {{ $pbb->aset->luas }} meter</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</td>
                                    <td>{{ $pbb->tanggal_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Perihal</td>
                                    <td>{{ $pbb->perihal }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</td>
                                    <td>{{ $pbb->keterangan }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <a href="{{ route('admin.pbb.edit',$pbb->hashid) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
