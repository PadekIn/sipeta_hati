<x-guest-layout>

    <div class="pagetitle">
        <h1>My Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">My Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            {{-- muka --}}
            {{-- <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ Auth::user()->username }}</h2>
                        <h3>{{ Auth::user()->role }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- content --}}
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            {{-- <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li> --}}
                        </ul>
                        {{-- body --}}
                        <div class="tab-content pt-2">
                            {{-- profile --}}
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                {{-- NIK --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">NIK</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->nik }}</div>
                                </div>
                                {{-- Nama --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->warga->nama }}</div>
                                </div>
                                {{-- Jenis kelamin --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (Auth::user()->warga->jenis_kelamin === 'perempuan')
                                        <span class="badge rounded-pill bg-danger">Perempuan</span>
                                        @else
                                        <span class="badge rounded-pill bg-warning">Laki-laki</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- Tanggal Lahir --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->warga->tanggal_lahir }}</div>
                                </div>
                                {{-- no_telp --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor Handphone</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->warga->no_telp }}</div>
                                </div>
                                {{-- Alamat --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->warga->alamat }}</div>
                                </div>
                                {{-- Lampiran --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Lampiran</div>
                                    <div class="col-lg-9 col-md-8"><a target="_blank" href="{{ asset('lampiran/warga/pengajuan').'/'.Auth::user()->warga->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a></div>
                                </div>
                            </div>
                            <div class="">
                                <a href="{{ route('profile.edit') }}" class="btn btn-warning bt-sm text-white">Edit</a>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
