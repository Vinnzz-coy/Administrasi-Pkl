@extends('layouts.app')

@section('title', 'Buat Surat Penjajakan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 to-orange-100 py-8 px-4">
    <div class="max-w-5xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <a href="{{ route('surat.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 mb-4 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Pilihan Surat
            </a>
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-4 rounded-xl">
                        <i class="fas fa-file-contract text-white text-3xl"></i>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-3xl font-bold text-gray-800">Surat Penjajakan PKL</h1>
                        <p class="text-gray-600 mt-2">Isi formulir di bawah untuk membuat surat penjajakan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up">
            <form id="suratForm" class="space-y-6">
                @csrf
                
                <!-- Informasi Surat -->
                <div class="border-l-4 border-yellow-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Informasi Surat</h3>
                    <p class="text-gray-600 text-sm">Data identitas surat</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Surat -->
                    <div class="form-group">
                        <label for="tanggal_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-yellow-500 mr-2"></i>Tanggal Surat
                        </label>
                        <input type="date" 
                               id="tanggal_surat" 
                               name="tanggal_surat" 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>

                    <!-- Nomor Surat -->
                    <div class="form-group">
                        <label for="nomor_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-hashtag text-yellow-500 mr-2"></i>Nomor Surat
                        </label>
                        <input type="text" 
                               id="nomor_surat" 
                               name="nomor_surat" 
                               placeholder="Contoh: 123/PKL/2025"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>
                </div>

                <!-- Informasi DUDI -->
                <div class="border-l-4 border-yellow-500 pl-4 mb-6 mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Informasi DUDI</h3>
                    <p class="text-gray-600 text-sm">Data perusahaan/instansi tujuan</p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Nama DUDI -->
                    <div class="form-group">
                        <label for="nama_dudi" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-building text-yellow-500 mr-2"></i>Nama DUDI
                        </label>
                        <input type="text" 
                               id="nama_dudi" 
                               name="nama_dudi" 
                               placeholder="Contoh: PT. Proaktif Robotika"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>

                    <!-- Alamat DUDI -->
                    <div class="form-group">
                        <label for="alamat_dudi" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-yellow-500 mr-2"></i>Alamat DUDI
                        </label>
                        <textarea 
                               id="alamat_dudi" 
                               name="alamat_dudi" 
                               rows="3"
                               placeholder="Contoh: Jl. Jogja No. 88, Yogyakarta"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required></textarea>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>
                </div>

                <!-- Informasi PKL -->
                <div class="border-l-4 border-yellow-500 pl-4 mb-6 mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Informasi PKL</h3>
                    <p class="text-gray-600 text-sm">Detail pelaksanaan PKL</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Lama PKL -->
                    <div class="form-group">
                        <label for="lama_pkl" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-clock text-yellow-500 mr-2"></i>Lama PKL
                        </label>
                        <input type="text" 
                               id="lama_pkl" 
                               name="lama_pkl" 
                               placeholder="Contoh: 3 Bulan"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>

                    <!-- Tingkat -->
                    <div class="form-group">
                        <label for="tingkat" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-layer-group text-yellow-500 mr-2"></i>Tingkat
                        </label>
                        <select id="tingkat" 
                                name="tingkat"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300 bg-white"
                                required>
                            <option value="XI">XI</option>
                            <option value="XII" selected>XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Mulai -->
                    <div class="form-group">
                        <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-check text-yellow-500 mr-2"></i>Tanggal Mulai
                        </label>
                        <input type="date" 
                               id="tanggal_mulai" 
                               name="tanggal_mulai" 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="form-group">
                        <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-times text-yellow-500 mr-2"></i>Tanggal Selesai
                        </label>
                        <input type="date" 
                               id="tanggal_selesai" 
                               name="tanggal_selesai" 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300"
                               required>
                        <span class="text-red-500 text-sm hidden error-message"></span>
                    </div>
                </div>

                <!-- Jurusan -->
                <div class="form-group">
                    <label for="jurusan" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-graduation-cap text-yellow-500 mr-2"></i>Jurusan
                    </label>
                    <select id="jurusan" 
                            name="jurusan"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300 bg-white"
                            required>
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->jurusan }}">{{ $jurusan->jurusan }}</option>
                        @endforeach
                    </select>
                    <span class="text-red-500 text-sm hidden error-message"></span>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t-2 border-gray-200">
                    <button type="button" 
                            onclick="resetForm()"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-redo mr-2"></i>Reset Form
                    </button>
                    <button type="submit" 
                            id="previewBtn"
                            class="flex-1 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-eye mr-2"></i>Preview Surat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4 animate-fade-in">
    <div class="bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-6 text-white flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-bold">Preview Surat Penjajakan</h3>
                <p class="text-yellow-100 mt-1">Periksa kembali sebelum mengunduh</p>
            </div>
            <button onclick="closePreview()" class="text-white hover:bg-yellow-600 p-2 rounded-lg transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-200px)]">
            <div id="pdfPreview" class="w-full h-[600px] border-2 border-gray-300 rounded-lg overflow-hidden">
                <!-- PDF will be embedded here -->
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 p-6 flex flex-col sm:flex-row gap-4 border-t-2">
            <button onclick="printSurat()" 
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                <i class="fas fa-print mr-2"></i>Cetak
            </button>
            <button onclick="downloadSurat('pdf')" 
                    class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>Download PDF
            </button>
            <button onclick="downloadSurat('docx')" 
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                <i class="fas fa-file-word mr-2"></i>Download DOCX
            </button>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 text-center">
        <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-yellow-500 mx-auto mb-4"></div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Memproses Surat...</h3>
        <p class="text-gray-600">Mohon tunggu sebentar</p>
    </div>
</div>

<script>
let currentFilename = null;
let pdfUrl = null;

document.getElementById('suratForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Show loading
    document.getElementById('loadingModal').classList.remove('hidden');
    
    const formData = new FormData(this);
    const data = {};
    formData.forEach((value, key) => data[key] = value);
    
    try {
        const response = await fetch('{{ route("surat.penjajakan.preview") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        // Hide loading
        document.getElementById('loadingModal').classList.add('hidden');
        
        if (result.success) {
            currentFilename = result.filename;
            pdfUrl = result.pdf_url;
            
            // Show preview
            document.getElementById('pdfPreview').innerHTML = 
                `<iframe src="${result.pdf_url}" class="w-full h-full"></iframe>`;
            document.getElementById('previewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        document.getElementById('loadingModal').classList.add('hidden');
        alert('Terjadi kesalahan: ' + error.message);
    }
});

function closePreview() {
    document.getElementById('previewModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function printSurat() {
    if (pdfUrl) {
        const printWindow = window.open(pdfUrl, '_blank');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
}

async function downloadSurat(format) {
    if (!currentFilename) return;
    
    try {
        const response = await fetch('{{ route("surat.penjajakan.download") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                filename: currentFilename,
                format: format
            })
        });
        
        if (response.ok) {
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `Surat_Penjajakan_${new Date().toISOString().split('T')[0]}.${format}`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        } else {
            alert('Gagal mengunduh file');
        }
    } catch (error) {
        alert('Terjadi kesalahan: ' + error.message);
    }
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form?')) {
        document.getElementById('suratForm').reset();
    }
}

// Set default date to today
document.getElementById('tanggal_surat').valueAsDate = new Date();
</script>
@endsection