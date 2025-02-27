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
                        <form class="row g-3" action="{{ route('pengajuan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            {{-- no_surat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Surat</label>
                                <select name="jenis_surat" id="jenis_surat" class="form-control">
                                    <option>Pilih Jenis Surat</option>
                                    <option value="pbb" {{ old('jenis_surat') == 'pbb'?'selected':'' }}>PBB</option>
                                    <option value="sporadik" {{ old('jenis_surat') == 'sporadik'?'selected':'' }}>Sporadik</option>
                                </select>
                            </div>

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" name="tanggal" value="{{ old('date') }}" class="form-control" aria-describedby="basic-addon2">
                            </div>

                            {{-- Perihal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Perihal</label>
                                <input type="text" name="perihal" value="{{ old('perihal') }}" class="form-control" placeholder="Masukan Perihal Surat" aria-label="Masukan Perihal Surat" aria-describedby="basic-addon2">
                            </div>

                            {{-- keterangan --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>

                            {{-- Perihal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Lampiran</label>
                                <input type="file" name="lampiran" class="form-control" aria-describedby="basic-addon2">
                                <p style="margin:0; padding:0; color: red; font-size: 10px; font-style: italic; margin-left: 5px">noted:</p>
                                <p style="margin:0; padding:0; color: red; font-size: 10px; font-style: italic; margin-left: 5px">1. Lampirkan berkas persyaratan dan kelengkapan pengajuan dalam 1 format pdf</p>
                                <p style="margin:0; padding:0; color: red; font-size: 10px; font-style: italic; margin-left: 5px" id="noted"></p>
                            </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-primary">Buat</button>
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
            const tanggal = document.querySelector('input[type="date"]');
            const today = new Date();
            tanggal.value = today.toISOString().substr(0, 10);
        });
        document.addEventListener('DOMContentLoaded', ()=>{
            const jenis_surat = document.querySelector('#jenis_surat');
            jenis_surat.addEventListener('change', ()=>{
                if(jenis_surat.value == 'pbb'){
                    document.querySelector('#noted').innerHTML = '2. Persyaratan berkas berupa: Surat pengantar RT, KK, KTP, Sertifikat tanah';
                }else if(jenis_surat.value == 'sporadik'){
                    document.querySelector('#noted').innerHTML = '2. Persyaratan berkas berupa: Surat pengantar RT, KK penjual, KTP penjual, KK pembeli, KTP pembeli, Sertifikat tanah, Ukuran tanah';
                }
            })
        })
    </script>

</x-guest-layout>
