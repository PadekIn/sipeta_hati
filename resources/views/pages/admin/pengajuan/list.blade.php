<x-app-layout>

    <div class="pagetitle">
        <h1>Data Pengajuan Surat Warga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Pengajuan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">
                                Pengajuan Surat Warga
                            </h5>
                            <button class="btn btn-sm btn-warning text-white" id="btn-print">Print</button>
                        </div>
                        <!-- Table with stripped rows -->
                        <table id="listTable" class="table datatable">
                            <thead>
                                <tr style="font-weight: bold">
                                    <td>Tiket Pengajuan</td>
                                    <td>Pemohon</td>
                                    <td>Jenis Surat</td>
                                    <td>Tanggal</td>
                                    <td>Perihal</td>
                                    <td>Keterangan</td>
                                    <td class="no-print">Lampiran</td>
                                    <td>Status</td>
                                    <td class="no-print">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td><a href="{{ route('admin.pengajuan.detail', $pengajuan->hashid) }}">#{{ $pengajuan->hashid }}</a></td>
                                    <td>{{ $pengajuan->warga->nama }}</td>
                                    <td>
                                        @if ($pengajuan->jenis_surat == 'pbb')
                                        <span class="badge bg-primary">PBB</span>
                                        @elseif ($pengajuan->jenis_surat == 'sporadik')
                                        <span class="badge bg-success">Sporadik</span>
                                        @endif
                                    </td>
                                    <td>{{ $pengajuan->tanggal }}</td>
                                    <td>{{ $pengajuan->perihal }}</td>
                                    <td>{{ $pengajuan->keterangan }}</td>
                                    <td class="no-print">
                                        <a target="_blank" href="{{ asset('lampiran/warga/pengajuan').'/'.$pengajuan->lampiran }}">Lihat Berkas <img src="{{ asset('img/pdf-download.png') }}" width="23px"></a>
                                    </td>
                                    <td>
                                        @if ($pengajuan->status == 'Diproses')
                                        <span class="badge bg-warning">Diproses</span>
                                        @elseif ($pengajuan->status == 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                        @elseif ($pengajuan->status == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center no-print">
                                        @if ($pengajuan->status == 'Diproses')
                                        <div class="d-flex">
                                            <a href="{{ route('admin.pengajuan.approved', [$pengajuan->jenis_surat, $pengajuan->hashid]) }}" class="btn btn-sm btn-success text-white">Terima</a>
                                            <div style="width: 10px;"></div>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-bs-id-pengajuan ="{{ $pengajuan->hashid }}"
                                                data-bs-nama-pemohon = "{{ $pengajuan->warga->nama }}">
                                                Tolak
                                            </button>
                                        </div>
                                        @else
                                        <span class="badge bg-info">Selesai</span>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="/admin/pengajuan/rejected/" method="post" id="rejected-form">
                                @csrf
                                @method('PATCH')
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-weight: bold" id="staticBackdropLabel">Tolak Pengajuan Surat <span id="pemohon">Warga</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Pesan/Alasan Penolakan</label>
                                        <textarea type="text" name="pesan" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget

            let id = button.getAttribute('data-bs-id-pengajuan');
            let nama = button.getAttribute('data-bs-nama-pemohon');
            let pemohon = document.getElementById('pemohon');
            pemohon.innerHTML = nama;

            const form = document.getElementById('rejected-form');
            form.action = `/admin/pengajuan/rejected/${id}`;
        })
    </script>
    <script>
        function printReport() {
            var table = document.getElementById('listTable');

            // Simpan ID tabel saat ini
            var originalId = table.id;

            // Ganti ID tabel untuk tujuan print
            table.id = 'print-table';

            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Print Tagihan</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('@media print { body { font-family: Arial, sans-serif; }');
            printWindow.document.write('.header { text-align: center; margin-bottom: 20px; }');
            printWindow.document.write('.footer { text-align: center; margin-top: 20px; }');
            printWindow.document.write('.no-print { display: none; }'); // Menyembunyikan elemen yang tidak perlu
            printWindow.document.write('table { width: 100%; border-collapse: collapse; margin: 20px 0; table-layout: fixed; }');
            printWindow.document.write('th, td { border: 1px solid #ddd; text-align: center; word-wrap: break-word; padding: 8px; }');
            printWindow.document.write('th { background-color: #f2f2f2; }');
            printWindow.document.write('@page { size: portrait; } }');
            printWindow.document.write('</style></head><body>');

            // Header
            printWindow.document.write('<div style="margin-bottom:3rem; padding-bottom: 1rem; text-align:center; border-bottom: 3px solid black;">');
            printWindow.document.write('<h3 style="margin:0; padding:0;">PEMERINTAH KABUPATEN MUARO JAMBI</h3>');
            printWindow.document.write('<h3 style="margin:0; padding:0;">KECAMATAN SEKERNAN</h3>');
            printWindow.document.write('<h3 style="margin:0; padding:0;">KELURAHAN SENGETI</h3>');
            printWindow.document.write('<p style="margin:0; padding:0; font-size: 13px">Jl. Kemas Tabro RT. 14 Kelurahan Sengeti Kecamatan Sekernan Kabupaten Muaro Jambi Kode Pos 36381</p>');
            printWindow.document.write('</div>');

            // Laporan
            printWindow.document.write('<h4 style="text-align: center;">Laporan Pengajuan Surat Warga ' + new Date().getFullYear() + '</h4>');
            printWindow.document.write('<hr>');

            // Tabel Laporan
            printWindow.document.write(document.querySelector('#print-table').outerHTML);

            // Footer
            printWindow.document.write('<div style="text-align: right; margin-top: 4rem;">');
            printWindow.document.write('<p style="margin-bottom:3rem; text-align: right;">Admin,</p>');
            printWindow.document.write('<p style="margin-top:3rem;">____________</p>');
            printWindow.document.write('</div>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.onafterprint = function() {
            // Kembalikan ID tabel ke semula
            table.id = originalId;
            printWindow.close();
            };
        }

        document.querySelector('#btn-print').addEventListener('click', function(event) {
            event.preventDefault();
            printReport();
        });

    </script>

</x-app-layout>
