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
                        <form class="row g-3" action="{{ route('admin.pbb.update', $pbb->hashid) }}" method="post">
                            @csrf
                            @method('PATCH')
                            {{-- Aset --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Aset</label>
                                <div class="col-12">
                                    <select name="aset_id" class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Aset</option>
                                        $@foreach ($asets as $aset)
                                        <option value="{{ $aset->hashid }}" {{ $aset->hashid == $pbb->aset->hashid?'selected':'' }}>{{ $aset->warga->nama }} - {{ $aset->jenis_barang }} - {{ $aset->luas }} meter</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- no_surat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Nomer Surat</label>
                                <input type="text" name="no_surat" class="form-control" placeholder="001/PBB/VIII/2024" value="{{ $pbb->no_surat }}">
                            </div>

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" class="form-control" name="tanggal_surat" value="{{ $pbb->tanggal_surat }}">
                            </div>

                            {{-- Perihal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <input type="text" name="perihal" class="form-control" placeholder="Masukan Perihal Surat" value="{{ $pbb->perihal }}">
                            </div>

                            {{-- keterangan --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3">{{ $pbb->keterangan }}</textarea>
                                </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <button type="button" class="btn btn-warning" onclick="history.back()">Kembali</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>
