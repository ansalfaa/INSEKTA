<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>INSEKTA - Beranda</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-light-amber via-accent-amber/30 to-light-amber/20 min-h-screen font-sans">
    <!-- Navigation Bar -->
    <nav
        class="bg-dark-amber/90 text-white backdrop-blur-md shadow-sm border-b border-dark-amber/60 sticky top-0 z-50 h-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logoputih.png') }}" alt="Insekta Logo"
                        class="h-12 w-auto object-contain hover:scale-105 transition-transform duration-300" />
                </div>
                <!-- Text -->
                <div class="text-sm font-medium">
                    Media Sosial Internal Skaduta
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <!-- Left Content -->
            <div class="mb-12 lg:mb-0">
                <!-- Logo INSEKTA -->
                <div class="flex items-center justify-start mb-8">
                    <img src="{{ asset('images/logono.png') }}" alt="Logo INSEKTA"
                        class="w-24 h-24 object-contain hover:scale-105 transition-transform duration-300" />
                </div>

                <!-- Title & Description -->
                <div class="text-center lg:text-left mb-8">
                    <h1 class="text-4xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        Selamat Datang di
                        <span
                            class="block bg-gradient-to-r from-primary-amber via-accent-amber to-dark-amber bg-clip-text text-transparent">
                            INSEKTA
                        </span>
                    </h1>
                    <p class="text-xl text-slate-600 leading-relaxed max-w-2xl">
                        Platform pembelajaran digital yang menghubungkan siswa, guru, dan komunitas sekolah dalam
                        satu ekosistem yang terintegrasi
                    </p>
                </div>

                <!-- Carousel Fitur -->
                <section class="mb-10 relative">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 text-center lg:text-left">Galeri Fitur</h2>
                    <div id="feature-carousel"
                        class="flex overflow-x-hidden snap-x snap-mandatory pb-4 carousel-container transition-transform duration-500 ease-in-out">
                        <!-- Slides -->
                        <div class="flex-shrink-0 w-full snap-start" data-slide-index="0">
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition-shadow duration-300">
                                <img src="{{ asset('images/placeholder.svg?height=300&width=800') }}"
                                    alt="Fitur Interaktif" class="w-full h-64 object-cover" />
                                <div class="p-4">
                                    <h3 class="font-semibold text-slate-900 text-lg mb-2">Fitur Interaktif</h3>
                                    <p class="text-slate-600 text-sm">Jelajahi berbagai fitur interaktif kami.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-full snap-start" data-slide-index="1">
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition-shadow duration-300">
                                <img src="{{ asset('images/placeholder.svg?height=300&width=800') }}"
                                    alt="Komunitas Aktif" class="w-full h-64 object-cover" />
                                <div class="p-4">
                                    <h3 class="font-semibold text-slate-900 text-lg mb-2">Komunitas Aktif</h3>
                                    <p class="text-slate-600 text-sm">Terhubung dengan siswa dan guru lainnya.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-full snap-start" data-slide-index="2">
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition-shadow duration-300">
                                <img src="{{ asset('images/placeholder.svg?height=300&width=800') }}"
                                    alt="Materi Lengkap" class="w-full h-64 object-cover" />
                                <div class="p-4">
                                    <h3 class="font-semibold text-slate-900 text-lg mb-2">Materi Lengkap</h3>
                                    <p class="text-slate-600 text-sm">Akses ribuan materi pembelajaran.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-full snap-start" data-slide-index="3">
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition-shadow duration-300">
                                <img src="{{ asset('images/placeholder.svg?height=300&width=800') }}"
                                    alt="Tantangan Seru" class="w-full h-64 object-cover" />
                                <div class="p-4">
                                    <h3 class="font-semibold text-slate-900 text-lg mb-2">Tantangan Seru</h3>
                                    <p class="text-slate-600 text-sm">Ikuti tantangan dan raih prestasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <button id="prev-slide"
                        class="absolute top-1/2 left-0 -translate-y-1/2 bg-white/70 backdrop-blur-md p-2 rounded-full shadow-md hover:bg-white transition-colors duration-200 z-10 ml-4"
                        aria-label="Previous slide">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-slide"
                        class="absolute top-1/2 right-0 -translate-y-1/2 bg-white/70 backdrop-blur-md p-2 rounded-full shadow-md hover:bg-white transition-colors duration-200 z-10 mr-4"
                        aria-label="Next slide">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Pagination Dots -->
                    <div id="carousel-dots" class="flex justify-center mt-6 space-x-2"></div>
                </section>

                <!-- CTA Button -->
                <div class="text-center lg:text-left">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-amber to-dark-amber hover:from-accent-amber hover:to-dark-amber text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group hover:-translate-y-0.5">
                        Masuk ke INSEKTA
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <p class="mt-4 text-slate-500">
                        Belum punya akun?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-primary-amber hover:text-accent-amber hover:underline transition-colors duration-200">Hubungi
                            Admin</a>
                    </p>
                </div>
            </div>

            <!-- Right Content -->
            <div class="lg:pl-8">
                <div class="bg-white/80 backdrop-blur-md shadow-2xl border-0 rounded-2xl overflow-hidden">
                    <!-- Stats Header -->
                    <div class="p-8 text-center mb-8">
                        <h2 class="text-3xl font-bold text-slate-900 mb-3">Masuk Untuk Melihat</h2>
                        <p class="text-slate-600 text-lg">Ribuan siswa dan guru telah bergabung</p>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-3 gap-6 mb-10 px-8">
                        <div class="text-center hover:scale-105 transition-transform duration-300">
                            <div
                                class="text-4xl font-bold bg-gradient-to-r from-primary-amber to-dark-amber bg-clip-text text-transparent mb-2">
                                1,200+
                            </div>
                            <div class="text-sm text-slate-600 font-medium">Siswa Aktif</div>
                        </div>
                        <div class="text-center hover:scale-105 transition-transform duration-300">
                            <div
                                class="text-4xl font-bold bg-gradient-to-r from-primary-amber to-dark-amber bg-clip-text text-transparent mb-2">
                                85+
                            </div>
                            <div class="text-sm text-slate-600 font-medium">Guru</div>
                        </div>
                        <div class="text-center hover:scale-105 transition-transform duration-300">
                            <div
                                class="text-4xl font-bold bg-gradient-to-r from-primary-amber to-dark-amber bg-clip-text text-transparent mb-2">
                                150+
                            </div>
                            <div class="text-sm text-slate-600 font-medium">Kegiatan</div>
                        </div>
                    </div>

                    <!-- Aktivitas Terbaru -->
                    <div class="space-y-4 p-8 pt-0">
                        <h3 class="font-bold text-slate-900 mb-6 text-xl">Aktivitas Terbaru</h3>
                        <div
                            class="flex items-center space-x-4 p-4 bg-gradient-to-r from-light-blue to-light-blue/50 rounded-xl hover:shadow-md transition-all duration-300 hover:translate-x-1 group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-primary-amber to-dark-amber rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-slate-900">Challenge Matematika</p>
                                <p class="text-sm text-slate-500">45 siswa berpartisipasi</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center space-x-4 p-4 bg-gradient-to-r from-light-blue to-light-blue/50 rounded-xl hover:shadow-md transition-all duration-300 hover:translate-x-1 group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-primary-amber to-dark-amber rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-slate-900">Diskusi Proyek Akhir</p>
                                <p class="text-sm text-slate-500">23 komentar baru</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center space-x-4 p-4 bg-gradient-to-r from-light-blue to-light-blue/50 rounded-xl hover:shadow-md transition-all duration-300 hover:translate-x-1 group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-primary-amber to-dark-amber rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-slate-900">Polling Kegiatan Sekolah</p>
                                <p class="text-sm text-slate-500">Berakhir dalam 2 hari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-md border-t border-white/20 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-slate-600">
                <p>&copy; 2024 INSEKTA - Media Sosial Internal Skaduta. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Carousel Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
                    const carousel = document.getElementById('feature-carousel');
                    const slides = carousel.querySelectorAll('[data-slide-index]');
                    const prevBtn = document.getElementById('prev-slide');
                    const nextBtn = document.getElementById('next-slide');
                    const dotsContainer = document.getElementById('carousel-dots');
                    let currentIndex = 0;
                    const totalSlides = slides.length;

                    // Buat pagination dots
                    for (let i = 0; i < totalSlides; i++) {
                        const dot = document.createElement('button');
                        dot.className = 'w-3 h-3 rounded-full bg-gray-400 hover:bg-primary-amber transition-colors duration-300'
                        ;
                        dot.setAttribute('aria-label', `Slide ${i + 1}`);
                        dot.addEventListener('click', () => goToSlide(i));
                        dotsContainer.appendChild(dot);
                    }
                    const dots = dotsContainer.querySelectorAll('button');

                    function updateDots() {
                        dots.forEach((dot, idx) => {
                            if (idx === currentIndex) {
                                dot.classList.add('bg-primary-amber');
                                dot.classList.remove('bg-gray-400');
                            } else {
                                dot.classList.remove('bg-primary-amber');
                                dot.classList.add('bg-gray-400');
                            }
                        });
                    }

                    function goToSlide(index) {
                        if (index < 0) index = totalSlides - 1;
                        if (index >= totalSlides) index = 0;
                        currentIndex = index;
                        const slideWidth = slides[0].offsetWidth;
                        carousel.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
                        updateDots();
                    }

                    prevBtn.addEventListener('click', () => {
                        goToSlide(currentIndex - 1);
                    });

                    nextBtn.addEventListener('click', () => {
                                goToSlide(currentIndex + 1);
