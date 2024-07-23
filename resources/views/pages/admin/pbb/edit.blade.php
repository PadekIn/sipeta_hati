<x-app-layout>

    <div class="pagetitle">
        <h1>Edit Data Pajak Bumi Bangunan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pbb') }}">Pajak Bumi Bangunan</a></li>
                <li class="breadcrumb-item">Edit Pajak Bumi Bangunan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Pajak Bumi Bangunan</h5>
            
                        <!-- Vertical Form -->
                        <form class="row g-3">

                            {{-- Aset --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Aset</label>
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

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" class="form-control" placeholder="20, Juli 2020" aria-label="20, Juli 2020" aria-describedby="basic-addon2">
                            </div>

                            {{-- Perihal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <input type="text" class="form-control" placeholder="Masukan Perihal Surat" aria-label="Masukan Perihal Surat" aria-describedby="basic-addon2">
                            </div>

                            {{-- keterangan --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-12">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
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