<table border="1" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nomor Pendaftaran</th>
            <th>Tanggal Dokumen</th>
            <th>Nama Perusahaan</th>
            <th>Jenis Dokumen</th>
            <th>Rak</th>
            <th>Box</th>
            <th>Batch</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($dataArsip as $data)
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->no_pen ?></td>
            <td><?= $data->tanggal_dokumen ?></td>
            <td><?= $data->nama_perusahaan ?></td>
            <td><?= $data->jenis_dokumen ?></td>
            <td><?= $data->rak ?></td>
            <td><?= $data->box ?></td>
            <td><?= $data->batch ?></td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Purwakarta,</td>
            <td>November 2020</td>
        </tr>
    </tbody>
</table>