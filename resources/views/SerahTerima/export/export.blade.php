<table>
    <thead>
        <tr>
            <td style="font-size: 14px; text-align: center" colspan="5"><strong>SERAH TERIMA BC 2.5 DAN SPPB-1 KE PDAD</strong></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">Periode Tahun Batch : <?= $serahTerima['tahun'] ?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th style="text-align: center">No.</th>
            <th style="text-align: center">No. Pen</th>
            <th style="text-align: center">Tanggal Dok</th>
            <th style="text-align: center">Nama PT</th>
            <th style="text-align: center">Batch</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            
        @endphp
        @foreach ($serahBc as $d)
        <tr style="text-align: center">
            <td style="text-align: center"><?= $no++ ?></td>
            <td style="text-align: center"><?= $d->no_pen ?></td>
            <td style="text-align: center"><?= date("d-m-Y", strtotime($d->tanggal_dokumen)) ?></td>
            <td style="text-align: left"><?= $d->nama_perusahaan ?></td>
            <td style="text-align: center"><?= $d->batch ?>/<?= $d->tahun_batch ?></td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">Diterima Seksi PDAD Oleh</td>
            <td colspan="2">Purwakarta,</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">Diserahkan Seksi PKC Oleh</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td></td>
            <td></td>
            <td colspan="2"><?= $serahTerima['nama'] ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: left"><?= $serahTerima['nip'] ?></td>
        </tr>
    </tbody>
</table>