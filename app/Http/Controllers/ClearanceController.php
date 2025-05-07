<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Str;

class ClearanceController extends Controller
{
    public function index()
    {
        return view('clearance_form');
    }

    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'jabatan_instansi' => 'required',
            'instansi' => 'required',
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'tanggal' => 'required',
            'tahun_anggaran' => 'required',
            'perihal' => 'required',
            'nama_kegiatan' => 'required',
            'belanja_infrastruktur' => 'required',
            'item_belanja' => 'required|array',
            'total_anggaran' => 'required|array',
            'usulan_rekomendasi' => 'required|array',
            'kata_melanjutkan' => 'required',
        ]);

        $item1 = $validated['item_belanja'][0] ?? '-';
        $item2 = $validated['item_belanja'][1] ?? '-';
        $anggaran1 = $validated['total_anggaran'][0] ?? '-';
        $anggaran2 = $validated['total_anggaran'][1] ?? '-';
        $rekom1 = $validated['usulan_rekomendasi'][0] ?? '-';
        $rekom2 = $validated['usulan_rekomendasi'][1] ?? '-';

        try {
        
            $templatePath = storage_path('app/templates/template_clearance.docx');
            
          
            if (!file_exists($templatePath)) {
                throw new \Exception("Template tidak ditemukan.");
            }

            $templateProcessor = new TemplateProcessor($templatePath);

       
            $templateProcessor->setValues([
                'jabatan_instansi' => $validated['jabatan_instansi'],
                'instansi' => $validated['instansi'],
                'nomor_surat' => $validated['nomor_surat'],
                'tanggal_surat' => $validated['tanggal_surat'],
                'tanggal' => $validated['tanggal'],
                'tahun_anggaran' => $validated['tahun_anggaran'],
                'perihal' => $validated['perihal'],
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'belanja_infrastruktur' => $validated['belanja_infrastruktur'],
                'item1' => $item1,
                'item2' => $item2,
                'anggaran1' => $anggaran1,
                'anggaran2' => $anggaran2,
                'rekom1' => $rekom1,
                'rekom2' => $rekom2,
                'kata_melanjutkan' => $validated['kata_melanjutkan'],
            ]);

      
            $fileName = 'Clearance_' . Str::slug($validated['instansi'], '_') . '_' . time() . '.docx';
            $outputPath = storage_path('app/' . $fileName);
            $templateProcessor->saveAs($outputPath);

            return response()->download($outputPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            
            return back()->withErrors(['msg' => 'Terjadi kesalahan, coba lagi.']);
        }
    }
}
