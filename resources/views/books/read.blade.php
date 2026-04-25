@extends('layouts.app')

@section('title', 'Baca: ' . $book->title)

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="ui-card-lg p-8">
        <!-- Copyright Notice Banner -->
        <div class="mb-6 bg-amber-50 border-l-4 border-amber-500 p-4 rounded flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <div>
                <p class="font-semibold text-amber-900">ⓒ Perlindungan Hak Cipta Penulis</p>
                <p class="text-sm text-amber-800 mt-1">Konten buku ini dilindungi oleh hak cipta. Dilarang mengunduh, menyalin, atau mendistribusikan ulang tanpa izin resmi dari penulis. Pelanggaran akan dikenakan tindakan hukum.</p>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white-900">{{ $book->title }}</h1>
            <a href="{{ route('books.show', $book->id) }}" class="text-[#FF2D20] hover:underline">← Kembali</a>
        </div>

        @if(!$canReadFull)
            @if($book->free_pages > 0)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                    <p class="text-yellow-800">
                        <strong>Preview Gratis:</strong> Anda dapat membaca {{ $book->free_pages }} halaman pertama secara gratis. 
                        Untuk melanjutkan membaca, silakan berlangganan atau beli buku ini.
                    </p>
                </div>
            @else
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                    <p class="text-red-800">
                        <strong>Akses Terbatas:</strong> Untuk membaca buku ini, silakan berlangganan atau beli buku ini.
                    </p>
                </div>
            @endif
        @endif

        @if($book->file_path)
            <div class="border-2 border-gray-200 rounded-lg p-4 relative pdf-protected-container">
                <!-- Copyright Watermark Overlay -->
                <div class="absolute inset-0 pointer-events-none opacity-10 z-10 flex items-center justify-center overflow-hidden">
                    <div style="transform: rotate(-45deg); font-size: 120px; font-weight: bold; color: rgba(0,0,0,0.3); white-space: nowrap;">
                        © {{ now()->year }} {{ $book->author }}
                    </div>
                </div>
                <div class="absolute inset-0 pointer-events-none opacity-5 z-10 flex items-center justify-center overflow-hidden">
                    <div style="font-size: 80px; font-weight: bold; color: rgba(255,0,0,0.3); text-align: center; white-space: pre;">
HAK CIPTA DILINDUNGI
Dilarang dikopi/diunduh
                    </div>
                </div>
                
                @if($book->file_type === 'pdf')
                    @if($canReadFull)
                        <div id="pdf-container-full" class="w-full relative z-0"></div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.min.js"></script>
                        <script>
                            pdfjsLib.GlobalWorkerOptions.workerSrc =
                                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.worker.min.js';
                            const pdfUrl = '{{ asset('storage/' . $book->file_path) }}';
                            
                            pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                                const container = document.getElementById('pdf-container-full');
                                
                                for (let i = 1; i <= pdf.numPages; i++) {
                                    const pageDiv = document.createElement('div');
                                    pageDiv.style.marginBottom = '20px';
                                    pageDiv.style.position = 'relative';
                                    
                                    pdf.getPage(i).then(page => {
                                        const viewport = page.getViewport({ scale: 1.5 });
                                        const canvas = document.createElement('canvas');
                                        const ctx = canvas.getContext('2d');
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;
                                        canvas.style.maxWidth = '100%';
                                        canvas.style.height = 'auto';
                                        canvas.style.display = 'block';
                                        
                                        pageDiv.appendChild(canvas);
                                        container.appendChild(pageDiv);
                                        
                                        page.render({ canvasContext: ctx, viewport: viewport });
                                    });
                                }
                            }).catch(err => {
                                console.error('Failed to load PDF', err);
                                document.getElementById('pdf-container-full').innerHTML = '<p class="text-red-500">Tidak dapat menampilkan PDF.</p>';
                            });
                        </script>
                    @else
                        <div id="pdf-container" class="w-full"></div>
                        {{-- load pdf.js from CDN to render preview pages --}}
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.min.js"></script>
                        <script>
                            pdfjsLib.GlobalWorkerOptions.workerSrc =
                                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.worker.min.js';
                            const pdfUrl = '{{ asset('storage/' . $book->file_path) }}';
                            const maxPages = {{ $book->free_pages ?? 0 }};

                            pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                                const container = document.getElementById('pdf-container');
                                const limit = Math.min(pdf.numPages, maxPages);
                                for (let i = 1; i <= limit; i++) {
                                    const pageDiv = document.createElement('div');
                                    pageDiv.style.marginBottom = '20px';
                                    pageDiv.style.position = 'relative';
                                    
                                    pdf.getPage(i).then(page => {
                                        const viewport = page.getViewport({ scale: 1.5 });
                                        const canvas = document.createElement('canvas');
                                        const ctx = canvas.getContext('2d');
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;
                                        canvas.style.maxWidth = '100%';
                                        canvas.style.height = 'auto';
                                        canvas.style.display = 'block';
                                        
                                        pageDiv.appendChild(canvas);
                                        container.appendChild(pageDiv);
                                        page.render({ canvasContext: ctx, viewport: viewport });
                                    });
                                }
                            }).catch(err => {
                                console.error('Failed to load PDF preview', err);
                                container.innerHTML = '<p class="text-red-500">Tidak dapat menampilkan pratinjau.</p>';
                            });
                        </script>
                    @endif
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 mb-4">Format file: {{ strtoupper($book->file_type) }}</p>
                        <p class="text-sm text-yellow-600 mb-4">⚠️ Pengunduhan file tidak diizinkan untuk melindungi hak cipta penulis.</p>
                    </div>
                @endif
            </div>

            @if(!$canReadFull)
                <div class="mt-6 bg-gradient-to-r from-[#FF2D20] to-red-600 rounded-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Ingin melanjutkan membaca?</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="mb-2">Berlangganan untuk akses semua buku</p>
                            <a href="{{ route('subscriptions.index') }}" 
                               class="inline-block px-6 py-2 theme-card text-[#FF2D20] rounded-lg hover:bg-gray-100 transition-colors font-medium">
                                Lihat Paket Langganan
                            </a>
                        </div>
                        <div>
                            <p class="mb-2">Beli buku ini untuk akses penuh</p>
                            <form action="{{ route('books.purchase', $book->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="inline-block px-6 py-2 theme-card text-[#FF2D20] rounded-lg hover:bg-gray-100 transition-colors font-medium">
                                    Beli Sekarang (Rp {{ number_format($book->price, 0, ',', '.') }})
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-600">File buku tidak tersedia.</p>
            </div>
        @endif
    </div>
</div>

<!-- Copyright Protection Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const protectedContainer = document.querySelector('.pdf-protected-container');
    
    if (!protectedContainer) return;

    // Disable right-click
    protectedContainer.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        showCopyrightWarning('Klik kanan dilarang untuk melindungi hak cipta');
        return false;
    });

    // Disable text selection
    protectedContainer.style.userSelect = 'none';
    protectedContainer.style.webkitUserSelect = 'none';
    protectedContainer.style.msUserSelect = 'none';
    protectedContainer.style.mozUserSelect = 'none';

    // Disable copy
    protectedContainer.addEventListener('copy', function(e) {
        e.preventDefault();
        showCopyrightWarning('Penyalinan konten dilarang oleh pengaman hak cipta');
        return false;
    });

    // Disable cut
    protectedContainer.addEventListener('cut', function(e) {
        e.preventDefault();
        return false;
    });

    // Disable drag
    protectedContainer.addEventListener('drag', function(e) {
        e.preventDefault();
        return false;
    });
    
    protectedContainer.addEventListener('dragstart', function(e) {
        e.preventDefault();
        return false;
    });
});

// Prevent keyboard shortcuts
document.addEventListener('keydown', function(event) {
    const container = document.querySelector('.pdf-protected-container');
    
    // Allow Ctrl/Cmd+F for find in page (good for accessibility)
    if ((event.ctrlKey || event.metaKey) && event.key === 'f') {
        return;
    }
    
    // Prevent Ctrl+S (Save)
    if ((event.ctrlKey || event.metaKey) && event.key === 's') {
        event.preventDefault();
        showCopyrightWarning('Menyimpan file dilarang untuk melindungi hak cipta penulis');
        return false;
    }
    
    // Prevent Ctrl+C (Copy)
    if ((event.ctrlKey || event.metaKey) && event.key === 'c') {
        if (container && container.contains(document.activeElement)) {
            event.preventDefault();
            showCopyrightWarning('Penyalinan konten dilarang oleh pengaman hak cipta');
            return false;
        }
    }
    
    // Prevent Ctrl+P (Print) - optional, comment if you want to allow printing
    if ((event.ctrlKey || event.metaKey) && event.key === 'p') {
        event.preventDefault();
        showCopyrightWarning('Pencetakan konten dilarang untuk melindungi hak cipta');
        return false;
    }
});

function showCopyrightWarning(message) {
    // Check if warning already exists
    const existing = document.querySelector('.copyright-warning');
    if (existing) {
        return;
    }

    const warning = document.createElement('div');
    warning.className = 'copyright-warning fixed top-4 right-4 max-w-sm px-6 py-4 bg-red-500 text-white rounded-lg shadow-lg z-50 animate-pulse';
    warning.innerHTML = `
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            <div>
                <p class="font-semibold text-sm">⓵ Perlindungan Hak Cipta</p>
                <p class="text-xs mt-1">${message}</p>
            </div>
        </div>
    `;
    
    document.body.appendChild(warning);
    
    // Remove after 4 seconds
    setTimeout(function() {
        if (warning.parentNode) {
            warning.remove();
        }
    }, 4000);
}

// Log copyright warning attempt
function logCopyrightAttempt(action) {
    console.warn(`Copyright Protection: Attempt to ${action} blocked at {{ now() }}`);
}
</script>

@endsection
