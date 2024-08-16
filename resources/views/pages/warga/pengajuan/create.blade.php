<x-guest-layout>

    <div class="pagetitle">
        <h1>Buat Pengajuan Pembuatan Surat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengajuan') }}">Pengajuan</a></li>
                <li class="breadcrumb-item">Surat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Pengajuan Pembuatan Surat</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('pengajuan.store') }}" method="post">
                            @csrf

                            {{-- no_surat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Surat</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option>Pilih Jenis Surat</option>
                                    <option value="pbb">PBB</option>
                                    <option value="sporadik">Sporadik</option>
                                </select>
                            </div>

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" name="tanggal" class="form-control" aria-describedby="basic-addon2">
                            </div>

                            {{-- Perihal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <input type="text" name="perihal" class="form-control" placeholder="Masukan Perihal Surat" aria-label="Masukan Perihal Surat" aria-describedby="basic-addon2">
                            </div>

                            {{-- keterangan --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            {{-- Perihal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Lampiran</label>
                                <input type="file" name="lampiran" class="form-control" aria-describedby="basic-addon2">
                                <p style="color: red; font-size: 10px; font-style: italic; margin-left: 5px">noted: Lampirkan berkas persyaratan dan kelengkapan pengajuan dalam 1 format pdf</p>
                            </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Buat</button>
                                <button type="button" class="btn btn-warning" onclick="history.back()">Kembali</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>
