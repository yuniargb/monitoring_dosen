<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Laporan Presensi Guru</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* @page {
            @bottom-right {
                content: counter(page) " of "counter(pages);
            }
        } */

        table.table {
            font-size: 10 px;
        }

    </style>
</head>

<body>
    <h6 class="text-center">Universitas Muhamadiyah Tangerang</h6>
    <h6 class="text-center">Jl. Perintis Kemerdekaan II, RT.007/RW.003, Babakan, Kec. Tangerang, Kota Tangerang, Banten 15118</h6>
    <h6 class="text-center">Laporan Pengajuan Dosen</h6>

    <table border="1" class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kode</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">NIDN</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Jabatan</th>
            <th rowspan="2">Fakultas</th>
            <th rowspan="2">Prodi</th>
            <th rowspan="2">Umur</th>
            <th colspan="2">Status</th>
        </tr>
        <tr>
            <th>Bagian</th>
            <th>Stat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $sw)
        <tr>
            <td rowspan="2">{{ $loop->iteration }}</td>
            <td rowspan="2">{{ $sw->id_pengajuan }}</td>
            <td rowspan="2">{{ date('d-m-Y', strtotime($sw->created_at)) }}</td>
            <td rowspan="2">{{ $sw->nidn }}</td>
            <td rowspan="2">{{ $sw->nama }}</td>
            <td rowspan="2">{{ $sw->jabatan_fungsional }}</td>
            <td rowspan="2">{{ $sw->nama_fakultas }}</td>
            <td rowspan="2">{{ $sw->nama_prodi }}</td>
            <td rowspan="2">{{ $sw->umur }}</td>
            <td><b>Staff</b></td>
            <td>{!! $sw->status_staf !!}</td>
        </tr>
        <tr>
            <td><b>BAAK</b></td>
            <td>{!! $sw->status_baak !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>

</html>
