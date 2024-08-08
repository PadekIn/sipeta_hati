<x-app-layout>

    <div class="pagetitle">
        <h1>Data Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
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
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>No Handphone</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($warga) !== 0)
                                    @foreach ($warga as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('admin.warga.detail', $user->hashId) }}">{{ $user->nama }}</a>
                                        </td>
                                        <td>{{ $user->user->nik }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td>{{ $user->no_telp }}</td>
                                        <td>
                                            @if ($user->jenis_kelamin == 'laki-laki')
                                                <span class="badge rounded-pill bg-primary">Laki-laki</span>
                                            @else
                                                <span class="badge rounded-pill bg-warning">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->tanggal_lahir }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.warga.edit', $user->hashId) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <div style="width: 10px;"></div>
                                                {{-- <button onclick="destroy('{{ $user->hashid }}')" class="btn btn-sm btn-danger">Delete</button> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr rowspan="8">
                                        <td>Data Warga Masih Kosong</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function destroy(id) {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Ingin menghapus data Pajak Bumi Bangunan Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Aku Yakin!',
                cancelButtonText: 'Tidak, Batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/warga/destroy/${id}`;
                }
            })
        };
    </script>

</x-app-layout>
