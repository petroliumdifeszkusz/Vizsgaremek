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
(4, 'Bloody Brainn', '2 cl Őszibarack Likőrn2 cl Bailey''s Irish Cream n2 cl Grenadine szirup n', 3200, 'default.jpg'),
(5, 'Bloody Maryn', 'Vodka 4,5 Paradicsomlé 9 Citromlé 1,5 Só csipetnBors csipetnWorcestershire pár cseppnTabasco pár cseppn', 3800, 'default.jpg'),
(6, 'Boxcarn', 'Száraz Gin 4 Cointreau 1 Limelé 1 Tojásfehérje 1n', 3900, 'default.jpg'),
(7, 'Lamborghinin', '3 cL Sambucann3 cL kávélikőr (pl. Kahlúa)nn3 cL Baileysnn3 cL Blue Curaçaon', 3500, 'default.jpg'),
(8, 'Rose', 'Vermuth dry 4,5 Kirsch snaps 1,5 Cherry Brandy 1 ', 3700, 'default.jpg'),
(9, 'Grasshoppern', 'Créme de Menthe Green 2 Créme De Cacao White 2 Tejszín 2 ', 3800, 'default.jpg'),
(10, 'Zombien', 'Fehér Rum 4 Barna Rum 3 Stroh rum (80%) 3 Angostura 1 öntetnNarancslé 5 Citromlé 2 Ananászlé 5 Cukor 1 teáskanáln', 4200, 'default.jpg'),
(11, 'White Russiann', 'Vodka 4 Kahlua 2 tejszín 2 jégn', 3800, 'default.jpg'),
(12, 'Godfathern', '4 cl Scotch Whiskyn2 cl Amaretto (mandula likőr)njégkockan', 3800, 'default.jpg'),
(13, 'Brainstormn', 'Ír whiskey 4 Francia vermouth 1/2 evőkanálnBenedictine 1/2 evőkanáln', 3200, 'default.jpg'),
(14, 'Brandy Alexandern', 'Brandy 2 Créme De Cacao Brown 2 Tejszín 2 ', 4200, 'default.jpg'),
(15, 'Bronxn', 'Gin 3 Vermuth rosso 1,5 Vermuth dry 1,5 Narancslé 1,5 ', 3900, 'default.jpg'),
(16, 'Bull Shotn', 'Vodka 3 Consommé (erőleves) 6 Citromlé 1 Só csipetnBors csipetnTabasco pár cseppnWorcestershire pár cseppn', 3700, 'default.jpg'),
(17, 'Caipirinhan', 'Cachacha 5 Lime 1 dbnBarna cukor 2 bárkanáln', 3900, 'default.jpg'),
(18, 'Champagene Cocktailn', 'Pezsgő (száraz) 9 Brandy 1 Kockacukor 1 dbnAngostura bitter 1 cseppn', 4300, 'default.jpg'),
(19, 'Chocolate Sazeracn', 'Cacao White Likőr 1,5 Absithe 1,5 Bourbon 6 Cukorszirup 1 Orange bitter néhány cseppnNarancshéjn', 4200, 'default.jpg'),
(20, 'Cognac Coulisn', 'Konyak 3 Narancs ízű likőr 1 Eper 5 dbnKiwi 2 szeletn', 4200, 'default.jpg'),
(21, 'Cognac Fixn', '2 rész konyak/brandyn3/4 rész citromlén1/2 rész cukorszirupn1/2 rész ananászlén1 kanálnyi zöld Chartreusen', 4000, 'default.jpg'),
(22, 'Cosmopolitann', 'Vodka 4 Cointreau 1,5 Limelé 1,5 Áfonyalé 3 ', 3800, 'default.jpg'),
(23, 'Cuba Libren', 'Fehér rum 5 Cola 1 dlnLime 1 cikkn', 3500, 'default.jpg'),
(24, 'Daiquirin', 'Fehér rum 4.5 Limelé 2 Cukorszirup 0,5 ', 3700, 'default.jpg'),
(25, 'Dark and Stormyn', '6cl dark rumn12 cl gyömbér sörn1,5 cl lime lénjégn', 3800, 'default.jpg'),
(26, 'Depth Chargen', '40 cl sörn2 cl Drambuien', 3500, 'default.jpg'),
(27, 'Eye-openern', 'Rum 4 Triple Sec 1.5 Apricot Brandy 1.5 Grenadine 1 Tojássárgája 1 dbn', 3800, 'default.jpg'),
(28, 'Forralt born', '(4  személyre)nn0,75 l száraz, nem túl savas vörösborn70 g cukorn2 rúd fahéjn8 szem szegfűszegn2 szem szegfűborsn4 szelet citromn', 2800, 'default.jpg'),
(29, 'Gibsonn', 'Gin 6 Vermuth dry 1 Gyöngyhagyman', 3900, 'default.jpg'),
(30, 'Godmothern', '4 cl Vodkan2 cl Amaretto (mandula likőr)njégkockan', 3900, 'default.jpg'),
(31, 'Honeybown', 'Rum (fehér) 2 Citrom 1 cikknKókusz szirup 1,5 cl nStrongbow Honey And Apple Cidern', 3800, 'default.jpg'),
(32, 'Sex On The Beachn', 'Vodka 4 Őszibarack likőr 2 Narancslé 4 Áfonyalé 4 ', 3700, 'default.jpg'),
(33, 'Jack Rosen', '4 cl calvados pálinkan2 cl citromlén½ cl grenadine szirupn', 3400, 'default.jpg'),
(34, 'Japanese Slippern', 'Sárgadinnye likőr 3 Cointreau 3 Limelé 3 ', 4000, 'default.jpg'),
(35, 'Jager Grogn', '(5 főre)nn2 dl Jägermeistern2 db narancs leven1 zacskó vaníliás cukorn5 dl fekete tean1 fahéj rúdn', 3600, 'default.jpg'),
(36, 'Kamikazen', 'Vodka 3 Cointreau 3 Limelé 3 ', 3100, 'default.jpg'),
(37, 'Kir Royaln', 'Száraz pezsgő 9 Créme de Cassis 1 ', 3400, 'default.jpg'),
(38, 'Long Island Iced Tean', 'Vodka 1,5 Tequila 1,5 Fehér rum 1,5 Cointreau 1,5 Gin 1,5 Citromlé 2,5 Cukorszirup 3 Cola 1 dln', 4000, 'default.jpg'),
(39, 'Mai Tain', 'Fehér rum 3 Barna rum 3 Triple sec 1,5 Mandulaszirup 1,5 Limelé 1 ', 3800, 'default.jpg'),
(40, 'Malindin', '8 cl Proseccon1 cl Mango szirupn1 cl Őszibarack pürén', 3800, 'default.jpg'),
(41, 'Manhattann', 'Bourbon vagy Rye Whiskey 5 Vermuth rosso 2 Angostura bitter 2 cseppn', 4500, 'default.jpg'),
(42, 'Margaritan', 'Tequila 3,5 Cointreau 2 Citromlé 1,5 ', 3900, 'default.jpg'),
(43, 'Mimosan', 'Pezsgő (száraz) 7,5 Narancslé 7,5 ', 3900, 'default.jpg'),
(44, 'Moscow Mulen', 'Vodka 4 Limelé 2 3dl gyömbérsör vagy világos sör a felöntéshezn', 3900, 'default.jpg'),
(45, 'Negronin', 'Gin 3 Campari 3 Vermuth rosso 3 ', 4000, 'default.jpg'),
(46, 'Old Fashionedn', 'Whisky 4 Angostura bitter 1 öntetnkockacukor 1 dbn', 4100, 'default.jpg'),
(47, 'Paradisen', 'Gin 3,5 Apricot brandy 2 Narancslé 1,5 ', 3700, 'default.jpg'),
(48, 'Passionfruit Collinsn', 'Vodka 2 résznPassionfruit (maracuja) püré 1 résznCitromlé 1 résznSzódavíznMaracuja 1/2nEhető virágn', 3900, 'default.jpg'),
(49, 'Pentecostaln', 'Bourbon whiskey 4,5 Vodka 4,5 Sprite vagy 7 Up vagy Szóda 17,5 ', 4100, 'default.jpg'),
(50, 'Pink Cadillacn', 'Vodka 3 Amaretto 1 Eperszirup 1 Citromlé 2 ', 3800, 'default.jpg'),
(51, 'Planter''s Punchn', 'Barna rum 6 Citromlé 3 Grenadine 1 Szódavíz 1 dln', 3900, 'default.jpg'),
(52, 'Queens Park Swizzlen', 'Fehér rum 9 Cukorszirup 1,5 Angostura 3 cseppnLime lé 2 Friss mentan', 4000, 'default.jpg'),
(53, 'Rabbit Punchn', 'Campari 2 Kakaó likőr 2 Ír krémlikőr 1.5 Kókuszlikőr 1 cl', 3900, 'default.jpg'),
(54, 'Rob Royn', 'Scotch Whisky 4 Vermuth rosso 2 Angostura bitter 1 öntetn', 4100, 'default.jpg'),
(55, 'Rusty Nailn', 'Scotch Whisky 4,5 Drambuie 2,5 cl', 4100, 'default.jpg'),
(56, 'Sake Bombn', '1 üveg (14 rész) világos sörn3 cl (1 rész) szaké', 4000, 'default.jpg'),
(57, 'Salty Dogn', '"Vodka 4 Grapefruitlé 1 dlnsó 1 kk"n', 3200, 'default.jpg'),
(58, 'Screwdrivern', '"Vodka 5 Narancslé 1 dl"n', 3000, 'default.jpg'),
(59, 'B 52n', 'Kahlua 2 Bailey''s Irish Cream 2 Cointreau 2 ', 3200, 'default.jpg');

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
