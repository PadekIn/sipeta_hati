<x-app-layout>

    <div class="pagetitle">
        <h1>Buat Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">Admin</a></li>
                <li class="breadcrumb-item">Buat Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Admin</h5>
            
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('admin.user.store') }}" method="POST">
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
                            <div class="col-12">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" required>
                            </div>
                        
                            {{-- Password --}}
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                        
                            {{-- Konfirmasi Password --}}
                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
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