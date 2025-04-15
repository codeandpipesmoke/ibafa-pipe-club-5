-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 15. 20:36
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `ibafa-5`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `title_1` varchar(250) DEFAULT NULL,
  `text_1` tinytext DEFAULT NULL,
  `title_2` varchar(250) DEFAULT NULL,
  `text_2` tinytext DEFAULT NULL,
  `title_3` varchar(250) DEFAULT NULL,
  `text_3` tinytext DEFAULT NULL,
  `title_4` varchar(250) DEFAULT NULL,
  `text_4` tinytext NOT NULL,
  `google_map_url` varchar(1000) NOT NULL,
  `visible` tinyint(1) UNSIGNED DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1000,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Abouts table';

--
-- A tábla adatainak kiíratása `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `title_1`, `text_1`, `title_2`, `text_2`, `title_3`, `text_3`, `title_4`, `text_4`, `google_map_url`, `visible`, `pos`, `created`, `modified`) VALUES
(1, 'Rólunk', 'Az Ibafai Pipaklub egy olyan közösség, ahol a pipázás művészete és hagyománya él tovább. Mi nem csupán pipások vagyunk, hanem egy szenvedélyes család, amely megosztja egymással a pipázás iránti szeretetét és tapasztalatait. A klub célja, hogy a pipázás élményét még gazdagabbá, még élvezetesebbé tegye minden tag számára.', 'A Klub Története', 'A [Klub Neve] hosszú évek óta működik, és célunk mindig is az volt, hogy egy olyan helyet biztosítsunk, ahol a pipázás iránt érdeklődők találkozhatnak, tanulhatnak és inspirálódhatnak. Az alapítóink a pipázás mélyebb megértésére ', 'Közösségi Élmények', 'A klub nemcsak a pipázásról szól, hanem a közösségi élményekről is. Rendszeresen szervezünk találkozókat, kóstolókat és egyéb eseményeket, ahol tagjaink új barátságokat köthetnek és osztozhatnak a pipázás örömeiben. A közössé', 'Pipázás Mint Művészet', 'A pipázás nemcsak egy szokás, hanem egy valódi művészet, amit klubunk minden tagja tisztelettel és odafigyeléssel gyakorol. Minden alkalommal, amikor a klub tagjai együtt pipáznak, lehetőségük nyílik új technikákat tanulni, különböző d', 'Csatlakozz Hozzánk!', 'Ha te is szeretnéd megélni a pipázás varázsát, és csatlakozni egy olyan közösséghez, amely osztozik ezen a szenvedélyen, akkor itt a helyed! Mi mindig várunk új tagokat, akik készek felfedezni a pipázás szépségeit és osztozni velünk a ', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d548.4063053393076!2d17.917357710236956!3d46.1548392877467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476803728bd22deb%3A0x5c7f5cb7f6891050!2sIbafa%20Pipam%C3%BAzeum!5e0!3m2!1shu!2shu!4v1744739823166!5m2!1shu!2shu', 1, 1000, '2025-02-28 12:03:59', '2025-02-28 12:03:59');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cake_d_c_users_phinxlog`
--

CREATE TABLE `cake_d_c_users_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `cake_d_c_users_phinxlog`
--

INSERT INTO `cake_d_c_users_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20150513201111, 'Initial', '2025-02-28 12:54:07', '2025-02-28 12:54:07', 0),
(20161031101316, 'AddSecretToUsers', '2025-02-28 12:54:07', '2025-02-28 12:54:07', 0),
(20190208174112, 'AddAdditionalDataToUsers', '2025-02-28 12:54:07', '2025-02-28 12:54:07', 0),
(20210929202041, 'AddLastLoginToUsers', '2025-02-28 12:54:07', '2025-02-28 12:54:07', 0),
(20240328135459, 'CreateFailedPasswordAttempts', '2025-02-28 12:54:07', '2025-02-28 12:54:07', 0),
(20240328215332, 'AddLockoutTimeToUsers', '2025-02-28 12:54:07', '2025-02-28 12:54:07', 0),
(20240801112143, 'ChangeAvatarColumnTypeInSocialAccounts', '2025-02-28 12:54:07', '2025-02-28 12:54:08', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_password_attempts`
--

CREATE TABLE `failed_password_attempts` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1000,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Galleries table';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `members`
--

CREATE TABLE `members` (
  `id` varchar(36) NOT NULL,
  `name` varchar(250) NOT NULL,
  `about_title` varchar(1000) NOT NULL,
  `about` text NOT NULL,
  `link_facebook` varchar(1000) DEFAULT NULL,
  `link_twitter` varchar(1000) DEFAULT NULL,
  `link_instagram` varchar(1000) DEFAULT NULL,
  `link_linkedin` varchar(1000) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1000,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Members table';

--
-- A tábla adatainak kiíratása `members`
--

INSERT INTO `members` (`id`, `name`, `about_title`, `about`, `link_facebook`, `link_twitter`, `link_instagram`, `link_linkedin`, `visible`, `pos`, `created`, `modified`) VALUES
('59fbe61d-f60c-4bff-af63-c2ca28cc5165', 'Nagy Zsolt lajos', 'asdasd', '<p>asdf sfsd</p>', 'https://www.facebook.com/profile.php?id=100085254960652', '', '', '', 1, 1000, '2025-03-03 10:24:17', '2025-03-03 10:58:27');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `readed` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Contact table for visitor messages';

--
-- A tábla adatainak kiíratása `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `body`, `readed`, `created`, `modified`) VALUES
(31, 'Varga Zsolt', 'zsfoto@gmail.com', 'Próba 123', 'safasfas', 0, '2025-04-15 18:30:10', '2025-04-15 18:30:10'),
(32, 'Varga Zsolt', 'zsfoto@gmail.com', 'Próba 123', 'safasfas', 0, '2025-04-15 18:31:31', '2025-04-15 18:31:31'),
(33, 'Varga Zsolt', 'zsfoto@gmail.com', 'Próba 123', 'safasfas', 0, '2025-04-15 18:33:37', '2025-04-15 18:33:37'),
(34, 'Varga Zsolt', 'zsfoto@gmail.com', 'Próba 123', 'safasfas', 0, '2025-04-15 18:33:50', '2025-04-15 18:33:50');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Photos table';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `body` text NOT NULL,
  `more` text DEFAULT NULL,
  `show_in_main_page` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `visible` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1000,
  `filename` varchar(250) NOT NULL,
  `thumbnail` varchar(250) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Posts table';

--
-- A tábla adatainak kiíratása `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `name`, `slug`, `body`, `more`, `show_in_main_page`, `visible`, `pos`, `filename`, `thumbnail`, `ext`, `created`, `modified`) VALUES
(12, '57eae983-e4a6-44ee-a382-b44f9fb70a07', 'Teszt Példa', 'teszt-pelda', '<p>asdfasdfs</p>', '', 0, 1, 1000, '12_teszt.jpg', '12_teszt_thumbnail.jpg', 'jpg', '2025-03-03 08:23:51', '2025-03-03 10:58:03'),
(13, '57eae983-e4a6-44ee-a382-b44f9fb70a07', 'A nagy pipás', 'a-nagy-pipas', '<p>Elsőre kicsit nagy talán</p>', '', 1, 1, 1000, '13_a_nagy_pipas.jpg', '13_a_nagy_pipas_thumbnail.jpg', 'jpg', '2025-03-03 10:49:56', '2025-03-03 10:49:56');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `setups`
--

CREATE TABLE `setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(36) NOT NULL DEFAULT 'init',
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'string',
  `editable` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Setups table';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `avatar` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `token` varchar(500) NOT NULL,
  `token_secret` varchar(500) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `data` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `texts`
--

CREATE TABLE `texts` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(5) NOT NULL DEFAULT 'hu',
  `name` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` longtext NOT NULL,
  `visible` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1000,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Texts table';

--
-- A tábla adatainak kiíratása `texts`
--

INSERT INTO `texts` (`id`, `lang`, `name`, `slug`, `title`, `body`, `visible`, `pos`, `created`, `modified`) VALUES
(1, 'hu', 'Adatvédelmi és adatkezelési szabályzat - MODAL', 'adatvedelmi-es-adatkezelesi-szabalyzat', 'Adatvédelmi és adatkezelési szabályzat', '<p>Ide jön az adatvédelmi és adatkezelési tájékoztató szövege</p><p><br></p>', 1, 1000, '2024-11-20 10:41:45', '2025-03-03 12:56:09'),
(5, 'hu', 'Cookie (süti) tájékoztató', 'sutik', 'Cookie (süti) tájékoztató', '<p><b>Ide jön a cookie tájékoztató...</b></p><p>ascvssfcs</p><p><br></p>', 1, 1000, '2025-03-03 12:52:52', '2025-03-03 12:57:17'),
(6, 'hu', 'Impresszum', 'impresszum', 'Impresszum', '<p>Ide jön a technikai rólunk rész.</p><p>Szolgáltató megnevezése, stb...</p>', 1, 1000, '2025-03-03 12:56:45', '2025-03-03 12:56:45');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `secret` varchar(32) DEFAULT NULL,
  `secret_verified` tinyint(1) DEFAULT NULL,
  `tos_date` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_superuser` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) DEFAULT 'user',
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `visible` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1000,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `additional_data` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `lockout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visible` (`visible`),
  ADD KEY `pos` (`pos`);

--
-- A tábla indexei `cake_d_c_users_phinxlog`
--
ALTER TABLE `cake_d_c_users_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- A tábla indexei `failed_password_attempts`
--
ALTER TABLE `failed_password_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visible` (`visible`),
  ADD KEY `name` (`name`),
  ADD KEY `pos` (`pos`);

--
-- A tábla indexei `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `visible` (`visible`),
  ADD KEY `pos` (`pos`);

--
-- A tábla indexei `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `readed` (`readed`);

--
-- A tábla indexei `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_id` (`gallery_id`),
  ADD KEY `name` (`name`),
  ADD KEY `visible` (`visible`),
  ADD KEY `pos` (`pos`);

--
-- A tábla indexei `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`) USING BTREE,
  ADD KEY `name` (`name`),
  ADD KEY `visible` (`visible`),
  ADD KEY `pos` (`pos`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `filename` (`filename`),
  ADD KEY `thumbnail` (`thumbnail`);

--
-- A tábla indexei `setups`
--
ALTER TABLE `setups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `lang` (`lang`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visible` (`visible`),
  ADD KEY `pos` (`pos`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT a táblához `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `setups`
--
ALTER TABLE `setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `failed_password_attempts`
--
ALTER TABLE `failed_password_attempts`
  ADD CONSTRAINT `failed_password_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
