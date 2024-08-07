<x-guest-layout>

    <div class="pagetitle">
        <h1>Detail Data Sporadik</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asets') }}">Assets</a></li>
                <li class="breadcrumb-item">Sporadik Detail</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            {{-- detail --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nomor Surat: {{ $sporadik->no_surat }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="col-2">Pemilik Lama</td>
                                    <td>{{ $sporadik->pemilik_lama->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-2">Pemilik Baru</td>
                                    <td>{{ $sporadik->pemilik_baru->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Aset</td>
                                    <td>{{ $sporadik->aset->jenis_barang }} - {{ $sporadik->aset->luas }} meter</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</td>
                                    <td>{{ $sporadik->tanggal_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Surat</td>
                                    <td>{{ $sporadik->jenis_surat }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <a href="{{ route('admin.sporadik.edit',$sporadik->hashid) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
