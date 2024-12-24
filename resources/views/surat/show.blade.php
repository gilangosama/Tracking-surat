<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')
        
        <div class="flex-1 ml-[280px] p-8">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Detail Surat</h1>
                <div class="flex gap-2">
                    <a href="{{ url()->previous() }}" 
                        class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        ← Kembali
                    </a>
                    <button onclick="printSurat()" 
                        class="px-4 py-2 text-sm bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-colors duration-200">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6" id="printArea">
                <!-- Data Surat -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Data Surat</h2>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-32 text-gray-600">Nomor Surat</span>
                                <span class="text-gray-900">: {{ $surat->no_surat }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Tanggal Surat</span>
                                <span class="text-gray-900">: {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Jenis Surat</span>
                                <span class="text-gray-900">: {{ ucfirst($surat->jenis_surat) }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Perihal</span>
                                <span class="text-gray-900">: {{ $surat->perihal }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold mb-4">Data Pengirim</h2>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-32 text-gray-600">Nama Pengirim</span>
                                <span class="text-gray-900">: {{ $surat->pengirim }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Nomor Pengirim</span>
                                <span class="text-gray-900">: {{ $surat->nomor_pengirim ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold mb-4">Data Penerima</h2>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-32 text-gray-600">Nama Penerima</span>
                                <span class="text-gray-900">: {{ $surat->penerima }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Nomor Penerima</span>
                                <span class="text-gray-900">: {{ $surat->nomor_penerima ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printSurat() {
            let originalContents = document.body.innerHTML;
            let surat = {
                no_surat: "{{ $surat->no_surat }}",
                tanggal_surat: "{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}",
                jenis_surat: "{{ ucfirst($surat->jenis_surat) }}",
                perihal: "{{ $surat->perihal }}",
                pengirim: "{{ $surat->pengirim }}",
                nomor_pengirim: "{{ $surat->nomor_pengirim ?? '-' }}",
                penerima: "{{ $surat->penerima }}",
                nomor_penerima: "{{ $surat->nomor_penerima ?? '-' }}"
            };

            let printContent = `
                <div style="padding: 20px;">
                    <div style="max-width: 800px; margin: 0 auto;">
                        <h1 style="text-align: center; margin-bottom: 20px;">Detail Surat</h1>
                        
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td colspan="4" style="font-weight: bold; padding: 10px; background-color: #f3f4f6; border: 1px solid #ddd;">
                                    Data Surat
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd; width: 20%;">Nomor Surat</td>
                                <td style="padding: 8px; border: 1px solid #ddd; width: 30%;">${surat.no_surat}</td>
                                <td style="padding: 8px; border: 1px solid #ddd; width: 20%;">Tanggal Surat</td>
                                <td style="padding: 8px; border: 1px solid #ddd; width: 30%;">${surat.tanggal_surat}</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd;">Jenis Surat</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">${surat.jenis_surat}</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">Perihal</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">${surat.perihal}</td>
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td colspan="2" style="font-weight: bold; padding: 10px; background-color: #f3f4f6; border: 1px solid #ddd;">
                                    Data Pengirim
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd; width: 30%;">Nama Pengirim</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">${surat.pengirim}</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd;">Nomor Pengirim</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">${surat.nomor_pengirim}</td>
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="font-weight: bold; padding: 10px; background-color: #f3f4f6; border: 1px solid #ddd;">
                                    Data Penerima
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd; width: 30%;">Nama Penerima</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">${surat.penerima}</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ddd;">Nomor Penerima</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">${surat.nomor_penerima}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            `;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContents;

            setTimeout(() => {
                document.querySelector('button[onclick="printSurat()"]')
                    .addEventListener('click', printSurat);
            }, 100);
        }
    </script>

    <style>
        @media print {
            body {
                padding: 20px;
                font-family: Arial, sans-serif;
            }
            table {
                page-break-inside: avoid;
            }
            h1 {
                margin-bottom: 20px;
            }
        }
    </style>
</x-app-layout>
