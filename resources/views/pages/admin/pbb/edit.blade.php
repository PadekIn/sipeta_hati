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
                        <form class="row g-3" action="{{ route('admin.pbb.update', $pbb->hashid) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            {{-- no_surat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Nomer Surat</label>
                                <input type="text" name="no_surat" value="{{ old('no_surat', $pbb->no_surat) }}" class="form-control" placeholder="001/PBB/VIII/2024" aria-label="001/PBB/VIII/2024" aria-describedby="basic-addon2">
                            </div>

                            {{-- pengajuan --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Surat Pengajuan</label>
                                <div class="col-12">
                                    <select name="pengajuan_id" class="form-select" aria-label="Default select example">
                                        <option selected hidden>Pilih Surat Pengajuan</option>
                                        $@foreach ($pengajuans as $pengajuan)
                                        <option value="{{ $pengajuan->hashid }}" {{ old('pengajuan_id') == $pengajuan->hashid || $pbb->pengajuan->hashid == $pengajuan->hashid?'selected':'' }}>{{ $pengajuan->hashid }} - {{ $pengajuan->warga->nama }} - {{ $pengajuan->perihal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $pbb->tanggal_surat) }}" class="form-control" aria-describedby="basic-addon2">
                            </div>

                            {{-- aset --}}
                            <div id="aset_selection" class="col-12 {{ old('aset_id') == 'input_manual' || $aset_id == 'input_manual' ?'':'d-none' }}">
                                <label class="col-sm-2 col-form-label">Aset Warga</label>
                                <div class="col-12">
                                    <select name="aset_id" class="form-select" aria-label="Default select example">
                                        <option selected disabled hidden>Pilih Aset Warga</option>
                                        $@isset($asets)
                                            $@foreach ($asets as $aset)
                                            <option value="{{ $aset->hashid }}" {{ old('aset_id') == $aset->hashid || $aset_id == $aset->hashid ?'selected':'' }}>{{ $aset->warga->nama }} - {{ $aset->jenis_barang }} - {{ $aset->luas }} meter</option>
                                            @endforeach
                                        @endisset
                                        <option value="input_manual">Input Manual</option>
                                    </select>
                                </div>
                            </div>

                            {{-- jenis --}}
                            <div id="jenis_barang" class="col-12 {{ old('aset_id') == 'input_manual' || $aset_id == 'input_manual' ?'d-none':'' }}">
                                <label class="col-sm-2 col-form-label">Jenis Barang</label>
                                <div class="col-12">
                                    <select class="form-select" aria-label="Default select example" name="jenis_barang">
                                        <option selected hidden>Pilih Jenis Aset</option>
                                        <option value="tanah" {{ old('jenis_barang') == 'tanah' || $pbb->jenis_barang == 'tanah'?'selected' :'' }}>Tanah</option>
                                        <option value="bangunan" {{ old('jenis_barang') == 'bangunan' || $pbb->jenis_barang == 'bangunan'?'selected' :'' }}>Bangunan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- luas --}}
                            <div id="luas" class="col-12 {{ old('aset_id') == 'input_manual' || $aset_id == 'input_manual' ?'d-none':'' }}">
                                <label class="col-sm-2 col-form-label">Luas Aset</label>
                                <div class="input-group ">
                                    <input name="luas" type="text" value="{{ old('luas', $pbb->luas) }}" class="form-control" placeholder="Nilai Luas Aset" aria-label="Nilai Luas Aset" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Meter</span>
                                </div>
                            </div>

                            {{-- alamat --}}
                            <div id="alamat" class="col-12 {{ old('aset_id') == 'input_manual' || $aset_id == 'input_manual' ?'d-none':'' }}">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-12">
                                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('alamat', $pbb->alamat) }}</textarea>
                                </div>
                            </div>

                            {{-- Lampiran --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Lampiran</label>
                                <input type="file" name="lampiran" class="form-control">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('select[name="aset_id"]').addEventListener('change', function() {
                let aset_selection = document.getElementById('aset_selection');
                let jenis_barang = document.getElementById('jenis_barang');
                let luas = document.getElementById('luas');
                let alamat = document.getElementById('alamat');

                if (this.value == 'input_manual') {
                    aset_selection.classList.add('d-none');
                    jenis_barang.classList.remove('d-none');
                    luas.classList.remove('d-none');
                    alamat.classList.remove('d-none');
                } else {
                    aset_selection.classList.remove('d-none');
                    jenis_barang.classList.add('d-none');
                    luas.classList.add('d-none');
                    alamat.classList.add('d-none');
                }
            });
        });
    </script>

</x-app-layout>
