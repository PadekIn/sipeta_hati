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
                        <h5 class="card-title">Form Buat Sporadik</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('admin.sporadik.update',  $sporadik->hashid  ) }}" method="post">
                            @csrf
                            @method('PATCH')
                            {{-- aset --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pilih Aset</label>
                                <div class="col-12">
                                    <select name="aset_id" class="form-select" aria-label="Default select example">
                                        <option>Pilih Aset</option>
                                        @foreach ($asets as $aset)
                                            <option value="{{ $aset->hashid }}" data-warga-id="{{ $aset->warga->hashid }}" {{ $sporadik->aset->hashid == $aset->hashid?'selected':'' }}>{{ $aset->warga->nama }}-{{ $aset->jenis_barang }}-{{ $aset->luas }}meter</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- pemilik lama --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pemilik Lama</label>
                                <div class="col-12">
                                    <input type="text" name="pemilik_lama_id" class="d-none" id="pemilik_lama_id" value="{{ $sporadik->pemilik_lama_id }}">
                                    <span class="form-control" id="pemilik_lama">{{ $sporadik->pemilik_lama->nama }}</span>
                                </div>
                            </div>

                            {{-- pemilik baru --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Pemilik Baru</label>
                                <div class="col-12">
                                    <select name="pemilik_baru_id" class="form-select" aria-label="Default select example">
                                        <option>Pilih Pemilik Baru</option>
                                        @foreach ($warga as $people)
                                        <option value="{{ $people->hashid }}" {{ $people->hashid == $sporadik->pemilik_baru->hashid?'selected':'' }}>{{ $people->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- no_surat --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                <input type="text" name="no_surat" value="{{ $sporadik->no_surat }}" class="form-control" placeholder="01/SPORADIK/VIII/2024" aria-label="01/SPORADIK/VIII/2024" aria-describedby="basic-addon2">
                            </div>

                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Jenis Surat</label>
                                <input type="text" name="jenis_surat" class="form-control" value="{{ $sporadik->jenis_surat }}" placeholder="Masukan Jenis Surat" aria-label="Masukan Jenis Surat" aria-describedby="basic-addon2">
                            </div>

                            {{-- tanggal --}}
                            <div class="col-12">
                                <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control" value="{{ $sporadik->tanggal_surat }}">
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Buat</button>
                                <button type="button" class="btn btn-warning">Kembali</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectAset = document.querySelector('select[name="aset_id"]');
        let pemilikLamaId = document.querySelector('#pemilik_lama_id');
        let pemilikLama = document.querySelector('#pemilik_lama');
        let pemilikBaru = document.querySelector('select[name="pemilik_baru_id"]');

        selectAset.addEventListener('change', function() {
            let wargaId = this.options[this.selectedIndex].getAttribute('data-warga-id');
            let wargaName = this.options[this.selectedIndex].text;

            pemilikLamaId.value = wargaId;
            pemilikLama.textContent = wargaName.split('-')[0];

            if(pemilikLama.textContent == pemilikBaru.options[pemilikBaru.selectedIndex].text) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pemilik Baru tidak boleh sama dengan Pemilik Lama',
                    showConfirmButton: false,
                    timer: 1500
                });
                pemilikLamaId.value = '';
                pemilikLama.textContent = 'Pemilik Lama';
            }
        });

        pemilikBaru.addEventListener('change', function() {
            if(pemilikLama.textContent === pemilikBaru.options[pemilikBaru.selectedIndex].text) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pemilik Baru tidak boleh sama dengan Pemilik Lama',
                    showConfirmButton: false,
                    timer: 1500
                });
                pemilikBaru.selectedIndex = 0;
            }

        });
    });
</script>
