<x-app-layout>

    <div class="pagetitle">
        <h1>Edit Data Aset</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.aset') }}">Aset</a></li>
                <li class="breadcrumb-item">Edit Data Aset</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Aset</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('admin.aset.update', $aset->hashid) }}" method="post">
                            @csrf
                            @method('PATCH')

                            {{-- user --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pemilik</label>
                                <div class="col-12">
                                    <select name="warga_id" class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Pemilik Aset</option>
                                        @foreach ($warga as $item)
                                        <option value="{{ $item->hashid }}" {{ $item->hashid == $aset->warga->hashid ? 'Selected':'' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- jenis --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Barang</label>
                                <div class="col-12">
                                    <select name="jenis_barang" class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Jenis Aset</option>
                                        <option value="tanah" {{ $aset->jenis_barang =='tanah'?'selected':'' }}>Tanah</option>
                                        <option value="bangunan" {{ $aset->jenis_barang == 'bangunan'?'selected':'' }}>Bangunan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- luas --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Luas Aset</label>
                                <div class="input-group ">
                                    <input name="luas" type="text" class="form-control" value="{{ $aset->luas }}" placeholder="Nilai Luas Aset" aria-label="Nilai Luas Aset" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Meter</span>
                                </div>
                            </div>

                            {{-- almaat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-12">
                                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $aset->alamat }}</textarea>
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
