<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <title>Pelamar <?= $loker_id; ?> | Mitra</title>
    <!-- BOOTSTRAP -->

    <style type="text/css" media="all">
    /* CUSTOMIZING TITLE PAGE */
    @import url('https://fonts.googleapis.com/css2?family=Poppins&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Red Hat Display', sans-serif;
    }

    .title-page {
        padding: 30px 0px 30px 30px;
    }

    .title-page h1 {
        font-family: 'Red Hat Display', sans-serif;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        margin-top: 0px;
        margin-bottom: 5px;
    }

    .title-page h1.fw-bold {
        margin-top: -18px;
        margin-bottom: 0px;
        font-size: 34px;
        font-weight: normal;
    }

    .waves {
        z-index: -1;
        height: 300px;
        width: 100vw;
        position: absolute;
        background: #2041BB;
        width: 100vw;
        height: 200px;
        border-radius: 0px 0px 20px 20px;
    }

    /* STYLING TABLE */

    .data-table {
        font-family: 'Red Hat Display', sans-serif;
        background: #fff;
        border-radius: 15px;
        padding: 10px;
        margin-left: 20px;
        margin-right: 30px;
        box-shadow: 1px;
    }

    table tr th,
    table tr td {
        padding: 0.5rem;
    }

    table thead tr th,
    table tr th {
        text-align: start;
    }

    @page {
        size: 8.5in 11in;
        margin: .5in;
    }
    </style>
</head>

<body style="padding: 0px;margin:0px;">
    <div class="main-page">
        <!-- <img src="/assets/img/wave.png" alt="" class="waves"> -->
        <div class="waves"></div>
        <div class="content-wrapper" style="padding-left: 10px;padding-right: 10px;">
            <div class="title-page">
                <h1 class="fw-light">Pelamar</h1>
                <h1 class="fw-bold"><?= $loker_id; ?></h1>
            </div>

            <div class="alumni-table">
                <!-- SEARCH BAR -->
                <div class="data-table">
                    <!-- ISI DATATABLE -->
                    <div class="content">
                        <div>
                            <p style="margin: 10px 0px 5px 0px;">Berikut ini adalah daftar pelamar untuk lowongan kerja
                                <?= $loker_id; ?></p>
                        </div>
                        <table class="table" style="width:100%;">
                            <thead>
                                <tr class="header">
                                    <th scope="col">#</th>
                                    <th scope="col">ID Pelamar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Tanggal Submit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pelamar as $key => $data):?>
                                <tr>
                                    <th scope=""><?= $no++;?></th>
                                    <td><?= $data->id;?></td>
                                    <td><?= $data->alumni_daftar->alumni->nama;?></td>
                                    <td><?= $data->alumni_daftar->alumni->jurusan->nama;?></td>
                                    <td scope="">
                                        <?= $data->alumni_daftar->alumni->angkatan->tahun_masuk;?>/<?= $data->alumni_daftar->alumni->angkatan->tahun_lulus;?>
                                    </td>
                                    <td><?= \Carbon\Carbon::parse($data->tanggal_submit)->format('d M Y');?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>