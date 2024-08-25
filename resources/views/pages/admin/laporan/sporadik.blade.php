<x-app-layout>

    <div class="pagetitle">
        <h1>Data Surat Sporadik</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Sporadik</li>
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
                                Surat Sporadik
                            </h5>
                            <button class="btn btn-sm btn-warning text-white" id="btn-print">Print</button>
                        </div>
                        <!-- Table with stripped rows -->
                        <table id="listTable" class="table datatable">
                            <thead>
                                <tr style="font-weight: bold">
                                    <td>No Surat</td>
                                    <td>Tiket Pengajuan</td>
                                    <td>Pemohon</td>
                                    <td>Perihal</td>
                                    <td>Keterangan</td>
                                    <td>Tanggal Surat</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sporadiks as $sporadik)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.sporadik.detail', $sporadik->hashid) }}">{{ $sporadik->no_surat }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pengajuan.detail', $sporadik->pengajuan->hashid) }}">
                                            #{{ $sporadik->pengajuan->hashid }}
                                        </a>
                                    </td>
                                    <td>{{ $sporadik->pengajuan->warga->nama }}</td>
                                    <td>{{ $sporadik->pengajuan->perihal }}</td>
                                    <td>{{ $sporadik->pengajuan->keterangan }}</td>
                                    <td>{{ $sporadik->tanggal_surat }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function destroy(id) {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Ingin menghapus data Pajak Bumi Bangunan Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Aku Yakin!',
                cancelButtonText: 'Tidak, Batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/sporadik/destroy/${id}`;
                }
            })
        };
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
            printWindow.document.write('<h4 style="text-align: center;">Laporan Surat Sporadik ' + new Date().getFullYear() + '</h4>');
            // printWindow.document.write('<hr>');

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
