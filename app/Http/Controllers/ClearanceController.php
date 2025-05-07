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

   
        $namaKegiatan = $validated['nama_kegiatan'];
        $itemList = $validated['item_belanja'];
        $totalList = $validated['total_anggaran'];
        $usulanList = $validated['usulan_rekomendasi'];

        try {
      
            $templatePath = storage_path('app/templates/template_clearance.docx');
            
            if (!file_exists($templatePath)) {
                throw new \Exception("Template tidak ditemukan.");
            }

            
            $templateProcessor = new TemplateProcessor($templatePath);

           
            $templateProcessor->setValues([
                'jabatan_instansi' => $validated['jabatan_instansi'],
                'instansi' => $validated['instansi'],
                'INSTANSI' => strtoupper($validated['instansi']),
                'nomor_surat' => $validated['nomor_surat'],
                'tanggal_surat' => $validated['tanggal_surat'],
                'tanggal' => $validated['tanggal'],
                'tahun_anggaran' => $validated['tahun_anggaran'],
                'perihal' => $validated['perihal'],
                'nama_kegiatan' => $namaKegiatan,
                'belanja_infrastruktur' => $validated['belanja_infrastruktur'],
                'kata_melanjutkan' => $validated['kata_melanjutkan'],
            ]);

           
            // $jumlahBaris = count($itemList);
            $templateProcessor->cloneRow('item_belanja', count($itemList)); // Duplikasi baris  
            $templateProcessor->cloneRow('item_belanja1', count($itemList)); // Duplikasi baris  
            $templateProcessor->cloneRow('item_belanja2', count($itemList)); // Duplikasi baris  
            foreach ($itemList as $index => $itemBelanja) {
                $row = $index + 1; 
                $templateProcessor->setValue("item_belanja#{$row}", $itemBelanja);
                $templateProcessor->setValue("item_belanja1#{$row}", $itemBelanja);
                $templateProcessor->setValue("item_belanja2#{$row}", $itemBelanja);
                $templateProcessor->setValue("total_anggaran#{$row}", $totalList[$index]);
                $templateProcessor->setValue("usulan_rekomendasi#{$row}", $usulanList[$index]);
            }
     

            $fileName = 'Clearance_' . Str::slug($validated['instansi'], '_') . '_' . time() . '.docx';
            $outputPath = storage_path('app/' . $fileName);
            $templateProcessor->saveAs($outputPath);

            
            return response()->download($outputPath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
           
            return back()->withErrors(['msg' => 'Terjadi kesalahan, coba lagi.']);
        }
    }
}
