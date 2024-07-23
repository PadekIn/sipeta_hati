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
                        <form class="row g-3">
                            {{-- username --}}
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username">
                            </div>
                            {{-- password --}}
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="col-12">
                                <label for="confPassword" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="confPassword" class="form-control" id="confPassword">
                            </div>
                            {{-- role --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="warga">Warga</option>
                                    </select>
                                </div>
                            </div>


                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            </div>
                        </form><!-- Vertical Form -->
        
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>