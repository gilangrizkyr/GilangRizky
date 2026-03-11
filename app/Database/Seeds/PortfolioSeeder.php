<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        // Bio Data
        $this->db->table('bio')->truncate();
        $this->db->table('bio')->insert([
            'id' => 1,
            'name' => 'Gilang Rizky',
            'title' => 'Full-Stack Developer & Creative Engineer',
            'photo' => '/assets/images/profile.jpg',
            'github_url' => 'https://github.com/gilangrizkyr',
            'instagram_url' => 'https://instagram.com/gilangrizkyr',
            'email' => 'ikyappmastering@gmail.com',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Skills Data
        $this->db->table('skills')->truncate();
        $skills = [
            ['title' => 'Python', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg', 'sort_order' => 1],
            ['title' => 'JavaScript', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'sort_order' => 2],
            ['title' => 'PHP', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg', 'sort_order' => 3],
            ['title' => 'Java', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg', 'sort_order' => 4],
            ['title' => 'CSS', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg', 'sort_order' => 5],
            ['title' => 'Kotlin', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/kotlin/kotlin-original.svg', 'sort_order' => 6],
            ['title' => 'React', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg', 'sort_order' => 7],
            ['title' => 'Vue.js', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'sort_order' => 8],
            ['title' => 'Laravel', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'sort_order' => 9],
            ['title' => 'Express.js', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/express/express-original-wordmark.svg', 'sort_order' => 10],
            ['title' => 'Flutter', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg', 'sort_order' => 11],
            ['title' => 'CodeIgniter', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/codeigniter/codeigniter-plain.svg', 'sort_order' => 12],
            ['title' => 'MySQL', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'sort_order' => 13],
            ['title' => 'PostgreSQL', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg', 'sort_order' => 14],
            ['title' => 'MongoDB', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg', 'sort_order' => 15],
            ['title' => 'Firebase', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg', 'sort_order' => 16],
            ['title' => 'SQLite', 'external_icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sqlite/sqlite-original.svg', 'sort_order' => 17],
        ];
        $this->db->table('skills')->insertBatch($skills);

        // Projects Data
        $this->db->table('projects')->truncate();
        $now = date('Y-m-d H:i:s');
        $projects = [
            [
                'title' => 'EcoSmart Dashboard',
                'slug' => 'ecosmart-dashboard',
                'main_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Platform analitik energi terintegrasi untuk smart city dengan visualisasi data real-time.',
                'body' => '<p>EcoSmart Dashboard adalah platform revolusioner yang menggabungkan data energi dari berbagai sumber untuk memberikan wawasan mendalam kepada pengelola kota pintar. Dengan antarmuka yang intuitif dan visualisasi real-time, pengambil keputusan dapat memantau konsumsi energi, mengidentifikasi inefisiensi, dan mengoptimalkan distribusi dengan presisi tinggi.</p>',
                'tech_stack' => json_encode(['Next.js', 'D3.js', 'Tailwind', 'Node.js']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'NeuroSphere AI',
                'slug' => 'neurosphere-ai',
                'main_image' => 'https://images.unsplash.com/photo-1507146153580-69a1fe6d8aa1?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Antarmuka saraf mesin berbasis web menggunakan AI untuk memproses sinyal kognitif.',
                'body' => '<p>NeuroSphere AI menghadirkan teknologi machine learning terdepan langsung ke browser. Sistem ini mampu memproses dan menganalisis sinyal kognitif secara real-time, membuka peluang baru dalam bidang neurotechnology dan human-computer interaction.</p>',
                'tech_stack' => json_encode(['React', 'TensorFlow.js', 'Three.js', 'Python']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Vortex NFT Market',
                'slug' => 'vortex-nft-market',
                'main_image' => 'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Pasar koleksi digital dengan sistem lelang terdesentralisasi dan keamanan berlapis.',
                'body' => '<p>Vortex adalah marketplace NFT generasi berikutnya yang dibangun di atas blockchain Ethereum. Dengan sistem lelang otomatis, smart contract yang diaudit secara independen, dan antarmuka pengguna yang elegan, Vortex menghadirkan pengalaman jual-beli aset digital yang aman dan menyenangkan.</p>',
                'tech_stack' => json_encode(['Solidity', 'Web3.js', 'Ethers.js', 'React']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Aura Health App',
                'slug' => 'aura-health-app',
                'main_image' => 'https://images.unsplash.com/photo-1516062423079-7ca13cdc7f5a?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Aplikasi manajemen kesehatan mental dengan fitur biofeedback dan meditasi adaptif.',
                'body' => '<p>Aura Health App menggabungkan teknologi biofeedback dengan kecerdasan buatan untuk menciptakan pengalaman meditasi yang benar-benar personal. Aplikasi ini belajar dari pola stres pengguna dan mengadaptasi sesi meditasi secara dinamis untuk hasil yang optimal.</p>',
                'tech_stack' => json_encode(['React Native', 'Supabase', 'ML Kit', 'Flutter']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Zenith CRM',
                'slug' => 'zenith-crm',
                'main_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Sistem manajemen pelanggan skala enterprise dengan integrasi otomasi pemasaran.',
                'body' => '<p>Zenith CRM adalah solusi manajemen hubungan pelanggan yang dirancang untuk skala enterprise. Dengan pipeline visual, otomasi email marketing, dan analitik mendalam, Zenith membantu tim penjualan meningkatkan konversi hingga 40% dan mempertahankan pelanggan dengan lebih efektif.</p>',
                'tech_stack' => json_encode(['Node.js', 'PostgreSQL', 'Next.js', 'Redis']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Lumina Studio',
                'slug' => 'lumina-studio',
                'main_image' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Platform kolaborasi kreatif untuk seniman 3D dengan rendering cloud terintegrasi.',
                'body' => '<p>Lumina Studio adalah workspace kolaboratif berbasis cloud untuk seniman dan desainer 3D. Dengan teknologi WebGL terkini dan rendering cloud yang handal, tim dapat bekerja bersama secara real-time pada proyek 3D yang kompleks tanpa batasan hardware lokal.</p>',
                'tech_stack' => json_encode(['Three.js', 'WebRTC', 'Socket.io', 'WebGL']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Terra Logistics',
                'slug' => 'terra-logistics',
                'main_image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=1200',
                'description' => 'Sistem pelacakan rantai pasok global dengan optimasi rute bertenaga AI.',
                'body' => '<p>Terra Logistics menggunakan kecerdasan buatan untuk mengoptimalkan rute pengiriman secara dinamis, mempertimbangkan ratusan variabel seperti cuaca, kepadatan lalu lintas, dan kapasitas kendaraan. Hasilnya adalah pengurangan biaya logistik hingga 25% dan peningkatan ketepatan waktu yang signifikan.</p>',
                'tech_stack' => json_encode(['Mapbox', 'Python', 'FastAPI', 'React', 'MySQL']),
                'link' => '#',
                'github' => '#',
                'sort_order' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('projects')->insertBatch($projects);

        echo "Portfolio data seeded successfully!\n";
    }
}
