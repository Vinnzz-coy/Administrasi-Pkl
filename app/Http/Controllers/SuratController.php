<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        return view('surat.index');
    }

    public function penjajakan()
    {
        $jurusans = Jurusan::all();
        return view('surat.penjajakan', compact('jurusans'));
    }

    public function previewPenjajakan(Request $request)
    {
        $validated = $request->validate([
            'tanggal_surat' => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'nama_dudi' => 'required|string|max:255',
            'alamat_dudi' => 'required|string',
            'lama_pkl' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
        ]);

        // Format tanggal
        $validated['tanggal_surat'] = \Carbon\Carbon::parse($validated['tanggal_surat'])->locale('id')->isoFormat('D MMMM YYYY');
        $validated['tanggal_mulai'] = \Carbon\Carbon::parse($validated['tanggal_mulai'])->locale('id')->isoFormat('D MMMM YYYY');
        $validated['tanggal_selesai'] = \Carbon\Carbon::parse($validated['tanggal_selesai'])->locale('id')->isoFormat('D MMMM YYYY');

        // Generate unique filename
        $filename = 'surat_penjajakan_' . time();
        
        // Call Python script
        $result = $this->processSuratWithPython($validated, $filename);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'pdf_url' => asset('storage/surat/' . $filename . '.pdf'),
                'docx_url' => asset('storage/surat/' . $filename . '.docx'),
                'filename' => $filename
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 500);
    }

    public function downloadPenjajakan(Request $request)
    {
        $filename = $request->input('filename');
        $format = $request->input('format', 'pdf');
        
        $path = storage_path('app/public/surat/' . $filename . '.' . $format);
        
        if (!file_exists($path)) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan'], 404);
        }

        return response()->download($path, 'Surat_Penjajakan_' . date('Y-m-d') . '.' . $format);
    }

    private function processSuratWithPython($data, $filename)
    {
        // Path ke template dan output
        $templatePath = storage_path('app/templates/surat-penjajakan-template.docx');
        $outputDir = storage_path('app/public/surat');
        $outputPath = $outputDir . '/' . $filename;
        
        // Buat folder jika belum ada
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Cek apakah template ada
        if (!file_exists($templatePath)) {
            return [
                'success' => false,
                'message' => 'Template file tidak ditemukan: ' . $templatePath
            ];
        }

        // Path ke Python script
        $scriptPath = base_path('scripts/surat_penjajakan.py');
        
        // Cek apakah script Python ada
        if (!file_exists($scriptPath)) {
            return [
                'success' => false,
                'message' => 'Python script tidak ditemukan: ' . $scriptPath
            ];
        }

        // Escape arguments untuk command line
        $escapedArgs = [
            escapeshellarg($scriptPath),
            escapeshellarg($templatePath),
            escapeshellarg($outputPath),
            escapeshellarg($data['tanggal_surat']),
            escapeshellarg($data['nomor_surat']),
            escapeshellarg($data['nama_dudi']),
            escapeshellarg($data['alamat_dudi']),
            escapeshellarg($data['lama_pkl']),
            escapeshellarg($data['tanggal_mulai']),
            escapeshellarg($data['tanggal_selesai']),
            escapeshellarg($data['tingkat']),
            escapeshellarg($data['jurusan'])
        ];
        
        // Build command - gunakan python3 untuk Linux/Mac, python untuk Windows
        $pythonCmd = PHP_OS_FAMILY === 'Windows' ? 'python' : 'python3';
        $command = $pythonCmd . ' ' . implode(' ', $escapedArgs) . ' 2>&1';

        // Log command untuk debugging
        \Log::info('Executing Python command: ' . $command);

        // Execute Python script
        exec($command, $output, $return_var);

        // Log output untuk debugging
        \Log::info('Python script output: ' . implode("\n", $output));
        \Log::info('Python script return code: ' . $return_var);

        if ($return_var === 0) {
            // Cek apakah file berhasil dibuat
            if (file_exists($outputPath . '.docx') && file_exists($outputPath . '.pdf')) {
                return ['success' => true];
            } else {
                return [
                    'success' => false,
                    'message' => 'File output tidak ditemukan setelah processing'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Error processing document: ' . implode("\n", $output)
            ];
        }
    }
}