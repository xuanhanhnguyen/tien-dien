-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 20, 2021 lúc 05:53 PM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `2021_03_tien-dien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dksd_dien`
--

CREATE TABLE `dksd_dien` (
  `ma_dksd_dien` int(10) NOT NULL,
  `ma_khach_hang` int(10) NOT NULL,
  `ma_khu_vuc` int(10) NOT NULL,
  `ma_muc_cap_dien` int(10) NOT NULL,
  `hs_nhan` int(10) NOT NULL DEFAULT 1,
  `dien_ap` int(10) DEFAULT 0,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dksd_dien`
--

INSERT INTO `dksd_dien` (`ma_dksd_dien`, `ma_khach_hang`, `ma_khu_vuc`, `ma_muc_cap_dien`, `hs_nhan`, `dien_ap`, `dia_chi`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 1, NULL, 'Văn Sơn - Đô Lương - Nghệ An', 1, NULL, '2021-05-17 09:39:13'),
(2, 5, 1, 7, 1, NULL, 'Văn Sơn - Đô Lương - Nghệ An', 1, '2021-05-09 05:00:39', '2021-05-18 13:30:58'),
(3, 4, 1, 4, 1, 0, 'Văn Sơn - Đô Lương - Nghệ An', 1, '2021-05-18 06:58:01', '2021-05-18 06:58:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gia_dien`
--

CREATE TABLE `gia_dien` (
  `ma_gia_dien` int(10) UNSIGNED NOT NULL,
  `ten_gia_dien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_muc_cap_dien` int(11) NOT NULL,
  `tu_so` int(11) DEFAULT 0,
  `den_so` int(11) DEFAULT 0,
  `cao_diem` int(11) DEFAULT NULL,
  `binh_thuong` int(11) DEFAULT NULL,
  `thap_diem` int(11) DEFAULT NULL,
  `gia_dien` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gia_dien`
--

INSERT INTO `gia_dien` (`ma_gia_dien`, `ten_gia_dien`, `ma_muc_cap_dien`, `tu_so`, `den_so`, `cao_diem`, `binh_thuong`, `thap_diem`, `gia_dien`, `created_at`, `updated_at`) VALUES
(1, 'Bậc 1: Cho kWh từ 0 - 50', 1, 0, 50, NULL, NULL, NULL, 1678, '2021-05-08 18:49:27', '2021-05-08 18:49:27'),
(2, 'Bậc 2: Cho kWh từ 51 - 100', 1, 51, 100, NULL, NULL, NULL, 1734, '2021-05-08 18:51:10', '2021-05-08 18:51:10'),
(3, 'Bậc 3: Cho kWh từ 101 - 200', 1, 101, 200, NULL, NULL, NULL, 2014, '2021-05-08 18:51:33', '2021-05-08 18:51:33'),
(4, '	\r\nBậc 4: Cho kWh từ 201 - 300', 1, 201, 300, NULL, NULL, NULL, 2536, '2021-05-08 18:53:09', '2021-05-08 18:53:09'),
(5, 'Bậc 5: Cho kWh từ 301 - 400', 1, 301, 400, NULL, NULL, NULL, 2834, '2021-05-08 18:53:36', '2021-05-08 18:53:36'),
(6, 'Bậc 6: Cho kWh từ 401 trở lên', 1, 401, 0, NULL, NULL, NULL, 2927, NULL, NULL),
(7, 'Giá bán lẻ điện sinh hoạt dùng công tơ thẻ trả trước', 2, 0, 0, NULL, NULL, NULL, 2461, '2021-05-16 12:45:21', '2021-05-18 11:26:54'),
(8, 'Cấp điện áp từ 22 kV trở lên', 3, 22, 0, 4251, 2442, 1361, NULL, '2021-05-17 09:10:43', '2021-05-17 09:10:43'),
(9, 'Cấp điện áp từ 6 kV đến dưới 22 kV', 4, 6, 22, 4400, 2629, 1547, NULL, '2021-05-17 09:12:35', '2021-05-17 09:12:35'),
(10, 'Cấp điện áp dưới 6 kV', 5, 0, 6, 4587, 2666, 1622, NULL, '2021-05-17 09:14:33', '2021-05-17 09:14:33'),
(11, 'Cấp điện áp từ 6 kV trở lên', 6, 6, 0, NULL, NULL, NULL, 1659, '2021-05-17 09:15:03', '2021-05-17 09:15:03'),
(12, 'Cấp điện áp dưới 6 kV', 6, 0, 5, NULL, NULL, NULL, 1771, '2021-05-17 09:15:27', '2021-05-19 07:31:11'),
(13, 'Cấp điện áp từ 6 kV trở lên', 7, 6, 0, NULL, NULL, NULL, 1827, '2021-05-17 09:15:58', '2021-05-17 09:15:58'),
(14, 'Cấp điện áp dưới 6 kV', 7, 0, 5, NULL, NULL, NULL, 1902, '2021-05-17 09:16:10', '2021-05-19 07:31:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hoa_don` int(10) UNSIGNED NOT NULL,
  `ma_dksd_dien` int(10) NOT NULL,
  `chi_so_cu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `chi_so_moi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `thue_gtgt` tinyint(4) NOT NULL DEFAULT 10,
  `tong_tien` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `thang` int(11) NOT NULL,
  `nam` int(11) NOT NULL,
  `tu_ngay` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `den_ngay` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  `auto` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`ma_hoa_don`, `ma_dksd_dien`, `chi_so_cu`, `chi_so_moi`, `thue_gtgt`, `tong_tien`, `thang`, `nam`, `tu_ngay`, `den_ngay`, `trang_thai`, `auto`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '1000', 10, '50000', 1, 2021, '2021-04-22', '2021-05-21', 4, 0, '2021-05-09 17:06:13', '2021-05-19 07:43:39'),
(2, 2, '0', '10000', 10, '0', 1, 2021, '04/22/2021', '05/21/2021', 4, 0, '2021-05-09 10:20:55', '2021-05-19 07:43:48'),
(3, 3, '{\"binh_thuong\":\"10\",\"thap_diem\":\"10\",\"cao_diem\":\"10\"}', '{\"binh_thuong\":\"10\",\"thap_diem\":\"10\",\"cao_diem\":\"10\"}', 10, '0', 1, 2021, '04/22/2021', '05/20/2021', 4, 0, '2021-05-18 07:33:01', '2021-05-19 07:43:58'),
(4, 3, '{\"binh_thuong\":\"10\",\"thap_diem\":\"10\",\"cao_diem\":\"10\"}', '{\"binh_thuong\":\"10\",\"thap_diem\":\"10\",\"cao_diem\":\"10\"}', 10, '0', 1, 2021, '04/20/2021', '05/21/2021', 4, 0, '2021-05-18 07:34:22', '2021-05-19 07:44:09'),
(14, 1, '0', '0', 10, '0', 5, 2021, '16/4/2021', '15/05/2021', 1, 1, '2021-05-19 10:13:44', '2021-05-19 10:51:21'),
(17, 2, '10000', '0', 10, '0', 5, 2021, '16/4/2021', '15/05/2021', 1, 1, '2021-05-19 10:51:21', '2021-05-19 10:51:21'),
(18, 3, '{\"binh_thuong\":\"10\",\"thap_diem\":\"10\",\"cao_diem\":\"10\"}', '{\"binh_thuong\":\"0\",\"thap_diem\":\"0\",\"cao_diem\":\"0\"}', 10, '0', 5, 2021, '16/4/2021', '15/05/2021', 1, 1, '2021-05-19 10:51:21', '2021-05-19 10:51:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khu_vuc`
--

CREATE TABLE `khu_vuc` (
  `ma_khu_vuc` int(10) UNSIGNED NOT NULL,
  `ten_khu_vuc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `don_vi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khu_vuc`
--

INSERT INTO `khu_vuc` (`ma_khu_vuc`, `ten_khu_vuc`, `don_vi`, `created_at`, `updated_at`) VALUES
(1, 'Khu vực 1', 'abc', '2021-05-09 03:33:46', '2021-05-09 03:33:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_dien`
--

CREATE TABLE `loai_dien` (
  `ma_loai_dien` int(10) UNSIGNED NOT NULL,
  `ten_loai_dien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_dien`
--

INSERT INTO `loai_dien` (`ma_loai_dien`, `ten_loai_dien`, `created_at`, `updated_at`) VALUES
(1, 'Sinh hoạt', '2021-05-08 18:28:43', '2021-05-08 18:28:43'),
(2, 'Kinh doanh', '2021-05-08 18:28:53', '2021-05-08 18:28:53'),
(3, 'Khối hành chính, sự nghiệp', '2021-05-08 18:38:08', '2021-05-08 18:38:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_05_13_060834_create_settings_table', 1),
(4, '2016_05_18_045906_create_todos_table', 1),
(5, '2016_10_10_114222_add_providers_to_users_table', 1),
(6, '2017_07_25_073654_create_jobs_table', 1),
(7, '2017_07_25_073709_create_failed_jobs_table', 1),
(8, '2020_12_27_032350_create_loai_dien_table', 1),
(9, '2020_12_27_050402_create_gia_dien_table', 1),
(10, '2020_12_27_073701_add_ma_loai_dien_to_user_table', 1),
(11, '2020_12_27_075112_create_phuong_table', 1),
(12, '2020_12_27_075833_create_khu_vuc_table', 1),
(13, '2020_12_27_081826_add_ma_khu_vuc_to_user_table', 1),
(14, '2020_12_27_082557_create_dien_ke_table', 1),
(15, '2020_12_27_085720_create_hoa_don_table', 1),
(16, '2020_12_27_085729_create_chi_tiet_hoa_don_table', 1),
(17, '2021_01_04_022758_add_don_gia_to_chi_tiet_hoa_don_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muc_cap_dien`
--

CREATE TABLE `muc_cap_dien` (
  `ma_muc_cap_dien` int(11) NOT NULL,
  `ten_muc_cap_dien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_loai_dien` int(11) NOT NULL,
  `loai_gia` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `muc_cap_dien`
--

INSERT INTO `muc_cap_dien` (`ma_muc_cap_dien`, `ten_muc_cap_dien`, `ma_loai_dien`, `loai_gia`, `created_at`, `updated_at`) VALUES
(1, 'Giá bán lẻ điện sinh hoạt', 1, 1, '2021-05-15 21:00:37', '2021-05-15 21:09:09'),
(2, 'Giá bán lẻ điện sinh hoạt dùng công tơ thẻ trả trước', 1, 0, '2021-05-16 12:31:06', '2021-05-16 12:34:20'),
(3, 'Cấp điện áp từ 22 kV trở lên', 2, 2, '2021-05-17 08:55:15', '2021-05-17 08:55:15'),
(4, 'Cấp điện áp từ 6 kV đến dưới 22 kV', 2, 2, '2021-05-17 08:55:29', '2021-05-17 08:55:29'),
(5, 'Cấp điện áp dưới 6 kV', 2, 2, '2021-05-17 08:55:43', '2021-05-17 08:55:43'),
(6, 'Bệnh viện, nhà trẻ, mẫu giáo, trường phổ thông', 3, 3, '2021-05-17 08:56:12', '2021-05-17 08:56:12'),
(7, 'Chiếu sáng công cộng; đơn vị hành chính sự nghiệp', 3, 3, '2021-05-17 08:58:45', '2021-05-17 08:58:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `todos`
--

CREATE TABLE `todos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `gender`, `birthday`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'admin', '$2y$10$qlaexa2QStpeFgH0rC77gO3x/2idlSuJnKLFCuLE1HXpOQlJtfceK', 'xuanhanh.setdy@gmail.com', '+84247233400', 0, '1970-01-01', 'Admin', 'Admin', NULL, '2021-03-21 10:34:55', '2021-05-15 19:49:28'),
(4, 'kh', 'kh', 'kh', '$2y$10$qlaexa2QStpeFgH0rC77gO3x/2idlSuJnKLFCuLE1HXpOQlJtfceK', 'admin@address.com', '12312323', 0, '2021-05-10', 'Khách hàng', 'Khách hàng', NULL, '2021-05-09 02:45:26', '2021-05-09 02:45:26'),
(5, 'kh', 'kh', 'kh001', '$2y$10$qlaexa2QStpeFgH0rC77gO3x/2idlSuJnKLFCuLE1HXpOQlJtfceK', 'kh@address.com', '123123231', 0, '2021-05-10', 'Khách hàng', 'Khách hàng', NULL, '2021-05-09 02:45:26', '2021-05-09 02:45:26'),
(6, 'nv', 'nv', 'nv', '$2y$10$qlaexa2QStpeFgH0rC77gO3x/2idlSuJnKLFCuLE1HXpOQlJtfceK', 'nv@address.com', '123123230', 0, '2021-05-10', 'Nhân viên', 'Nhân viên', NULL, '2021-05-09 02:45:26', '2021-05-09 02:45:26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dksd_dien`
--
ALTER TABLE `dksd_dien`
  ADD PRIMARY KEY (`ma_dksd_dien`) USING BTREE;

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gia_dien`
--
ALTER TABLE `gia_dien`
  ADD PRIMARY KEY (`ma_gia_dien`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hoa_don`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Chỉ mục cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  ADD PRIMARY KEY (`ma_khu_vuc`);

--
-- Chỉ mục cho bảng `loai_dien`
--
ALTER TABLE `loai_dien`
  ADD PRIMARY KEY (`ma_loai_dien`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `muc_cap_dien`
--
ALTER TABLE `muc_cap_dien`
  ADD PRIMARY KEY (`ma_muc_cap_dien`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  ADD UNIQUE KEY `users_phone_unique` (`phone`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dksd_dien`
--
ALTER TABLE `dksd_dien`
  MODIFY `ma_dksd_dien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gia_dien`
--
ALTER TABLE `gia_dien`
  MODIFY `ma_gia_dien` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `ma_hoa_don` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  MODIFY `ma_khu_vuc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `loai_dien`
--
ALTER TABLE `loai_dien`
  MODIFY `ma_loai_dien` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `muc_cap_dien`
--
ALTER TABLE `muc_cap_dien`
  MODIFY `ma_muc_cap_dien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
