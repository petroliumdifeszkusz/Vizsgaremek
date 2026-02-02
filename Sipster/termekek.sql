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
(1, 'Mojito', 'Menta, lime, rum, szóda', 1800, 'default.jpg'),
(2, 'Pina Colada', 'Ananász, kókusz, rum', 2200, 'default.jpg'),
(3, 'Gin Tonic', 'Gin, tonik, uborka', 1900, 'default.jpg'),
(4, 'Bloody Brain\r\n', '2 cl Őszibarack Likőr\r\n2 cl Bailey\'s Irish Cream \r\n2 cl Grenadine szirup \r\n', 3200, 'default.jpg'),
(5, 'Bloody Mary\r\n', 'Vodka 4,5 cl\r\nParadicsomlé 9 cl\r\nCitromlé 1,5 cl\r\nSó csipet\r\nBors csipet\r\nWorcestershire pár csepp\r\nTabasco pár csepp\r\n', 3800, 'default.jpg'),
(6, 'Boxcar\r\n', 'Száraz Gin 4 cl\r\nCointreau 1 cl\r\nLimelé 1 cl\r\nTojásfehérje 1\r\n', 3900, 'default.jpg'),
(7, 'Lamborghini\r\n', '3 cL Sambuca\r\n\r\n3 cL kávélikőr (pl. Kahlúa)\r\n\r\n3 cL Baileys\r\n\r\n3 cL Blue Curaçao\r\n', 3500, 'default.jpg'),
(8, 'Rose', 'Vermuth dry 4,5 cl\r\nKirsch snaps 1,5 cl\r\nCherry Brandy 1 cl\r\n', 3700, 'default.jpg'),
(9, 'Grasshopper\r\n', 'Créme de Menthe Green 2 cl\r\nCréme De Cacao White 2 cl\r\nTejszín 2 cl\r\n', 3800, 'default.jpg'),
(10, 'Zombie\r\n', 'Fehér Rum 4 cl\r\nBarna Rum 3 cl\r\nStroh rum (80%) 3 cl\r\nAngostura 1 öntet\r\nNarancslé 5 cl\r\nCitromlé 2 cl\r\nAnanászlé 5 cl\r\nCukor 1 teáskanál\r\n', 4200, 'default.jpg'),
(11, 'White Russian\r\n', 'Vodka 4 cl\r\nKahlua 2 cl\r\ntejszín 2 cl\r\njég\r\n', 3800, 'default.jpg'),
(12, 'Godfather\r\n', '4 cl Scotch Whisky\r\n2 cl Amaretto (mandula likőr)\r\njégkocka\r\n', 3800, 'default.jpg'),
(13, 'Brainstorm\r\n', 'Ír whiskey 4 cl\r\nFrancia vermouth 1/2 evőkanál\r\nBenedictine 1/2 evőkanál\r\n', 3200, 'default.jpg'),
(14, 'Brandy Alexander\r\n', 'Brandy 2 cl\r\nCréme De Cacao Brown 2 cl\r\nTejszín 2 cl\r\n', 4200, 'default.jpg'),
(15, 'Bronx\r\n', 'Gin 3 cl\r\nVermuth rosso 1,5 cl\r\nVermuth dry 1,5 cl\r\nNarancslé 1,5 cl\r\n', 3900, 'default.jpg'),
(16, 'Bull Shot\r\n', 'Vodka 3 cl\r\nConsommé (erőleves) 6 cl\r\nCitromlé 1 cl\r\nSó csipet\r\nBors csipet\r\nTabasco pár csepp\r\nWorcestershire pár csepp\r\n', 3700, 'default.jpg'),
(17, 'Caipirinha\r\n', 'Cachacha 5 cl\r\nLime 1 db\r\nBarna cukor 2 bárkanál\r\n', 3900, 'default.jpg'),
(18, 'Champagene Cocktail\r\n', 'Pezsgő (száraz) 9 cl\r\nBrandy 1 cl\r\nKockacukor 1 db\r\nAngostura bitter 1 csepp\r\n', 4300, 'default.jpg'),
(19, 'Chocolate Sazerac\r\n', 'Cacao White Likőr 1,5 cl\r\nAbsithe 1,5 cl\r\nBourbon 6 cl\r\nCukorszirup 1 cl\r\nOrange bitter néhány csepp\r\nNarancshéj\r\n', 4200, 'default.jpg'),
(20, 'Cognac Coulis\r\n', 'Konyak 3 cl\r\nNarancs ízű likőr 1 cl\r\nEper 5 db\r\nKiwi 2 szelet\r\n', 4200, 'default.jpg'),
(21, 'Cognac Fix\r\n', '2 rész konyak/brandy\r\n3/4 rész citromlé\r\n1/2 rész cukorszirup\r\n1/2 rész ananászlé\r\n1 kanálnyi zöld Chartreuse\r\n', 4000, 'default.jpg'),
(22, 'Cosmopolitan\r\n', 'Vodka 4 cl\r\nCointreau 1,5 cl\r\nLimelé 1,5 cl\r\nÁfonyalé 3 cl\r\n', 3800, 'default.jpg'),
(23, 'Cuba Libre\r\n', 'Fehér rum 5 cl\r\nCola 1 dl\r\nLime 1 cikk\r\n', 3500, 'default.jpg'),
(24, 'Daiquiri\r\n', 'Fehér rum 4.5 cl\r\nLimelé 2 cl\r\nCukorszirup 0,5 cl\r\n', 3700, 'default.jpg'),
(25, 'Dark and Stormy\r\n', '6cl dark rum\r\n12 cl gyömbér sör\r\n1,5 cl lime lé\r\njég\r\n', 3800, 'default.jpg'),
(26, 'Depth Charge\r\n', '40 cl sör\r\n2 cl Drambuie\r\n', 3500, 'default.jpg'),
(27, 'Eye-opener\r\n', 'Rum 4 cl\r\nTriple Sec 1.5 cl\r\nApricot Brandy 1.5 cl\r\nGrenadine 1 cl\r\nTojássárgája 1 db\r\n', 3800, 'default.jpg'),
(28, 'Forralt bor\r\n', '(4  személyre)\r\n\r\n0,75 l száraz, nem túl savas vörösbor\r\n70 g cukor\r\n2 rúd fahéj\r\n8 szem szegfűszeg\r\n2 szem szegfűbors\r\n4 szelet citrom\r\n', 2800, 'default.jpg'),
(29, 'Gibson\r\n', 'Gin 6 cl\r\nVermuth dry 1 cl\r\nGyöngyhagyma\r\n', 3900, 'default.jpg'),
(30, 'Godmother\r\n', '4 cl Vodka\r\n2 cl Amaretto (mandula likőr)\r\njégkocka\r\n', 3900, 'default.jpg'),
(31, 'Honeybow\r\n', 'Rum (fehér) 2 cl\r\nCitrom 1 cikk\r\nKókusz szirup 1,5 cl \r\nStrongbow Honey And Apple Cider\r\n', 3800, 'default.jpg'),
(32, 'Sex On The Beach\r\n', 'Vodka 4 cl\r\nŐszibarack likőr 2 cl\r\nNarancslé 4 cl\r\nÁfonyalé 4 cl\r\n', 3700, 'default.jpg'),
(33, 'Jack Rose\r\n', '4 cl calvados pálinka\r\n2 cl citromlé\r\n½ cl grenadine szirup\r\n', 3400, 'default.jpg'),
(34, 'Japanese Slipper\r\n', 'Sárgadinnye likőr 3 cl\r\nCointreau 3 cl\r\nLimelé 3 cl\r\n', 4000, 'default.jpg'),
(35, 'Jager Grog\r\n', '(5 főre)\r\n\r\n2 dl Jägermeister\r\n2 db narancs leve\r\n1 zacskó vaníliás cukor\r\n5 dl fekete tea\r\n1 fahéj rúd\r\n', 3600, 'default.jpg'),
(36, 'Kamikaze\r\n', 'Vodka 3 cl\r\nCointreau 3 cl\r\nLimelé 3 cl\r\n', 3100, 'default.jpg'),
(37, 'Kir Royal\r\n', 'Száraz pezsgő 9 cl\r\nCréme de Cassis 1 cl\r\n', 3400, 'default.jpg'),
(38, 'Long Island Iced Tea\r\n', 'Vodka 1,5 cl\r\nTequila 1,5 cl\r\nFehér rum 1,5 cl\r\nCointreau 1,5 cl\r\nGin 1,5 cl\r\nCitromlé 2,5 cl\r\nCukorszirup 3 cl\r\nCola 1 dl\r\n', 4000, 'default.jpg'),
(39, 'Mai Tai\r\n', 'Fehér rum 3 cl\r\nBarna rum 3 cl\r\nTriple sec 1,5 cl\r\nMandulaszirup 1,5 cl\r\nLimelé 1 cl\r\n', 3800, 'default.jpg'),
(40, 'Malindi\r\n', '8 cl Prosecco\r\n1 cl Mango szirup\r\n1 cl Őszibarack püré\r\n', 3800, 'default.jpg'),
(41, 'Manhattan\r\n', 'Bourbon vagy Rye Whiskey 5 cl\r\nVermuth rosso 2 cl\r\nAngostura bitter 2 csepp\r\n', 4500, 'default.jpg'),
(42, 'Margarita\r\n', 'Tequila 3,5 cl\r\nCointreau 2 cl\r\nCitromlé 1,5 cl\r\n', 3900, 'default.jpg'),
(43, 'Mimosa\r\n', 'Pezsgő (száraz) 7,5 cl\r\nNarancslé 7,5 cl\r\n', 3900, 'default.jpg'),
(44, 'Moscow Mule\r\n', 'Vodka 4 cl\r\nLimelé 2 cl\r\n3dl gyömbérsör vagy világos sör a felöntéshez\r\n', 3900, 'default.jpg'),
(45, 'Negroni\r\n', 'Gin 3 cl\r\nCampari 3 cl\r\nVermuth rosso 3 cl\r\n', 4000, 'default.jpg'),
(46, 'Old Fashioned\r\n', 'Whisky 4 cl\r\nAngostura bitter 1 öntet\r\nkockacukor 1 db\r\n', 4100, 'default.jpg'),
(47, 'Paradise\r\n', 'Gin 3,5 cl\r\nApricot brandy 2 cl\r\nNarancslé 1,5 cl\r\n', 3700, 'default.jpg'),
(48, 'Passionfruit Collins\r\n', 'Vodka 2 rész\r\nPassionfruit (maracuja) püré 1 rész\r\nCitromlé 1 rész\r\nSzódavíz\r\nMaracuja 1/2\r\nEhető virág\r\n', 3900, 'default.jpg'),
(49, 'Pentecostal\r\n', 'Bourbon whiskey 4,5 cl\r\nVodka 4,5 cl\r\nSprite vagy 7 Up vagy Szóda 17,5 cl\r\n', 4100, 'default.jpg'),
(50, 'Pink Cadillac\r\n', 'Vodka 3 cl\r\nAmaretto 1 cl\r\nEperszirup 1 cl\r\nCitromlé 2 cl\r\n', 3800, 'default.jpg'),
(51, 'Planter\'s Punch\r\n', 'Barna rum 6 cl\r\nCitromlé 3 cl\r\nGrenadine 1 cl\r\nSzódavíz 1 dl\r\n', 3900, 'default.jpg'),
(52, 'Queens Park Swizzle\r\n', 'Fehér rum 9 cl\r\nCukorszirup 1,5 cl\r\nAngostura 3 csepp\r\nLime lé 2 cl\r\nFriss menta\r\n', 4000, 'default.jpg'),
(53, 'Rabbit Punch\r\n', 'Campari 2 cl\r\nKakaó likőr 2 cl\r\nÍr krémlikőr 1.5 cl\r\nKókuszlikőr 1 cl', 3900, 'default.jpg'),
(54, 'Rob Roy\r\n', 'Scotch Whisky 4 cl\r\nVermuth rosso 2 cl\r\nAngostura bitter 1 öntet\r\n', 4100, 'default.jpg'),
(55, 'Rusty Nail\r\n', 'Scotch Whisky 4,5 cl\r\nDrambuie 2,5 cl', 4100, 'default.jpg'),
(56, 'Sake Bomb\r\n', '1 üveg (14 rész) világos sör\r\n3 cl (1 rész) szaké', 4000, 'default.jpg'),
(57, 'Salty Dog\r\n', '\"Vodka 4 cl\r\nGrapefruitlé 1 dl\r\nsó 1 kk\"\r\n', 3200, 'default.jpg'),
(58, 'Screwdriver\r\n', '\"Vodka 5 cl\r\nNarancslé 1 dl\"\r\n', 3000, 'default.jpg'),
(59, 'B 52\r\n', 'Kahlua 2 cl\r\nBailey\'s Irish Cream 2 cl\r\nCointreau 2 cl\r\n', 3200, 'default.jpg');

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
