<x-app-layout>

    <div class="pagetitle">
        <h1>Data Sporadik</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Sporadik</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('admin.sporadik.create') }}" class="btn btn-primary">Buat Sporadik Baru</a>
                        </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No Surat</th>
                                    <th>Pemilik Lama</th>
                                    <th>Pemilik Baru</th>
                                    <th>Id Aset</th>
                                    <th>Jenis Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sporadiks as $sporadik)
                                <tr>
                                    <td>
                                       <a href="{{ route('admin.sporadik.detail', $sporadik->hashid) }}">
                                        {{ $sporadik->no_surat }}
                                       </a>
                                    </td>
                                    <td>{{ $sporadik->pemilik_lama->nama }}</td>
                                    <td>{{ $sporadik->pemilik_baru->nama }}</td>
                                    <td>
                                        <a href="{{ route('admin.aset.detail', $sporadik->aset->hashid) }}">
                                            {{ $sporadik->aset->hashid }}
                                        </a>
                                    </td>
                                    <td>{{ $sporadik->jenis_surat }}</td>
                                    <td>{{ $sporadik->tanggal_surat }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.sporadik.edit', $sporadik->hashid) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <div style="width: 10px;"></div>
                                            <button onclick="destroy('{{ $sporadik->hashid }}')" class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </td>
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
                    window.location.href = `/admin/sporadik/destroy/${id}`;
                }
            })
        };
    </script>

</x-app-layout>
