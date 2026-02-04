-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Feb 02. 12:48
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
-- Adatbázis: `koktel_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `leiras` text DEFAULT NULL,
  `ar` int(11) NOT NULL,
  `kep_nev` varchar(100) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`id`, `nev`, `leiras`, `ar`, `kep_nev`) VALUES
(1, 'Mojito', 'Menta, lime, rum, szóda', 1800, 'Mojito.jpg'),
(2, 'Pina Colada', 'Ananász, kókusz, rum', 2200, 'Pina-Colada.jpg'),
(3, 'Gin Tonic', 'Gin, tonik, uborka', 1900, 'GinTonic.jpg'),
(4, 'Bloody Brain', '2 cl Őszibarack Likőr 2 cl Bailey''s Irish Cream 2 cl Grenadine szirup', 3200, 'Bloody Brain.jpg'),
(5, 'Bloody Mary', 'Vodka 4,5 Paradicsomlé 9 Citromlé 1,5 Só csipetnBors csipetnWorcestershire pár cseppnTabasco pár csepp', 3800, 'BloodyMary.jpg'),
(6, 'Boxcar', '4 cl Száraz Gin, 1 cl CointreauLimelé, 1 cl Tojásfehérje', 3900, 'Boxcar.jpg'),
(7, 'Lamborghini', '3 cl Sambucann3 cl kávélikőr (pl. Kahlúa) 3 cl Baileysn 3 cl Blue Curaçaon', 3500, 'Lamborghini.jpg'),
(8, 'Rose', ' 4,5 cl Vermuth dry, 1,5 cl Kirsch snaps, 1 cl Cherry Brandy', 3700, 'Rose.jpg'),
(9, 'Grasshopper', '2 cl Créme de Menthe Green, 2 cl Créme De Cacao White, 2 cl Tejszín', 3800, 'Grasshopper.jpg'),
(10, 'Zombie', '4 cl Fehér Rum, 3 cl Barna Rum, 3 cl Stroh rum (80%), 1 cl Angostura, 5 cl öntet Narancslé, 2 cl Citromlé, 5 cl Ananászlé, 1 teáskanál Cukor', 4200, 'Zombie.jpg'),
(11, 'White Russian', '4 cl Vodka, 2 cl Kahlua, 2 cl tejszín, jég', 3800, 'White-Russian.jpg'),
(12, 'Godfather', '4 cl Scotch Whisky, 2 cl Amaretto (mandula likőr), jég', 3800, 'Godfather.jpg'),
(13, 'Brainstorm', '4 cl Ír whiskey, 1/2 evőkanál Francia vermouth, 1/2 evőkanál Benedictine', 3200, 'Brainstorm.jpg'),
(14, 'Brandy Alexander', 'Brandy 2 Créme De Cacao Brown 2 Tejszín 2 ', 4200, 'BrandyAlexander.jpg'),
(15, 'Bronx', ' 3 cl Gin, 1,5 cl Vermuth rosso, 1,5 cl Vermuth dry, 1,5 cl Narancslé', 3900, 'Bronx.jpg'),
(16, 'Bull Shot', '3 cl Vodka, 6 cl Consommé (erőleves), 1 csipet Só + Bors, pár csepp csipetnTabasco, pár csepp Worcestershire', 3700, 'BullShot.jpg'),
(17, 'Caipirinha', '5 cl Cachacha, 1 db Lime, 2 bárkanál Barna cukor', 3900, 'Caipirinha.jpg'),
(18, 'Champagene Cocktail', '9 cl Pezsgő (száraz), 1 cl Brandy, 1 db Kockacukor, 1 csepp Angostura bitter', 4300, 'ChampageneCocktail.jpg'),
(19, 'Chocolate Sazerac', '1,5 cl Cacao White Likőr, 1,5 cl Absithe, 6 cl Bourbon, 1 cl Cukorszirup, néhány csepp Orange bitter, Narancshéj', 4200, 'Chocolate Sazerac.jpg'),
(20, 'Cognac Coulis', '3 cl Konyak, 1 cl Narancs likőr, 5 db Eper, 2 szelet Kiwi', 4200, 'CognacCoulis.jpg'),
(21, 'Cognac Fix', '4 cl konyak, 3 cl brandy, 1 cl citromlé,  1 cl cukorszirup, 1 cl ananászlé, 1 kanál zöld Chartreuse', 4000, 'CognacFix.jpg'),
(22, 'Cosmopolitan', '4 cl Vodka, 1,5 cl Cointreau, 1,5 cl Limelé, 3 cl Áfonyalé', 3800, 'Cosmopolitan.jpg'),
(23, 'Cuba Libre', '5 cl Fehér rum, 1 dl Cola, 1 cikk Lime ', 3500, 'CubaLibre.jpg'),
(24, 'Daiquiri', '4,5 cl Fehér rum, 2 cl Limelé, 0,5 cl Cukorszirup', 3700, 'Daiquiri.jpg'),
(25, 'Dark and Stormy', '6 cl dark rum, 12 cl gyömbér sör, 1,5 cl limelé, jég', 3800, 'dark.jpg'),
(26, 'Depth Charge', '40 cl sör 2 cl Drambuie', 3500, 'Depth Charge.jpg'),
(27, 'Eye-opener', '4 cl Rum, 1,5 cl Triple Sec, 1,5 cl Apricot Brandy, 1 cl Grenadine, 1 db Tojássárgája', 3800, 'Eye-opener.jpg'),
(28, 'Forralt bor', '(4  személyre) 0,75 l száraz- nem túl savas vörösbor, 70 g cukor, 2 rúd fahéj, 8 szem szegfűszeg, 2 szem szegfűbors, 4 szelet citrom', 2800, 'Forralt bor.jpg'),
(29, 'Gibson', '6 cl Gin, 1 cl Vermuth dry, 1db Gyöngyhagyma', 3900, 'Gibson.jpg'),
(30, 'Godmother', '4 cl Vodka, 2 cl Amaretto (mandula likőr), jégkocka', 3900, 'Godmother.jpg'),
(31, 'Honeybow', '2 cl Rum (fehér), 1 cikk Citrom, 1,5 cl Kókusz szirup, Strongbow Honey And Apple Cider', 3800, 'Honeybow.jpg'),
(32, 'Sex On The Beach', '4 cl Vodka, 2 cl Őszibarack likőr, 4 cl Narancslé 4 cl Áfonyalé', 3700, 'SexOnTheBeach.jpg'),
(33, 'Jack Rose', '4 cl calvados pálinka, 2 cl citromlé, 1,5 cl grenadine szirup', 3400, 'JackRose.jpg'),
(34, 'Japanese Slipper', '3 cl Sárgadinnye, 3 cl likőr, 3 cl Cointreau, 3 cl Limelé', 4000, 'JapaneseSlipper.jpg'),
(35, 'Jager Grog', '(5 főre) 2 dl Jägermeister, 2 db narancs leve, 1 zacskó vaníliás cukor, 5 dl fekete tea, 1 db fahéj rúd', 3600, 'jager-grog.jpg'),
(36, 'Kamikaze', '3 cl Vodka, 3 cl Cointreau, 3 cl Limelé', 3100, 'Kamikaze.jpg'),
(37, 'Kir Royale', '9 cl Száraz pezsgő, 1 cl Créme de Cassis', 3400, 'KirRoyale.jpg'),
(38, 'Long Island Ice Tea', 'Vodka 1,5 Tequila 1,5 Fehér rum 1,5 Cointreau 1,5 Gin 1,5 Citromlé 2,5 Cukorszirup 3 Cola 1 dln', 4000, 'LongIslandIceTea.jpg'),
(39, 'Mai Tai', '3 cl Fehér rum, 3 cl Barna rum, 1,5 cl Triple sec, 1,5 cl Mandulaszirup, 1 cl Limelé', 3800, 'MaiTai.jpg'),
(40, 'Malindi', '8 cl Prosecco, 1 cl Mango szirup, 1 cl Őszibarack püré', 3800, 'Malindi.jpg'),
(41, 'Manhattan', 'Bourbon vagy Rye Whiskey 5 Vermuth rosso 2 Angostura bitter 2 cseppn', 4500, 'Manhattan.jpg'),
(42, 'Margarita', '3,5 cl Tequila, 2 cl Cointreau, 1,5 cl Citromlé', 3900, 'Margarita.jpg'),
(43, 'Mimosa', '7,5 cl Pezsgő (száraz), 7,5 cl Narancslé', 3900, 'Mimosa.jpg'),
(44, 'Moscow Mule', '4 cl Vodka, 2 cl Limelé, 3 dl gyömbér/világos sör a felöntéshez', 3900, 'MoscowMule.jpg'),
(45, 'Negroni', '3 cl Gin, 3 cl Campari, 3 cl Vermuth rosso', 4000, 'Negroni.jpg'),
(46, 'Old Fashioned', '4 cl Whisky, 1 cl Angostura bitter, 1 db öntetnkockacukor', 4100, 'OldFashioned.jpg'),
(47, 'Paradise', 'Gin 3,5 Apricot brandy 2 Narancslé 1,5 ', 3700, 'Paradise.jpg'),
(48, 'Passionfruit Collins', 'Vodka, 2 rész Passionfruit püré, 1 rész Citromlé, 1 rész Szódavíz, Ehető virág', 3900, 'Passionfruit Collins.jpg'),
(49, 'Pentecostal', 'Bourbon whiskey 4,5 Vodka 4,5 Sprite vagy 7 Up vagy Szóda 17,5 ', 4100, 'Pentecostal.jpg'),
(50, 'Pink Cadillac', 'Vodka 3 Amaretto 1 Eperszirup 1 Citromlé 2 ', 3800, 'PinkCadillac.jpg'),
(51, 'Planters Punch', '6 cl Barna rum, 3 cl Citromlé, 1 cl Grenadine, 1 dl Szódavíz', 3900, 'PlantersPunch.jpg'),
(52, 'Queens Park Swizzle', '9 cl Fehér rum, 1,5 cl Cukorszirup, 3 cl Angostura, 2 csepp Lime lé, Friss menta', 4000, 'Queens-Park-Swizzle.jpg'),
(53, 'Rabbit Punch', '2 cl Campari, 2 cl Kakaó likőr, 1,5 cl Ír krémlikőr, 1 cl Kókuszlikőr', 3900, 'Rabbitpunch.jpg'),
(54, 'Rob Roy', '4 cl Scotch Whisky, 2 cl Vermuth rosso, 1 öntet Angostura bitter', 4100, 'RobRoy.jpg'),
(55, 'Rusty Nail', '4,5 cl Scotch Whisky, 2,5 cl Drambuie', 4100, 'RustyNail.jpg'),
(56, 'Sake Bomb', '1 üveg világos sör, 3 cl szaké', 4000, 'Sakebomb.jpg'),
(57, 'Salty Dog', '4 cl Vodka, 1 cl Grapefruitlé, 1 csipet só', 3200, 'Salty-dog.jpg'),
(58, 'Screwdriver', '5 cl Vodka, 1 dl Narancslé', 3000, 'Screwdriver.jpg'),
(59, 'B 52', '2 cl Kahlua, 2 cl Baileys, 2 cl Irish Cream, 2 cl Cointreau', 3200, 'B52.jpg');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
