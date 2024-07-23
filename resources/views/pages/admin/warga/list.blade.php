<x-app-layout>

    <div class="pagetitle">
        <h1>Data Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Warga</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
    
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-between content-center w-full">
                            <h5 class="card-title">
                                <a href="{{ route('admin.warga.create') }}" class="btn btn-primary">Tambah Warga</a>
                            </h5>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Alamat</th>
                                    <th>No Handphone</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Budi Harjo</td>
                                    <td>budiJee</td>
                                    <td>Jln. Lorem ipsum dolor sit amet consectetur.</td>
                                    <td>08223648718</td>
                                    <td>
                                        <span class="badge rounded-pill bg-primary">Laki-Laki</span>
                                    </td>
                                    <td>22-Januari-2024</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                            <div style="width: 10px;"></div>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Budi Harjo</td>
                                    <td>budiJee</td>
                                    <td>Jln. Lorem ipsum dolor sit amet consectetur.</td>
                                    <td>08223648718</td>
                                    <td>
                                        <span class="badge rounded-pill bg-success">Perempuan</span>
                                    </td>
                                    <td>22-Januari-2024</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.warga.edit', 1) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <div style="width: 10px;"></div>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
    
            </div>
        </div>
    </section>

</x-app-layout>