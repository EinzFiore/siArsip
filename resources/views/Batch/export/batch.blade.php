<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Laporan Serah Terima BC 2.5</title>
    <style>
        body{
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td align="center"><h3>SERAH TERIMA BC 2.5 DAN SPPB-1 KE PDAD</h3></td>
        </tr>
        <tr>
            <td>Periode Pengirimian : Tahun <?= $data['tahunPeriode'] ?></td>
        </tr>
    </table>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Nama Perusahaan</th>
                <th>Ket (Batch)</th>
            </tr>  
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($listDokumenBatch as $ldb)      
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $ldb->no_pen ?></td>
                <td><?= $ldb->tanggal_dokumen ?></td>
                <td><?= $ldb->nama_perusahaan ?></td>
                <td><?= $id ?>/<?= $data['tahunPeriode'] ?></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table cellpadding="10">
        <tr>
            <td colspan="3"><br> Diterima Seksi PDAD Oleh</td>
            <td></td>
            <td colspan="2"><br> Purwakarta, <br> Diserahkan Seksi PKC Oleh</td>
        </tr>
        <tr>
            <td colspan="5"><br></td>
        </tr>
        <tr>
            <td colspan="5"><br></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
            <td cellpadding="10"></td>
            <td colspan="2"><hr></td>
        </tr>
        <tr>
            <td colspan="3">
                Nama : <br>
                NIP:
            </td>
            <td></td>
            <td colspan="2">
                Nama : <?= $data['namaSeksiPKC'] ?><br>
                NIP: <?= $data['nip'] ?>
            </td>
        </tr>
    </table>
</table>
</body>
</html>