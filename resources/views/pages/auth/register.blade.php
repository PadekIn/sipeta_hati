<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center py-4">
                        <span class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('img/logo/logo_jambi2.png') }}" alt="">
                            <span class="d-none d-lg-block">Kelurahan Sengeti</span>
                        </span>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-5">Register to Create Account</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="nik" class="form-label">NIK</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" placeholder="Enter your NIK" required>
                                        <div class="invalid-feedback">Masukkan Nomor Induk Kependudukan</div>
                                    </div>
                                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap" required>
                                        <div class="invalid-feedback">Nama Lengkap</div>
                                    </div>
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <div class="input-group has-validation">
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                            <option>Pilih Jenis Kelamin</option>
                                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki'?'selected':'' }}>Laki-Laki</option>
                                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan'?'selected':'' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">+62</span>
                                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}" id="no_telp" placeholder="Masukkan Nomor Telepon" required>
                                        <div class="invalid-feedback">Masukkan Nomor Telepon</div>
                                    </div>
                                    <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <div class="input-group has-validation">
                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" id="tanggal_lahir" placeholder="Pilih Tanggal Lahir" required>
                                        <div class="invalid-feedback">Pilih Tanggal Lahir</div>
                                    </div>
                                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <div class="input-group has-validation">
                                        <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" required>{{ old('alamat') }}</textarea>
                                        <div class="invalid-feedback">Masukkan Alamat</div>
                                    </div>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" placeholder="******" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Register</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Already have account? <a href="/login">Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</x-auth-layout>
