-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 07:21 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `user_id`, `timestamp`, `path`) VALUES
(37, 16, '1481048831', './user_img/16/584702ffc7938.png'),
(38, 16, '1481048961', './user_img/16/58470381dcd0c.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `activation` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reset_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `passwd`, `activation`, `status`, `reset_key`) VALUES
(13, 'a', 'zqpobjpv@anappfor.com', '8aca2602792aec6f11a67206531fb7d7f0dff59413145e6973c45001d0087b42d11bc645413aeff63a42391a39145a591a92200d560195e53b478584fdae231a', '', 'active', ''),
(14, 'q', 'zqpobjpv@anappfor.com', '05ee70f67fed50f8c5ac896c552b8b6b596a9353e67ae60a74bc112f3c7a5ee6131fd4a164479b263cc8916714d94d8b5026e7856eb5752031ff2c549343e505', '2e215455660b49ff0c8ad3d85a663c39', 'pending', ''),
(15, 'w', 'zqpobjpv@anappfor.com', '3a95f5644f3780c4614b01ca517aebcfaf5114164e21814ae42ed031a134b94fc75392121e90a48c3cb8e55a8315e590319d0c43948914a99daf97a945e3df75', '6191250637f34dce148853a8a7154ec4', 'pending', ''),
(16, 'e', 'zqpobjpv@anappfor.com', 'ecb88a0ed2b29417d192fd778d783c0e50ad028fb95188b0cb59ae6b9a8322292aa65e3ae9637c39a59cda503253159083fa79ac55a0b7dd62424e39787d977d', '', 'active', ''),
(17, 'o', 'zqpobjpv@anappfor.com', '07e17b52d3e62985c512482c683d10ddb544910aabcd4472e953db4f1a7e48662ddb4751c7e0bb98fe5e0b7f75439e28d474d57c1359060d2322e08f9f8d3c12', '9275ea39da48aeb8c8b52f14a41e6276', 'pending', ''),
(18, 'h', 'zqpobjpv@anappfor.com', '24fc871e81329c1019c11186642e5937298d10be03010244cf770a7ae306b539f3991b36a5f42f8cf7325f22411bc7a3b14351b42f26335f44786bdbf29c317f', '507a87dabc174e0ccbfe40d2a6cd1484', 'pending', ''),
(19, 'bn', 'zqpobjpv@anappfor.com', 'c86c85e850d5098e3e8526ba47f118923417cc3fe5e575fd24a127eb9c050913f54343dc140cde96362c9e2c233aa2b3897df7d0bc2c007ecf5744ca50be0036', '139f7371c1ad3375af317270f0c172d1', 'pending', ''),
(20, 'kl', 'zqpobjpv@anappfor.com', 'a67f7841eff425ed203c91ec2061a139ea01644039d175b25a44ce09fd908f7aeef7743d108a4af70524fcdc02db1b3800ecc1db158d75ff8974c2c5039e4a73', '47f9f283f87bc71ff84432546f764bbc', 'pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
