<x-app-layout>

    <div class="pagetitle">
        <h1>Detail Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.warga') }}">Warga</a></li>
                <li class="breadcrumb-item">Detail Warga</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Detail Warga</h5>
                        {{-- NIK --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">NIK</div>
                            <div class="col-sm-10">
                                <strong>{{ $warga->user->nik }}</strong>
                            </div>
                        </div>
                        {{-- Role --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">Role</div>
                            <div class="col-sm-10">
                                {{ $warga->user->role }}
                            </div>
                        </div>
                        {{-- Status --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">Status</div>
                            <div class="col-sm-10">
                                @if ($warga->user->status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        {{-- Nama --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">Nama</div>
                            <div class="col-sm-10">
                                <strong>{{ $warga->nama }}</strong>
                            </div>
                        </div>
                        {{-- Alamat --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">Alamat</div>
                            <div class="col-sm-10">
                                {{ $warga->alamat }}
                            </div>
                        </div>
                        {{-- No Telp --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">No Handphone</div>
                            <div class="col-sm-10">
                                {{ $warga->no_telp }}
                            </div>
                        </div>
                        {{-- Jenis Kelamin --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">Jenis Jelamin</div>
                            <div class="col-sm-10">
                                @if ($warga->jenis_kelamin == "laki-laki")
                                    <span class="badge bg-primary">Laki-Laki</span>
                                @else
                                    <span class="badge bg-warning">Perempuan</span>
                                @endif
                            </div>
                        </div>
                        {{-- Tanggal Lahir --}}
                        <div class="row ">
                            <div  class="col-sm-2 col-form-label">Tanggal Lahir</div>
                            <div class="col-sm-10">
                                {{ $warga->tanggal_lahir }}
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('admin.warga.edit', $warga->hashId) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-warning text-white" onclick="window.location.href='/admin/warga'">Kembali</button>

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>
