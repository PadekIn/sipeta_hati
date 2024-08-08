<x-app-layout>

    <div class="pagetitle">
        <h1>Edit Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">Admin</a></li>
                <li class="breadcrumb-item">Edit Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    {{-- Edit Role And Status --}}
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">NIK : {{ $admin->nik }}</h5>
                        <h5 class="card-title">Form Edit Role Dan Status</h5>
            
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('admin.user.update', $admin->hashId) }}" method="POST">
                            @csrf
                            @method('PATCH')
                        
                            {{-- Role --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="role" required>
                                        <option value="" disabled>Pilih Role</option>
                                        <option value="admin" {{ $admin->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="warga" {{ $admin->role === 'warga' ? 'selected' : '' }}>Warga</option>
                                    </select>
                                </div>
                            </div>
                        
                            {{-- Status --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="status" required>
                                        <option value="" disabled {{ is_null($admin->status) ? 'selected' : '' }}>Pilih Status</option>
                                        <option value="1" {{ $admin->status == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $admin->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                        
                        <!-- Vertical Form -->
        
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Edit Password --}}
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Password Admin</h5>
            
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('admin.user.updatePass', $admin->hashId) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            {{-- password Lama --}}
                            <div class="col-12">
                                <label for="current_password" class="form-label">Password Lama</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Password Lama" required />
                            </div>
                            
                            {{-- password --}}
                            <div class="col-12">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>

                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </form><!-- Vertical Form -->
        
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>