<style>
    body {

        font-family: "Times New Roman";

        font-size: 12pt;

    }


    .surat {

        width: 100%;

    }


    table {

        width: 100%;

    }
</style>



<div class="surat">


    <?php include "templates/kop.php"; ?>


    <br>


    <center>

        <h3>

            <?= strtoupper(judulSurat($data['jenis_surat'])) ?>

        </h3>


        Nomor :
        <?= $data['nomor_permohonan'] ?>


    </center>



    <p>

        Yang bertanda tangan di bawah ini Dekan Fakultas Ushuluddin dan Pemikiran Islam menerangkan bahwa:


    </p>



    <table>


        <tr>

            <td>Nama</td>

            <td>:</td>

            <td><?= $data['nama_lengkap'] ?></td>


        </tr>


        <tr>

            <td>NIM</td>

            <td>:</td>

            <td><?= $data['nim'] ?></td>

        </tr>


        <tr>

            <td>Program Studi</td>

            <td>:</td>

            <td><?= $data['program_studi'] ?></td>


        </tr>


    </table>


    <br>


    <p>

        <?= isiSurat($data) ?>

    </p>



    <br><br>


    <div style="
width:300px;
margin-left:auto;
text-align:center;
">


        Serang,
        <?= tanggalIndonesia() ?>


        <br><br>


        Dekan



        <br><br><br>



        <b>

            Dr. Masykur, M.Hum

        </b>


    </div>


</div>