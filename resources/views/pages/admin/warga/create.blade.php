<x-app-layout>

    <div class="pagetitle">
        <h1>Buat Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.warga') }}">Warga</a></li>
                <li class="breadcrumb-item">Buat Warga</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Form Tambah Warga</h5>
            
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('admin.warga.store') }}" method="POST">
                            @csrf 
                        
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        
                            {{-- NIK --}}
                            <div class="row mb-3">
                                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" required>
                                </div>
                            </div>
                            
                            {{-- Password --}}
                            <div class="row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>
                            
                            {{-- Konfirmasi Password --}}
                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                </div>
                            </div>
                            
                            {{-- Nama --}}
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') }}" required>
                                </div>
                            </div>

                            {{-- No HP --}}
                            <div class="row mb-3">
                                <label for="no_telp" class="col-sm-2 col-form-label">No Handphone</label>
                                <div class="col-sm-10">
                                    <input type="number" name="no_telp" class="form-control" id="no_telp" value="{{ old('no_telp') }}" required>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin" required>
                                        <option value="" disabled>Jenis Kelamin</option>
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tangal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                </div>
                            </div>
                        
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Buat</button>
                            </div>
                        </form>
                        <!-- Vertical Form -->
        
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>