<x-guest-layout>
    <div class="pagetitle">
        <h1>Daftarkan Aset Baru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asets') }}">Aset</a></li>
                <li class="breadcrumb-item">Pendaftaran Aset</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Pendaftaran Aset</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('asets.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- jenis --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Barang</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example" name="jenis_barang">
                                        <option selected hidden>Pilih Jenis Aset</option>
                                        <option value="tanah">Tanah</option>
                                        <option value="bangunan">Bangunan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- luas --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Luas Aset</label>
                                <div class="input-group ">
                                    <input name="luas" type="number" class="form-control" placeholder="Nilai Luas Aset" aria-label="Nilai Luas Aset" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Meter</span>
                                </div>
                            </div>

                            {{-- alamat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-12">
                                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            {{-- lampiran --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Lampiran</label>
                                <div class="col-12">
                                    <input name="lampiran" class="form-control" type="file" />
                                </div>
                                <p style="color: red; font-size: 10px; font-style: italic; margin-left: 5px">noted: Lampirkan berkas pendukung Aset seperti Sertifikat atau semisalnya dalam 1 format pdf</p>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Daftarkan</button>
                                <button type="button" class="btn btn-warning text-white" onclick="window.location.href='/asets'">Batal</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>
