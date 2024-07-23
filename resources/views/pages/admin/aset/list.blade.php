<x-app-layout>

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
                            <a href="{{ route('admin.aset.create') }}" class="btn btn-primary">Daftarkan Aset Baru</a>
                        </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Pemilik</th>
                                    <th>Jenis Barang</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.aset.detail',1) }}">
                                            H3298R-2TR8G
                                        </a>
                                    </td>
                                    <td>Budi Harjo</td>
                                    <td>Tanah</td>
                                    <td>Jln. Lorem ipsum dolor sit amet consectetur.</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.aset.edit', 1) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <div style="width: 10px;"></div>
                                            <button id="deleteBtn" class="btn btn-sm btn-danger">Delete</button>
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

    <script>
        document.getElementById('deleteBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Ingin menghapus data Aset Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Aku Yakin!',
                cancelButtonText: 'Tidak, Batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action here
                    Swal.fire(
                        'Terhapus!',
                        'Data Aset Telah di Hapus.',
                        'Berhasil'
                    )
                }
            })
        });
    </script>

</x-app-layout>