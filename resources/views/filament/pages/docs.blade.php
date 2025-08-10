<x-filament-panels::page>
    <style>
        .docs-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background: #f8fafc;
            min-height: 100vh;
            border-radius: 8px;
        }

        .docs-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .docs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .docs-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            position: relative;
        }

        /* Preserve existing top border colors */
        .card-gallery {
            border-top: 3px solid #f59e0b;
        }

        .card-heroes {
            border-top: 3px solid #eab308;
        }

        .card-video {
            border-top: 3px solid #ef4444;
        }

        .card-users {
            border-top: 3px solid #4744ef;
        }

        .card-security {
            border-top: 3px solid #44ef61;
        }

        .card-role {
            border-top: 3px solid #ef6644;
        }

        .card-token {
            border-top: 3px solid #ef44c4;
        }

        /* Optimasi ukuran font dan spacing agar responsif */
        @media (max-width: 600px) {
            .docs-container {
                padding: 10px;
            }

            .docs-card {
                padding: 20px;
            }

            .docs-card h2 {
                font-size: 1.25rem;
            }

            .docs-card span.emoji {
                font-size: 2.5rem;
            }
        }
    </style>
    <div class="p-5 sm:p-10 bg-gray-100 min-h-screen rounded-md">
        <div class="mx-auto max-w-screen-lg px-2 sm:px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-8">
                <!-- Kartu 1 -->
                <div class="docs-card card-gallery bg-white rounded-lg p-8 shadow-sm border border-gray-200 relative">
                    <span class="emoji block mb-5 text-3xl text-yellow-500">📸</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Gallery Media</h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                        Pusat penyimpanan dan pengelolaan semua konten media visual untuk mendukung kebutuhan komunikasi
                        perusahaan.
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Foto kegiatan perusahaan dan operasional
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Dokumentasi acara korporat
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #f59e0b; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">Media
                        Management</span>
                </div>

                <!-- Main Heroes Feature -->
                <div class="docs-card card-heroes bg-white rounded-lg p-8 shadow-sm border border-gray-200">
                    <span class="emoji block mb-5 text-3xl text-yellow-500">⭐</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Main Heroes</h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                        Kelola konten utama dan unggulan yang ditampilkan di halaman depan untuk memberikan kesan
                        pertama yang kuat.
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Banner dengan pesan kunci perusahaan
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Logo Perusahaan sekaligus Logo Perushaan yang berkolaborasi
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Call-to-action strategis untuk pengunjung
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Hero section sebagai focal point website
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #eab308; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">Content
                        Spotlight</span>
                </div>

                <!-- Post Video YouTube Feature -->
                <div class="docs-card card-video bg-white rounded-lg p-8 shadow-sm border border-gray-200">
                    <span class="emoji block mb-5 text-3xl text-red-500">🎥</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Post Video YouTube</h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                        Integrasi seamless dengan platform YouTube untuk mengelola dan menampilkan konten video secara
                        profesional.
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Embed video YouTube ke dalam website
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Manajemen konten video edukasi
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Tampilan berdasarkan kategori dan Tag
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #ef4444; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">Video
                        Integration</span>
                </div>

                 <!-- Users ( Auth / Login ) Feature -->
                <div class="docs-card card-users bg-white rounded-lg p-8 shadow-sm border border-gray-200">
                    <span class="emoji block mb-5 text-3xl text-red-500">👥</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Users ( Auth / Login )</h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                       Fitur untuk mengelola sistem autentikasi dan pengguna.
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Registrasi pengguna baru - Admin dapat membuat akun untuk user baru
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Profile management - Edit informasi profil user
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Password reset - Reset password untuk user yang lupa
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #ef4444; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">Users Management</span>
                </div>

                 <!-- Security Section  Feature -->
                <div class="docs-card card-security bg-white rounded-lg p-8 shadow-sm border border-gray-200">
                    <span class="emoji block mb-5 text-3xl text-red-500">🔐</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Security Section </h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                       Mengatur hak akses detail untuk setiap fungsi sistem
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            CRUD ( Create, Read, Update, Delete ) permissions - Create, Read, Update, Delete untuk setiap modul
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Menu access - Siapa saja yang bisa akses menu tertentu
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Feature permissions - Akses ke fitur spesifik (upload, export, dll)
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            API permissions - Hak akses untuk endpoint API
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Custom permissions - Buat permission khusus sesuai kebutuhan
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #ef4444; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">Permission</span>
                </div>

                 <!-- Roles Feature -->
                <div class="docs-card card-role bg-white rounded-lg p-8 shadow-sm border border-gray-200">
                    <span class="emoji block mb-5 text-3xl text-red-500">👑</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Roles</h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                      Kelompok/peran pengguna dengan set permission tertentu
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Untuk Membatasi apa saja yang dapat dilakukan pengguna
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Roles dan permission sangat berkaitan, roles di isi beberapa permissions
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Pastikan Tidak Mengubah Roles Super Admin dan Panel User ya 😉
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Panel User harus selalu ada ketika menambahkan users baru agar bisa log in
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #ef4444; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">User Rights</span>
                </div>

                 <!-- Tokens  Feature -->
                <div class="docs-card card-token bg-white rounded-lg p-8 shadow-sm border border-gray-200">
                    <span class="emoji block mb-5 text-3xl text-red-500">🎫</span>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Tokens</h2>
                    <p style="color: #34495e; margin-bottom: 20px; line-height: 1.7;">
                      Manajemen token untuk API dan autentikasi
                    </p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Kode Hash yang digunakan untuk menhubungkan 2 buah aplikasi atau lebih
                        </li>
                        <li style="padding: 8px 0; padding-left: 25px; position: relative; color: #555;">
                            <span style="position: absolute; left: 0; color: #10b981; font-weight: bold;">✓</span>
                            Jangan Hapus token yang sudah ada yaa...😉😉
                        </li>
                    </ul>
                    <span
                        style="display: inline-block; background: #ef4444; color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-top: 15px;">User Rights</span>
                </div>

            </div>
        </div>
    </div>
</x-filament-panels::page>
