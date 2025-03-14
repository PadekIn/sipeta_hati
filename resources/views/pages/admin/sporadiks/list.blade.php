<x-app-layout>

    <div class="pagetitle">
        <h1>Data Surat Sporadik</h1>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">
                                <a href="{{ route('admin.sporadik.create') }}" class="btn btn-primary">Buat Surat Baru</a>
                            </h5>
                            {{-- <button class="btn btn-sm btn-warning text-white" id="btn-print">Print</button> --}}
                        </div>
                        <!-- Table with stripped rows -->
                        <table id="listTable" class="table datatable">
                            <thead>
                                <tr style="font-weight: bold">
                                    <td>No Surat</td>
                                    <td>Tiket Pengajuan</td>
                                    <td>Pemohon</td>
                                    <td>Perihal</td>
                                    <td>Keterangan</td>
                                    <td>Tanggal Surat</td>
                                    <td class="no-print">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sporadiks as $sporadik)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.sporadik.detail', $sporadik->hashid) }}">{{ $sporadik->no_surat }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pengajuan.detail', $sporadik->pengajuan->hashid) }}">
                                            #{{ $sporadik->pengajuan->hashid }}
                                        </a>
                                    </td>
                                    <td>{{ $sporadik->pengajuan->warga->nama }}</td>
                                    <td>{{ $sporadik->pengajuan->perihal }}</td>
                                    <td>{{ $sporadik->pengajuan->keterangan }}</td>
                                    <td>{{ $sporadik->tanggal_surat }}</td>
                                    <td class="no-print">
                                        <div class="d-flex">
                                            <a href="{{ route('admin.sporadik.edit', $sporadik->hashid) }}" class="btn btn-sm btn-warning text-white">Edit</a>
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
