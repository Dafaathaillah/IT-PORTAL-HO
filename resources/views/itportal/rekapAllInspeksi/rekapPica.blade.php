<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Export Pica Inspeksi Periode
        @if (!empty($year))
            Tahun - {{ $year }}
        @else
            {{ $startDateConv }} - {{ $endDateConv }}
        @endif
    </title>
    <style>
        @page {
            margin: 15mm 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 10px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin: 10px 0;
        }

        .subtitle {
            text-align: left;
            margin-bottom: 10px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 8.5px;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid black;
            padding: 3px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #0c0c64;
            color: white;
            font-size: 7px;
        }

        .dataContent {
            font-size: 7px;
        }

        .text-left {
            text-align: left;
        }

        img.logo {
            width: 100%;
            height: auto;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            text-align: center;
            font-size: 9px;
            color: #555;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
        }

        ul {
            padding-left: 15px;
        }
    </style>

</head>

<body>
    <div class="container">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 5px;">
            <tr>
                <td style="border: none; padding: 0;" colspan="2">
                    <img src="{{ public_path('images/header_ppa.jpg') }}" alt="Logo"
                        style="width: 100%; height: auto;">
                </td>
            </tr>
        </table>

        <div class="title">FORM DATA PICA INSPEKSI {{ $devicePage }}</div>
        <table style="width: 100%; margin-bottom: 10px; font-size: 12px; border-collapse: collapse;">
            <tr>
                <td style="text-align: left; font-weight: bold; border: none;">
                    Pica Inspeksi Periode : <span style="font-weight: normal;">
                        @if (!empty($year))
                            Tahun - {{ $year }}
                        @else
                            {{ $startDateConv }} - {{ $endDateConv }}
                        @endif
                    </span>
                </td>
                <td style="text-align: right; font-weight: bold; border: none;">
                    PPA-{{ $site }}-F-COE-02D
                </td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th colspan="1" style="border: 1px solid #000;">No</th>
                    <th colspan="1" style="border: 1px solid #000;">No Inventory</th>
                    <th colspan="1" style="border: 1px solid #000;">Lokasi</th>
                    <th colspan="1" style="border: 1px solid #000;">Due Date</th>
                    <th colspan="1" style="border: 1px solid #000;">Inspector</th>
                    <th colspan="1" style="border: 1px solid #000;">Temuan</th>
                    <th colspan="1" style="border: 1px solid #000;">Foto temuan</th>
                    <th colspan="1" style="border: 1px solid #000;">Tindakan</th>
                    <th colspan="1" style="border: 1px solid #000;">Foto Tindakan</th>
                    <th colspan="1" style="border: 1px solid #000;">Status</th>
                    <th colspan="1" style="border: 1px solid #000;">Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPica as $item)
                    <tr class="dataContent">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->no_inv ?? '-' }}</td>
                        <td>{{ $item->loc ?? '-' }}</td>
                        <td>{{ $item->due_date ?? '-' }}</td>
                        <td>{{ $item->inspector ?? '-' }}</td>
                        <td>{{ $item->findings }}</td>
                        <td>
                            @if ($item->findings_image)
                                <img src="{{ public_path('images/' . $item->findings_image) }}" alt="foto temuan"
                                    style="width: 50px; height: 50px;">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $item->findings_action }}
                        <td>
                            @if ($item->action_image)
                                <img src="{{ public_path('images/' . $item->action_image) }}" alt="foto tindakan"
                                    style="width: 50px; height: 50px;">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $item->findings_status }}
                        <td>{{ $item->remarks }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <br><br><br>

        <div style="page-break-before: always;"></div> <!-- Ini supaya pindah ke halaman baru -->
        <div style="font-size: 12px; font-weight: bold; margin-bottom: 10px;">CATATAN</div>

        <ul style="font-size: 11px; margin-bottom: 20px;">
            <li>Diatas terlampir data pica inspeksi device laptop/computer sesuai dengan interval data yang sudah di
                pilih.</li>
            <li>Data pica all status (open dan close) di tampilkan pada export ini.</li>
        </ul>

        <!-- Tambahan total -->
        <div style="font-size: 11px; margin-bottom: 40px;">
            {{-- <strong>Total Barang Scrap:</strong> {{ $unitScrap }} <br>
            <strong>Total Utilize:</strong> {{ $unitUtilize }} --}}
        </div>

        <!-- Tanda tangan -->
        <table style="width: 100%; font-size: 11px; margin-top: 50px; border: none;">
            <tr>
                <td style="text-align: center; border: none;">
                    Mengetahui,<br>
                    Group Leader<br><br>
                    @if ($qr_base64Approved)
                        <img src="{{ $qr_base64Approved }}" alt="QR Code" style="width: 100px; height: 100px;"><br>
                    @else
                        <p><i>Perlu Approval</i></p>
                    @endif
                    <br>
                    ( {{ $picApproved }} )
                </td>
                <td style="text-align: center; border: none;">
                    PIC,<br>
                    IT Support<br><br>
                    @if ($qr_base64Pic)
                        <img src="{{ $qr_base64Pic }}" alt="QR Code" style="width: 100px; height: 100px;"><br>
                    @else
                        <p><i>Perlu Approval</i></p>
                    @endif
                    <br>
                    ( {{ $picName }} )

                </td>
            </tr>
        </table>
    </div>

    <footer>
        <div class="footer-content">
            <div>Generated by ITPORTAL | {{ date('d-m-Y') }}</div>
        </div>
    </footer>
</body>

</html>
