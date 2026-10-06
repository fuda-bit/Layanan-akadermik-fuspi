<?php

namespace App\Support;

use App\Models\PengajuanSurat;
use Illuminate\Support\Carbon;

class SuratResmi
{
    private const BULAN = [
        'januari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4,
        'mei' => 5, 'juni' => 6, 'juli' => 7, 'agustus' => 8,
        'september' => 9, 'oktober' => 10, 'november' => 11, 'desember' => 12,
    ];

    public static function suggestedMagangDates(PengajuanSurat $item): array
    {
        if ($item->jenis_layanan !== 'magang') return [];
        $months = implode('|', array_keys(self::BULAN));
        $pattern = '/\s+dari\s+tanggal\s+(\d{1,2})\s+('.$months.')\s+(\d{4})\s+'
            .'(?:s\s*\.\s*d\s*\.?|sampai(?:\s+dengan)?)\s+'
            .'(\d{1,2})\s+('.$months.')\s+(\d{4})\.?/iu';
        $purpose = $item->keperluan ?? '';
        if (! preg_match($pattern, $purpose, $matches)) return [];
        $startMonth = self::BULAN[mb_strtolower($matches[2])];
        $endMonth = self::BULAN[mb_strtolower($matches[5])];
        if (! checkdate($startMonth, (int) $matches[1], (int) $matches[3])
            || ! checkdate($endMonth, (int) $matches[4], (int) $matches[6])) return [];
        $start = sprintf('%04d-%02d-%02d', $matches[3], $startMonth, $matches[1]);
        $end = sprintf('%04d-%02d-%02d', $matches[6], $endMonth, $matches[4]);
        if ($end < $start) return [];
        return [
            'tanggal_mulai' => $start,
            'tanggal_selesai' => $end,
            'keperluan' => trim(preg_replace($pattern, '', $purpose, 1)),
        ];
    }

    public const JENIS = [
        'aktif_kuliah_umum', 'aktif_kuliah_tunjangan_ortu',
        'magang', 'observasi', 'penelitian', 'rekomendasi',
    ];

    public static function rules(string $jenis): array
    {
        $rules = [
            'nomor_surat' => 'required|string|max:120',
            'tanggal_surat' => 'required|date',
            'semester_akademik' => 'nullable|string|max:30',
            'tahun_akademik' => 'nullable|string|max:30',
            'nama_orang_tua' => 'nullable|string|max:150',
            'nip_orang_tua' => 'nullable|string|max:40',
            'pangkat_orang_tua' => 'nullable|string|max:120',
            'instansi_orang_tua' => 'nullable|string|max:150',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ];
        if (str_starts_with($jenis, 'aktif_kuliah_')) {
            $rules['semester_akademik'] = 'required|string|max:30';
            $rules['tahun_akademik'] = 'required|string|max:30';
        }
        if ($jenis === 'aktif_kuliah_tunjangan_ortu') {
            $rules['nama_orang_tua'] = 'required|string|max:150';
            $rules['instansi_orang_tua'] = 'required|string|max:150';
        }
        if (in_array($jenis, ['magang', 'observasi'], true)) {
            $rules['tanggal_mulai'] = 'required|date';
            $rules['tanggal_selesai'] = 'required|date|after_or_equal:tanggal_mulai';
        }
        return $rules;
    }

    public static function complete(PengajuanSurat $item): bool
    {
        $data = $item->data_surat ?? [];
        if (blank($item->tempat_lahir) || blank($item->tanggal_lahir) || blank($item->semester)) return false;
        if (in_array($item->jenis_layanan, ['magang', 'observasi'], true) && blank($item->dosen_pembimbing)) return false;
        foreach (self::rules($item->jenis_layanan) as $key => $rule) {
            if (str_starts_with($rule, 'required') && blank($data[$key] ?? null)) return false;
        }
        return true;
    }

    public static function values(PengajuanSurat $item): array
    {
        $data = $item->data_surat ?? [];
        $suggestion = self::suggestedMagangDates($item);
        $date = static function ($value) {
            if (! $value) return '';
            return Carbon::parse($value)->locale('id')->translatedFormat('d F Y');
        };
        return [
            'nomor_surat' => $data['nomor_surat'] ?? '',
            'tanggal_surat' => $date($data['tanggal_surat'] ?? null),
            'nama_mahasiswa' => $item->nama_mahasiswa ?? '',
            'tempat_tgl_lahir' => ($item->tempat_lahir && $item->tanggal_lahir ? $item->tempat_lahir.', '.$date($item->tanggal_lahir) : '[Tempat/tanggal lahir belum tersedia]'),
            'nim' => $item->nim ?? '',
            'prodi' => $item->prodi ?? '',
            'semester' => $item->semester ?? '',
            'semester_akademik' => $data['semester_akademik'] ?? '',
            'tahun_akademik' => $data['tahun_akademik'] ?? '',
            'nama_orang_tua' => $data['nama_orang_tua'] ?? '',
            'nip_orang_tua' => $data['nip_orang_tua'] ?? '',
            'pangkat_orang_tua' => $data['pangkat_orang_tua'] ?? '',
            'instansi_orang_tua' => $data['instansi_orang_tua'] ?? '',
            'tanggal_mulai' => $date($data['tanggal_mulai'] ?? $suggestion['tanggal_mulai'] ?? null),
            'tanggal_selesai' => $date($data['tanggal_selesai'] ?? $suggestion['tanggal_selesai'] ?? null),
            'tujuan_surat' => $item->tujuan_surat ?? '',
            'keperluan' => $suggestion['keperluan'] ?? ($item->keperluan ?? ''),
            'dosen_pembimbing' => $item->dosen_pembimbing ?? '',
            'mata_kuliah' => $item->mata_kuliah ?? '',
            'judul_skripsi' => $item->judul_skripsi ?? '',
            'tempat_penelitian' => $item->tempat_penelitian ?? '',
        ];
    }
}
