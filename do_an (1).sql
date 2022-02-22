-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 13, 2021 lúc 06:08 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `do_an`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maytinh`
--

CREATE TABLE `maytinh` (
  `MaMT` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BanPhim` int(11) DEFAULT NULL,
  `Chuot` int(11) DEFAULT NULL,
  `ManHinh` int(11) DEFAULT NULL,
  `ThungMay` int(11) DEFAULT NULL,
  `UngDung` int(11) DEFAULT NULL,
  `NamLD` date DEFAULT NULL,
  `TinhTrang` int(11) NOT NULL,
  `Comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SLH` int(11) NOT NULL,
  `MaPMT` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `maytinh`
--

INSERT INTO `maytinh` (`MaMT`, `BanPhim`, `Chuot`, `ManHinh`, `ThungMay`, `UngDung`, `NamLD`, `TinhTrang`, `Comment`, `SLH`, `MaPMT`) VALUES
('MT101', 0, 0, 1, 0, 0, '0000-00-00', 1, 'K hiển thị màn hình', 1, 'PMT01'),
('MT102', 0, 0, 0, 0, 0, '0000-00-00', 0, 'không', 0, 'PMT01'),
('MT201', 0, 0, 0, 0, 0, '0000-00-00', 0, 'không', 0, 'PMT02'),
('MT202', 0, 1, 0, 0, 0, '0000-00-00', 1, 'Chuột Hỏng', 6, 'PMT02'),
('MT301', 0, 0, 0, 0, 0, '0000-00-00', 0, 'không', 0, 'PMT03'),
('MT302', 0, 0, 0, 0, 0, '0000-00-00', 0, 'không', 0, 'PMT03'),
('MT401', 0, 0, 0, 0, 0, '0000-00-00', 0, 'không', 0, 'PMT04'),
('MT402', 1, 0, 0, 0, 0, '0000-00-00', 1, 'Bàn Phím Hỏng', 1, 'PMT04'),
('MT405', 0, 0, 0, 0, 0, NULL, 0, 'Không', 0, 'PMT04'),
('MT406', 0, 0, 0, 0, 0, NULL, 0, 'Không', 0, 'PMT04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `MaMH` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenMH` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SoLuongSV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`MaMH`, `TenMH`, `SoLuongSV`) VALUES
('220DA1', 'Đồ Án I', 40),
('220NN1', 'Ngoại ngữ I', 40),
('220NN2', 'Ngoại ngữ II', 40),
('220TTCM', 'Thực Tập Chuyên Môn', 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaND` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MatKhau` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenND` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GioiTinh` bit(1) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `Quyen` char(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaND`, `MatKhau`, `TenND`, `GioiTinh`, `NgaySinh`, `Quyen`) VALUES
('1811505310310', '123456789', 'Nguyễn Văn Doanh', b'1', '0000-00-00', 'SV'),
('1811505310351', '123456789', 'Hoàng Thị Cẩm Vân', b'0', '0000-00-00', 'SV'),
('GV50531011', '123456789', 'Nguyễn Thị Hà Quyên', b'0', '0000-00-00', 'GV'),
('GV50531012', '123456789', 'Nguyễn Thị Thúy Hoài', b'0', '0000-00-00', 'GV'),
('GV50531013', '123456789', 'Nguyễn Văn Phát', b'1', '0000-00-00', 'GV'),
('GV50531014', '123456789', 'Hoàng Thị Mỹ Lệ', b'0', '0000-00-00', 'GV');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongmay`
--

CREATE TABLE `phongmay` (
  `MaPMT` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenPMT` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SLMay` int(11) NOT NULL,
  `TinhTrang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phongmay`
--

INSERT INTO `phongmay` (`MaPMT`, `TenPMT`, `SLMay`, `TinhTrang`) VALUES
('PMT01', 'Phòng máy tính số 1', 35, 1),
('PMT02', 'Phòng máy tính số 2', 20, 1),
('PMT03', 'Phòng máy tính số 3', 30, 1),
('PMT04', 'Phòng máy tính số 4', 35, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `MaTKB` int(11) NOT NULL,
  `TenGV` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Thu` int(11) NOT NULL,
  `TuTiet` int(11) NOT NULL,
  `DenTiet` int(11) NOT NULL,
  `NgayBD` date DEFAULT NULL,
  `SoLuongSV` int(11) NOT NULL,
  `MaPMT` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaMH` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TT` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thoikhoabieu`
--

INSERT INTO `thoikhoabieu` (`MaTKB`, `TenGV`, `Thu`, `TuTiet`, `DenTiet`, `NgayBD`, `SoLuongSV`, `MaPMT`, `MaMH`, `TT`) VALUES
(1, 'Nguyễn Thị Thúy Hoài', 3, 1, 2, NULL, 40, 'PMT01', '220DA1', 'đã duyệt'),
(2, 'Nguyễn Thị Thúy Hoài', 4, 1, 2, NULL, 40, 'PMT02', '220TTCM', 'đã duyệt'),
(3, 'Nguyễn Thị Thúy Hoài', 5, 1, 2, NULL, 40, 'PMT03', '220NN1', 'đã duyệt'),
(4, 'Nguyễn Thị Thúy Hoài', 6, 1, 2, NULL, 40, 'PMT04', '220NN2', 'đợi duyệt'),
(8, 'Nguyễn Văn Phát', 2, 1, 2, NULL, 20, 'PMT02', '220DA1', 'đã duyệt'),
(14, 'NVD', 7, 1, 2, NULL, 20, 'PMT03', '220TTCM', 'đợi duyệt'),
(15, 'Hoàng Thị Mỹ Lệ', 2, 1, 2, NULL, 30, 'PMT03', '220NN2', 'đã duyệt');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `maytinh`
--
ALTER TABLE `maytinh`
  ADD PRIMARY KEY (`MaMT`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaMH`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaND`);

--
-- Chỉ mục cho bảng `phongmay`
--
ALTER TABLE `phongmay`
  ADD PRIMARY KEY (`MaPMT`);

--
-- Chỉ mục cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`MaTKB`),
  ADD KEY `MaMH` (`MaMH`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  MODIFY `MaTKB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `thoikhoabieu_ibfk_1` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
