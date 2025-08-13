{{-- Form Pengumuman Global --}}
<div class="bg-white rounded-xl shadow-sm border border-amber-100 p-4 lg:p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">
            {{ isset($pengumuman) ? 'Edit Pengumuman' : 'Buat Pengumuman Global' }}
        </h2>
    </div>

    {{-- Success/Error Messages --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-sm font-medium text-red-700 mb-1">Terjadi kesalahan:</p>
                    <ul class="text-sm text-red-600 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ $action ?? route('admin.pengumuman.store') }}" method="POST" id="pengumumanForm"
        class="space-y-4">
        @csrf
        @if (isset($method) && $method === 'PUT')
            @method('PUT')
        @endif

        {{-- Judul Pengumuman --}}
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                Judul Pengumuman <span class="text-red-500">*</span>
            </label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $pengumuman->judul ?? '') }}"
                placeholder="Masukkan judul pengumuman..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('judul') border-red-300 @enderror"
                required>
            @error('judul')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Isi Pengumuman --}}
        <div>
            <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                Isi Pengumuman <span class="text-red-500">*</span>
            </label>
            <textarea id="isi" name="isi" rows="6" placeholder="Tulis isi pengumuman di sini..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors resize-none @error('isi') border-red-300 @enderror"
                required>{{ old('isi', $pengumuman->isi ?? '') }}</textarea>
            @error('isi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">Minimal 10 karakter, maksimal 1000 karakter</p>
        </div>

        {{-- Priority Level --}}
        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                Tingkat Prioritas
            </label>
            <select id="priority" name="priority"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                <option value="normal"
                    {{ old('priority', $pengumuman->priority ?? 'normal') === 'normal' ? 'selected' : '' }}>
                    Normal
                </option>
                <option value="penting"
                    {{ old('priority', $pengumuman->priority ?? '') === 'penting' ? 'selected' : '' }}>
                    Penting
                </option>
                <option value="urgent"
                    {{ old('priority', $pengumuman->priority ?? '') === 'urgent' ? 'selected' : '' }}>
                    Urgent
                </option>
            </select>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
            <button type="submit" id="submitBtn"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span id="submitText">{{ isset($pengumuman) ? 'Update Pengumuman' : 'Kirim Pengumuman' }}</span>
            </button>

            @if (isset($pengumuman))
                <a href="{{ route('admin.pengumuman.index') }}"
                    class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    Batal
                </a>
            @else
            @endif
        </div>
    </form>
</div>

{{-- JavaScript for Form Enhancement --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('pengumumanForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const originalText = submitText.textContent;

        // Form submission handling
        form.addEventListener('submit', function(e) {
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitText.textContent = 'Mengirim...';

            // Re-enable after 3 seconds as fallback
            setTimeout(() => {
                submitBtn.disabled = false;
                submitText.textContent = originalText;
            }, 3000);
        });

        // Character counter for textarea
        const textarea = document.getElementById('isi');
        const maxLength = 1000;

        // Create character counter element
        const counterDiv = document.createElement('div');
        counterDiv.className = 'text-xs text-gray-500 mt-1 text-right';
        counterDiv.id = 'charCounter';
        textarea.parentNode.appendChild(counterDiv);

        function updateCounter() {
            const remaining = maxLength - textarea.value.length;
            counterDiv.textContent = `${textarea.value.length}/${maxLength} karakter`;

            if (remaining < 50) {
                counterDiv.className = 'text-xs text-red-500 mt-1 text-right';
            } else if (remaining < 100) {
                counterDiv.className = 'text-xs text-yellow-600 mt-1 text-right';
            } else {
                counterDiv.className = 'text-xs text-gray-500 mt-1 text-right';
            }
        }

        textarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    });

    // Reset form function
    function resetForm() {
        if (confirm('Yakin ingin mereset form? Semua data yang diisi akan hilang.')) {
            document.getElementById('pengumumanForm').reset();
            document.getElementById('charCounter').textContent = '0/1000 karakter';
            document.getElementById('charCounter').className = 'text-xs text-gray-500 mt-1 text-right';
        }
    }

    // Auto-hide success/error messages after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
