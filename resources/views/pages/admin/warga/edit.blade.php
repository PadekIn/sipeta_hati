<x-app-layout>

    <div class="pagetitle">
        <h1>Edit Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.warga') }}">Warga</a></li>
                <li class="breadcrumb-item">Edit Data Pengguna</li>
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
                        <form class="row g-3">
                            {{-- username --}}
                            <div class="col-12">
                                <label for="nama" class="form-label">nama</label>
                                <input type="text" name="nama" class="form-control" id="nama">
                            </div>
                            {{-- password --}}
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamaat</label>
                                <input type="password" name="alamat" class="form-control" id="alamat">
                            </div>
                            <div class="col-12">
                                <label for="no_telpn" class="form-label">Nomor Handphone</label>
                                <input type="number" name="no_telpn" class="form-control" id="no_telpn">
                            </div>

                            {{-- role --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Kelamin</option>
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                            </div>


                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form><!-- Vertical Form -->
        
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>