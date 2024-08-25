<x-guest-layout>

    <div class="pagetitle">
        <h1>Edit Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profile') }}">My Profile</a></li>
                <li class="breadcrumb-item">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Warga</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('profile.update', $warga->hashId) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            {{-- Nama --}}
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $warga->nama) }}" required>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin" required>
                                        <option value="" disabled {{ is_null($warga->jenis_kelamin) ? 'selected' : '' }}>Jenis Kelamin</option>
                                        <option value="laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir', $warga->tanggal_lahir) }}" required>
                                </div>
                            </div>

                            {{-- No HP --}}
                            <div class="row mb-3">
                                <label for="no_telp" class="col-sm-2 col-form-label">No Handphone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{ old('no_telp', $warga->no_telp) }}" required>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat', $warga->alamat) }}" required>
                                </div>
                            </div>

                            {{-- Lampiran --}}
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Lampiran</label>
                                <div class="col-sm-10">
                                    <input type="file" name="lampiran" class="form-control" id="lampiran">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-warning text-white" onclick="history.back()">Batal</button>
                            </div>
                        </form>

                        <!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>
