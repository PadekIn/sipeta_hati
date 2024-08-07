<x-app-layout>

    <div class="pagetitle">
        <h1>Edit Data Sporadik</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sporadik') }}">Sporadik</a></li>
                <li class="breadcrumb-item">Edit Sporadik</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Sporadik</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3">

                            {{-- pemilik lama --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pemilik Lama</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Pemilik Lama</option>
                                        <option value="">Joko</option>
                                        <option value="">Budi</option>
                                    </select>
                                </div>
                            </div>

                            {{-- pemilik baru --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pemilik Baru</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Pemilik Baru</option>
                                        <option value="">Joko</option>
                                        <option value="">Budi</option>
                                    </select>
                                </div>
                            </div>

                            {{-- aset --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pilih Aset</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Aset</option>
                                        <option value="">Joko - Tanah - 2000m2</option>
                                        <option value="">Joko - Tanah - 2000m2</option>
                                        <option value="">Joko - Tanah - 2000m2</option>
                                    </select>
                                </div>
                            </div>

                            {{-- no_surat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Nomer Surat</label>
                                <input type="text" class="form-control" placeholder="BCY8922V2Y" aria-label="BCY8922V2Y" aria-describedby="basic-addon2">
                            </div>

                            {{-- jenis --}}
                            {{-- <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Surat</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Jenis Surat</option>
                                        <option value="">Surat Masuk</option>
                                        <option value="">Surat Keluar</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Surat</label>
                                <input type="text" class="form-control" placeholder="Masukan Jenis Surat" aria-label="Masukan Jenis Surat" aria-describedby="basic-addon2">
                            </div>

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" class="form-control" placeholder="20, Juli 2020" aria-label="20, Juli 2020" aria-describedby="basic-addon2">
                            </div>


                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>
