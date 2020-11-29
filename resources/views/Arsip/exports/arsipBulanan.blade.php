<table>
    <thead>
        <tr>
            <td style="font-size: 17px; text-align: center" colspan="8"><strong>Arsip BC.25</strong></td>
        </tr>
        <tr>
            <td colspan="2">Bulan : <?= $arsipData['bulan'] ?></td>
        </tr>
        <tr>
            <td colspan="2">Tahun : <?= $arsipData['tahun'] ?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th style="text-align: center">No.</th>
            <th style="text-align: center">No. Pen</th>
            <th style="text-align: center">Tanggal Dok</th>
            <th style="text-align: center">Nama PT</th>
            <th style="text-align: center">Jenis Dok</th>
            <th style="text-align: center">Rak</th>
            <th style="text-align: center">Box</th>
            <th style="text-align: center">Batch</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($dataArsip as $data)
        <tr style="text-align: center">
            <td style="text-align: center"><?= $no++ ?></td>
            <td style="text-align: center"><?= $data->no_pen ?></td>
            <td style="text-align: center"><?= $data->tanggal_dokumen ?></td>
            <td style="text-align: left"><?= $data->nama_perusahaan ?></td>
            <td style="text-align: center"><?= $data->jenis_dokumen ?></td>
            <td style="text-align: center"><?= $data->rak ?></td>
            <td style="text-align: center"><?= $data->box ?></td>
            <td style="text-align: center"><?= $data->batch ?></td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">Purwakarta, @php echo
                date('d-M-Y')
            @endphp</td>
        </tr>
    </tbody>
</table>