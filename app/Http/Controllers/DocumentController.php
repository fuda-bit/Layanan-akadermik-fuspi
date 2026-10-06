<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
// Pastikan alias PhpWord diimpor dengan benar
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = DB::table('documents')->get();
        return view('documents.index', compact('documents'));
    }

    // Perbaikan: Tambahkan validasi jika data di DB kosong agar tidak terjadi error 500
    public function preview($id)
    {
        $document = DB::table('documents')->where('id', $id)->first();
        if (!$document) {
            return redirect()->route('doc.index')->with('error', 'Dokumen tidak ditemukan.');
        }

        return view('documents.preview', compact('document'));
    }

    public function exportPdf($id)
    {
        $document = DB::table('documents')->where('id', $id)->first();
        if (!$document) return abort(404);

        // Perbaikan: Panggil view template yang tepat
        $pdf = Pdf::loadView('documents.pdf_template', compact('document'));
        return $pdf->download($document->title . '.pdf');
    }

    public function exportDocx($id)
    {
        $document = DB::table('documents')->where('id', $id)->first();
        if (!$document) return abort(404);

        // Inisialisasi PhpWord standard PHP 8.1
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addTitle(htmlspecialchars($document->title), 1);
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars($document->content));

        $fileName = $document->title . '.docx';

        // Perbaikan: Menggunakan temporary file stream yang aman untuk memproses unduhan
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function upload(Request $request)
    {
        // Validasi input form
        $request->validate([
            'title' => 'required|string|max=255',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // Menambahkan ekstensi png
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Membuat nama file unik agar tidak bentrok
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Perbaikan: Simpan file ke direktori public secara eksplisit
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            DB::table('documents')->insert([
                'title' => $request->title,
                'content' => 'File lampiran: ' . $fileName,
                'file_path' => $filePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('doc.index')->with('success', 'File berhasil diunggah!');
        }

        return redirect()->route('doc.index')->with('error', 'Gagal memproses unggahan file.');
    }
}
