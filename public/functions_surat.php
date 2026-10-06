function isiSurat($data)
{

switch ($data['jenis_surat']) {


case "aktif_kuliah":

return "
Dengan ini menerangkan bahwa mahasiswa tersebut benar-benar
terdaftar sebagai mahasiswa aktif Fakultas Ushuluddin dan
Pemikiran Islam UIN Sultan Maulana Hasanuddin Banten.

Surat keterangan ini dibuat untuk keperluan:
<b>{$data['keperluan']}</b>.
";



case "magang":

return "
Berdasarkan permohonan yang diajukan, mahasiswa tersebut
diberikan keterangan untuk melaksanakan kegiatan magang.

Adapun keperluan kegiatan tersebut adalah:
<b>{$data['keperluan']}</b>.
";



case "observasi":

return "
Surat ini menerangkan bahwa mahasiswa tersebut diberikan izin
untuk melaksanakan kegiatan observasi akademik.

Kegiatan observasi dilaksanakan untuk:
<b>{$data['keperluan']}</b>.
";



case "penelitian":

return "
Surat ini diberikan kepada mahasiswa tersebut untuk mendukung
pelaksanaan kegiatan penelitian akademik.

Adapun tujuan penelitian adalah:
<b>{$data['keperluan']}</b>.
";



case "rekomendasi":

return "
Fakultas Ushuluddin dan Pemikiran Islam UIN Sultan Maulana
Hasanuddin Banten memberikan rekomendasi kepada mahasiswa
tersebut sesuai dengan keperluan:

<b>{$data['keperluan']}</b>.
";



default:

return "";

}

}