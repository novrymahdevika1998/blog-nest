-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for blogprojectdb
CREATE DATABASE IF NOT EXISTS `blogprojectdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `blogprojectdb`;

-- Dumping structure for table blogprojectdb.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_views` int,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blogprojectdb.posts: ~5 rows (approximately)
INSERT INTO `posts` (`id`, `title`, `image_path`, `content`, `author`, `is_published`, `created_at`) VALUES
	(9, 'Menguak Dunia Front-End: Seni Membangun Pengalaman Pengguna yang Memukau', 'uploads/ba481285f0b462c30c636b0ddca7a7ae.jpg', '<h1>Menguak Dunia Front-End: Seni Membangun Pengalaman Pengguna yang Memukau</h1>\r\n<p>Dalam dunia pengembangan web dan aplikasi, front-end merupakan zona di mana seni dan teknologi bertemu untuk menciptakan pengalaman pengguna (user experience - UX) yang menarik dan intuitif. Front-end adalah segalanya yang Anda lihat dan interaksikan langsung di dalam web browser atau aplikasi mobile; dari tata letak, desain, hingga cara sebuah situs web atau aplikasi merespons interaksi pengguna. Dengan kemajuan teknologi dan metodologi desain, ruang lingkup dan kemampuan front-end terus berkembang, membuatnya menjadi bidang yang dinamis dan menantang.</p>\r\n<h2>Fondasi Front-End: HTML, CSS, dan JavaScript</h2>\r\n<p>Tiga teknologi utama yang membentuk fondasi dari semua pengembangan front-end adalah HTML, CSS, dan JavaScript, yang masing-masing memainkan peran unik dalam pembuatan halaman web:</p>\r\n<ul>\r\n<li><strong>HTML (Hypertext Markup Language)</strong> adalah kerangka kerja dasar dari setiap halaman web, digunakan untuk struktur konten.</li>\r\n<li><strong>CSS (Cascading Style Sheets)</strong> digunakan untuk mengatur tampilan dan gaya halaman, termasuk layout, warna, dan font.</li>\r\n<li><strong>JavaScript</strong> adalah bahasa pemrograman yang digunakan untuk membuat halaman web menjadi interaktif dan dinamis.</li>\r\n</ul>\r\n<h2>Framework dan Library Populer</h2>\r\n<p>Pengembangan front-end modern seringkali memanfaatkan framework dan library untuk mempercepat proses pengembangan dan meningkatkan kualitas kode. Beberapa yang paling populer termasuk:</p>\r\n<ul>\r\n<li><strong>React.js</strong>: Library JavaScript dari Facebook yang memungkinkan pembuatan UI yang interaktif dan efisien.</li>\r\n<li><strong>Angular</strong>: Framework JavaScript dari Google yang menyediakan banyak tools dan konsep yang memudahkan pembuatan aplikasi single-page yang kompleks.</li>\r\n<li><strong>Vue.js</strong>: Framework yang ringan dan mudah untuk diintegrasikan ke dalam proyek yang sudah ada, sangat cocok untuk membangun antarmuka pengguna yang cepat dan interaktif.</li>\r\n<li><strong>Bootstrap</strong>: Framework CSS yang memberikan berbagai elemen desain dan komponen UI yang siap pakai, memudahkan pembuatan tampilan yang responsif dan menarik.</li>\r\n</ul>\r\n<h2>Tantangan dan Trend Terkini</h2>\r\n<p>Pengembangan front-end tidak hanya sekedar membuat halaman web yang terlihat bagus. Pengembang dihadapkan pada berbagai tantangan, seperti memastikan kecepatan memuat halaman, responsivitas pada berbagai perangkat dan ukuran layar, hingga aksesibilitas bagi pengguna dengan kebutuhan khusus.</p>\r\n<p>Beberapa trend terkini dalam pengembangan front-end meliputi:</p>\r\n<ul>\r\n<li><strong>PWA (Progressive Web Apps)</strong>: Menggabungkan fitur terbaik dari web dan aplikasi mobile, memungkinkan pengalaman pengguna yang lebih cepat, lebih lancar, dan dapat diakses offline.</li>\r\n<li><strong>SPA (Single Page Applications)</strong>: Memuat seluruh konten melalui satu halaman web, meningkatkan performa dan pengalaman pengguna.</li>\r\n<li><strong>Responsive Design</strong>: Desain yang dapat menyesuaikan tampilan berdasarkan ukuran layar dan orientasi perangkat, memastikan aksesibilitas yang luas.</li>\r\n<li><strong>Web Components</strong>: Memungkinkan pembuatan elemen UI yang dapat digunakan kembali, meningkatkan efisiensi dan konsistensi dalam pengembangan front-end.</li>\r\n</ul>\r\n<h2>Kesimpulan</h2>\r\n<p>Front-end adalah bidang yang terus berinovasi, mendorong batas-batas teknologi untuk menciptakan pengalaman pengguna yang lebih kaya dan lebih interaktif. Dengan memahami fondasi teknologi, mengikuti trend terkini, dan terus belajar dan beradaptasi, pengembang front-end dapat menciptakan solusi yang tidak hanya memenuhi, tetapi juga melebihi ekspektasi pengguna. Di era digital ini, keahlian dalam pengembangan front-end menjadi semakin berharga, membuka pintu untuk menciptakan aplikasi web dan mobile yang memukau dan berdampak besar terhadap keberhasilan bisnis dan kepuasan pengguna.</p>', '15', 1, '2024-02-27 02:57:35'),
	(12, 'Embracing a Minimalist Lifestyle', 'uploads/8ae1d40de2a3fe9b0c6a50a926234ad8.jpg', '<h1><strong>Embracing a Minimalist Lifestyle</strong></h1>\r\n<p>In a world inundated with consumerism and constant consumption, the allure of minimalism is growing stronger. But what exactly does it mean to live a minimalist lifestyle?</p>\r\n<p>At its core, minimalism is about living intentionally and focusing on what truly adds value to your life while eliminating excess. This doesn\'t necessarily mean you have to get rid of all your possessions and live in a stark, empty space. Instead, it\'s about decluttering both your physical and mental spaces to make room for the things that truly matter.</p>\r\n<p>Embracing minimalism can lead to a sense of freedom and contentment. By simplifying your life, you reduce stress and overwhelm, allowing you to focus on the things that bring you joy and fulfillment. Whether it\'s spending time with loved ones, pursuing your passions, or simply enjoying the present moment, minimalism encourages you to prioritize experiences over possessions.</p>\r\n<p>So how can you start living a more minimalist lifestyle? Begin by evaluating your belongings and identifying what truly adds value to your life. Let go of items that no longer serve a purpose or bring you joy. Practice mindfulness and intentionality in your daily choices, whether it\'s what you buy, how you spend your time, or the relationships you nurture.</p>\r\n<p>Remember, minimalism looks different for everyone. It\'s not about adhering to strict rules or depriving yourself of things you enjoy. Instead, it\'s about finding balance and living in a way that aligns with your values and priorities. By embracing a minimalist lifestyle, you can create a more meaningful and fulfilling existence.</p>', '17', 1, '2024-03-05 04:04:19'),
	(20, 'Cultivating Healthy Relationships: The Foundation of Fulfillment', 'uploads/ab1d48313db78c061fcdb4046b607e4f.png', '<h1>Cultivating Healthy Relationships: The Foundation of Fulfillment</h1>\r\n<p>Healthy relationships are the cornerstone of a fulfilling and meaningful life. Whether they\'re with family, friends, or romantic partners, nurturing strong and supportive connections can profoundly impact our well-being and happiness.</p>\r\n<p>Communication lies at the heart of every healthy relationship. Open and honest communication fosters trust, understanding, and mutual respect. It\'s essential to express our thoughts, feelings, and needs openly while also being receptive to those of others. Active listening and empathy are key components of effective communication, allowing us to truly connect with and validate the experiences of our loved ones.</p>\r\n<p>Respect is another fundamental aspect of healthy relationships. Respecting each other\'s boundaries, opinions, and individuality lays the groundwork for a harmonious and mutually fulfilling connection. It\'s essential to treat each other with kindness, compassion, and consideration, even in moments of disagreement or conflict.</p>\r\n<p>Trust is the bedrock of any successful relationship. Building and maintaining trust requires consistency, reliability, and integrity. Honoring commitments, being dependable, and demonstrating honesty and transparency are crucial for fostering trust and security in our relationships.</p>\r\n<p>Furthermore, healthy relationships thrive on mutual support and encouragement. Celebrating each other\'s successes, offering comfort during challenging times, and being each other\'s cheerleaders create a nurturing and uplifting environment that strengthens the bond between individuals.</p>\r\n<p>Conflict is inevitable in any relationship, but how we navigate it determines its impact. Healthy relationships involve resolving conflicts respectfully and constructively, focusing on finding solutions rather than assigning blame. Effective conflict resolution requires active listening, compromise, and a willingness to understand each other\'s perspectives.</p>\r\n<p>Ultimately, cultivating healthy relationships requires ongoing effort, patience, and commitment from all parties involved. By prioritizing open communication, respect, trust, support, and constructive conflict resolution, we can foster deep and meaningful connections that enrich our lives and contribute to our overall happiness and well-being.</p>', '15', 1, '2024-03-05 04:25:31'),
	(21, 'Harnessing the Power of Sport: Transforming Lives and Communities', '', '<h3>Harnessing the Power of Sport: Transforming Lives and Communities</h3>\r\n<p>Sport is more than just a physical activity&mdash;it\'s a powerful tool for personal growth, community development, and societal change. Whether it\'s on the field, court, track, or in the gym, engaging in sports offers a myriad of benefits that extend far beyond the realm of physical fitness.</p>\r\n<p>One of the most significant advantages of participating in sports is its positive impact on physical health. Regular physical activity improves cardiovascular health, builds strength and endurance, and enhances flexibility and coordination. Moreover, sports promote a healthy lifestyle by encouraging habits such as proper nutrition, hydration, and rest.</p>\r\n<p>Beyond the physical benefits, sports also play a crucial role in mental and emotional well-being. Engaging in sports provides an outlet for stress relief, boosts mood through the release of endorphins, and fosters a sense of accomplishment and self-confidence. Moreover, participating in team sports cultivates important social skills such as teamwork, communication, and leadership, which are invaluable in both personal and professional settings.</p>\r\n<p>Sport has the power to unite communities and break down barriers. It brings people from diverse backgrounds together, fostering camaraderie, mutual respect, and understanding. Through sports, individuals learn to appreciate and celebrate differences while working towards common goals.</p>\r\n<p>Furthermore, sports can be a catalyst for social change and empowerment. They provide opportunities for marginalized groups, including women, people with disabilities, and disadvantaged youth, to challenge stereotypes, overcome obstacles, and achieve their full potential. Sports-based initiatives and programs promote inclusivity, equality, and empowerment, paving the way for a more just and equitable society.</p>\r\n<p>In conclusion, sport is a transformative force that enriches lives, strengthens communities, and drives positive change. By embracing the power of sports and promoting access and participation for all, we can harness its immense potential to create a healthier, happier, and more inclusive world.</p>', '15', 1, '2024-03-05 04:28:18'),
	(22, 'Angkat Beban: Manfaat, Teknik, dan Kesalahan yang Harus Dihindari', 'uploads/a7fea02db3d1c8653d96b0b3d2ac9fa9.jpg', '<h1>Angkat Beban: Manfaat, Teknik, dan Kesalahan yang Harus Dihindari</h1>\r\n<p>Angkat beban, dikenal juga sebagai latihan kekuatan atau resistance training, merupakan komponen penting dalam program kebugaran. Bukan hanya untuk binaragawan, aktivitas ini juga memberikan manfaat luas bagi semua orang, mulai dari peningkatan kekuatan dan massa otot, hingga peningkatan kesehatan metabolik dan mental. Dalam artikel ini, kita akan membahas manfaat angkat beban, teknik dasar yang benar, dan kesalahan umum yang sering terjadi.</p>\r\n<h2>Manfaat Angkat Beban</h2>\r\n<h3>1. Meningkatkan Kekuatan dan Massa Otot</h3>\r\n<p>Latihan angkat beban secara rutin dapat meningkatkan kekuatan dan massa otot. Ini terjadi karena proses hipertrofi, di mana serat otot mengalami kerusakan mikro selama latihan dan memperbaiki diri menjadi lebih kuat selama masa pemulihan.</p>\r\n<h3>2. Mendukung Kesehatan Tulang</h3>\r\n<p>Aktivitas ini juga meningkatkan kepadatan tulang. Stres mekanis pada tulang selama angkat beban merangsang pembentukan tulang baru, mengurangi risiko osteoporosis.</p>\r\n<h3>3. Meningkatkan Metabolisme</h3>\r\n<p>Meningkatnya massa otot dapat meningkatkan laju metabolisme basal, yang berarti Anda membakar lebih banyak kalori bahkan saat istirahat.</p>\r\n<h3>4. Mengurangi Risiko Penyakit Kronis</h3>\r\n<p>Penelitian menunjukkan bahwa angkat beban dapat menurunkan tekanan darah, meningkatkan sensitivitas insulin, dan menurunkan risiko penyakit jantung dan diabetes tipe 2.</p>\r\n<h3>5. Meningkatkan Kesehatan Mental</h3>\r\n<p>Latihan kekuatan terbukti mengurangi gejala depresi dan kecemasan, meningkatkan harga diri, dan memperbaiki kualitas tidur.</p>\r\n<h2>Teknik Dasar yang Benar</h2>\r\n<p>Untuk mendapatkan manfaat maksimal dan mengurangi risiko cedera, penting untuk mempelajari dan menerapkan teknik yang benar dalam angkat beban:</p>\r\n<h3>1. Pemanasan</h3>\r\n<p>Mulailah dengan pemanasan dinamis untuk meningkatkan aliran darah ke otot dan persiapan mental.</p>\r\n<h3>2. Posisi Awal yang Benar</h3>\r\n<p>Setiap latihan memiliki posisi awal yang spesifik. Pastikan postur Anda benar sebelum memulai gerakan untuk mencegah cedera.</p>\r\n<h3>3. Gerakan Terkontrol</h3>\r\n<p>Lakukan setiap gerakan dengan terkontrol, fokus pada kontraksi otot dan pergerakan stabil. Hindari menggunakan momentum untuk mengangkat beban.</p>\r\n<h3>4. Pernapasan yang Tepat</h3>\r\n<p>Bernapaslah secara alami selama latihan. Umumnya, menghembuskan napas saat melakukan usaha (mengangkat beban) dan menghirup saat kembali ke posisi awal.</p>\r\n<h3>5. Progresi Bertahap</h3>\r\n<p>Mulai dengan beban ringan untuk mempelajari teknik yang benar, kemudian secara bertahap tambahkan beban atau intensitas latihan untuk meningkatkan kekuatan.</p>\r\n<h2>Kesalahan yang Harus Dihindari</h2>\r\n<h3>1. Mengabaikan Pemanasan</h3>\r\n<p>Pemanasan meningkatkan kinerja dan mengurangi risiko cedera. Jangan lewatkan tahap ini.</p>\r\n<h3>2. Melakukan Terlalu Banyak, Terlalu Cepat</h3>\r\n<p>Menambah beban atau volume terlalu cepat dapat menyebabkan cedera atau kelelahan berlebihan.</p>\r\n<h3>3. Mengabaikan Teknik</h3>\r\n<p>Mengorbankan teknik demi mengangkat beban lebih berat bukanlah praktik yang baik dan dapat menyebabkan cedera jangka panjang.</p>\r\n<h3>4. Mengabaikan Pemulihan</h3>\r\n<p>Istirahat dan pemulihan adalah bagian penting dari latihan kekuatan. Otot membutuhkan waktu untuk memperbaiki dan memperkuat diri.</p>\r\n<h3>5. Mengabaikan Bagian Tubuh</h3>\r\n<p>Fokus pada semua kelompok otot utama untuk keseimbangan dan kekuatan secara keseluruhan.</p>\r\n<p>Angkat beban bukan hanya tentang membangun otot, tetapi juga tentang peningkatan kualitas hidup secara keseluruhan. Dengan menerapkan teknik yang benar dan menghindari kesalahan umum, Anda dapat memanfaatkan sepenuhnya manfaat latihan ini. Ingat, konsistensi dan pendekatan yang seimbang adalah kunci menuju kebugaran dan kesehatan jangka panjang.</p>', '17', 1, '2024-03-08 10:24:23');

-- Dumping structure for table blogprojectdb.post_topics
CREATE TABLE IF NOT EXISTS `post_topics` (
  `post_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`topic_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `post_topics_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_topics_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blogprojectdb.post_topics: ~5 rows (approximately)
INSERT INTO `post_topics` (`post_id`, `topic_id`) VALUES
	(9, 1),
	(20, 2),
	(12, 9),
	(21, 9),
	(22, 9);

-- Dumping structure for table blogprojectdb.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blogprojectdb.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `code`, `name`) VALUES
	(1, 'ADM', 'Admin'),
	(2, 'USR', 'User');

-- Dumping structure for table blogprojectdb.topics
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blogprojectdb.topics: ~10 rows (approximately)
INSERT INTO `topics` (`id`, `name`, `description`, `created_at`) VALUES
	(1, 'Tech', 'All things technology, from the latest gadgets to software developments.', '2024-03-05 03:33:19'),
	(2, 'Lifestyle', 'Covers a range of interests including home, garden, and personal well-being.', '2024-03-05 03:33:19'),
	(3, 'Health', 'Focuses on physical and mental health, wellness tips, and medical news.', '2024-03-05 03:33:19'),
	(4, 'Education', 'Discusses educational trends, resources, and lifelong learning opportunities.', '2024-03-05 03:33:19'),
	(5, 'Finance', 'Covers financial advice, investment tips, and market analysis.', '2024-03-05 03:33:19'),
	(6, 'Travel', 'Shares travel guides, tips, and experiences from around the world.', '2024-03-05 03:33:19'),
	(7, 'Food', 'Explores culinary arts, recipes, and restaurant reviews.', '2024-03-05 03:33:19'),
	(8, 'Entertainment', 'Covers movies, music, TV shows, and celebrity news.', '2024-03-05 03:33:19'),
	(9, 'Sports', 'Provides insights on various sports, events, and athlete profiles.', '2024-03-05 03:33:19'),
	(10, 'Science', 'Discusses latest scientific discoveries, research, and technology advancements.', '2024-03-05 03:33:19');

-- Dumping structure for table blogprojectdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blogprojectdb.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `created_at`, `role_id`) VALUES
	(4, 'Novry', 'M', 'novry', 'novru.mah@gmail.com', '$2y$10$Bbd8JvyQP4EyKb0OM6.po.o4LXf2ME9P1AaaBccxGt9zr3mBT0wSm', '2024-02-05 17:00:00', 2),
	(6, 'Hiba', 'R', 'hiba', '299_hiba@neuronworks.co.id', '$2y$10$bi62Xx/4sOlANGl4xxutl.RJy/qjBDsiOVZRAz9hoXZJK3r1GvH/q', '2024-02-06 17:00:00', 2),
	(9, 'Rasyad', 'R', 'rasyad', 'rasyad@email.com', '$2y$10$LQu6HhYbaAuzhftxj3PIkOETD6rhf1BhPzg0V3hJSxYotfXOSjmFW', '2024-02-06 17:00:00', 2),
	(12, 'Rijal', 'P', 'rijal', 'rijal@neuronworks.co.id', '$2y$10$Xc.Md/wng1YzBeb2vELu8eI81uGAsEZehRu2dXH2zdMzrZOAD8CjC', '2024-02-06 17:00:00', 2),
	(15, 'Novry', 'Mahdevika', 'novrymahdevika', 'novry.mahdevika@neuronworks.co.id', '$2y$10$1ItcxqOfyqhXVw5J9qFpmOPIan0H2lCB6HIhqM8ZGb67HQjouJPHC', '2024-02-25 17:00:00', 1),
	(16, 'Ridwan', 'Fauzi', 'ridwanfauzi', 'ridwanfauzi@gmail.com', '$2y$10$Jim0D6H6nrwBZDdzZvJi0u/Eg753s8pr49K4JDhXpDQ9pLEX167em', '2024-02-29 17:00:00', 2),
	(17, 'moh', 'ikbal', 'mohikbal', 'mohikbal@gmail.com', '$2y$10$LX4aOc4aaCKdy7sqhqdpyeefl1.5o9qF68ZKBGYj96.dbWpZHCEyO', '2024-02-29 17:00:00', 2);

-- Dumping structure for table blogprojectdb.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table blogprojectdb.user_role: ~12 rows (approximately)
INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `status`) VALUES
	(1, 4, 1, 1),
	(2, 4, 2, 0),
	(9, 9, 2, 0),
	(10, 9, 1, 0),
	(15, 12, 1, 1),
	(16, 12, 1, 1),
	(17, 15, 2, 1),
	(18, 15, 1, 1),
	(19, 16, 2, 1),
	(20, 16, 1, 1),
	(21, 17, 2, 1),
	(22, 17, 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
