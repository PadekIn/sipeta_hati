<x-app-layout>

    <div class="pagetitle">
        <h1>Detail Data Assets</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Assets</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            {{-- detail --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Username: {{ Auth::user()->username }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <tbody>
                                {{-- <tr>
                                    <th class="col-3">Username</td>
                                    <td>bumeg</td>
                                </tr> --}}
                                <tr>
                                    <th class="col-2">Nama</td>
                                    <td>MegaWarso</td>
                                </tr>
                                <tr>
                                    <th>Jenis Barang</td>
                                    <td>
                                        <span class="badge rounded-pill bg-primary">Tanah</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Luas</td>
                                    <td>3000 Meters</td>
                                </tr>
                                <tr>
                                    <th>Alamat</td>
                                    <td>Jln. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam ipsa aliquam explicabo doloremque, doloribus, a quasi quaerat earum quisquam error dolor, natus illo voluptatem fugit consectetur similique dicta perspiciatis reprehenderit.</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <a href="{{ route('admin.aset.edit',1) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
            {{-- suratan --}}
            <div class="col-6">
                <div class="card p-4">
                    <h5 class="card-title">
                        Surat Saparodik
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
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Surat Cerai</td>
                                <td>20 November 1997</td>
                            </tr>
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Surat Cerai</td>
                                <td>20 November 1997</td>
                            </tr>
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Surat Cerai</td>
                                <td>20 November 1997</td>
                            </tr>
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
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Laporan</td>
                                <td>Lain-lain</td>
                            </tr>
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Laporan</td>
                                <td>Lain-lain</td>
                            </tr>
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Laporan</td>
                                <td>Lain-lain</td>
                            </tr>
                            <tr>
                                <th>782WGH98JI</th>
                                <td>Laporan</td>
                                <td>Lain-lain</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>