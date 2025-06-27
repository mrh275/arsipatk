<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Barang</title>
    <style>
        /* CSS untuk styling laporan */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Tambahkan styling lain sesuai kebutuhan */
    </style>
</head>

<body>

    <h1>Laporan Data Barang</h1>
    <h3 style="text-align: center">Data per {{ date('d F Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nama Barang</th>
                <th>Jumlah Stok</th>
                <th>Satuan Barang</th>
            </tr>
        </thead>
        <tbody>
            {{-- Lakukan perulangan untuk menampilkan data barang --}}
            @foreach ($dataBarang as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{-- Tampilkan nama kategori --}}
                        @if ($item->kategori)
                            {{ $item->kategori->nama_kategori }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->stok_barang }}</td>
                    <td>{{ $item->satuan_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
