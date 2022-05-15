-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 15 mai 2022 à 19:48
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ARYHA`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `photo2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `photo`, `prix`, `couleur`, `category_id`, `photo2`, `photo3`, `photo4`, `photo5`, `photo6`) VALUES
(132, 'Sneakers Charlie', 'Premier soulier unisexe écoconçu de Louis Vuitton, cette sneaker Charlie est composée à 90 % de matériaux durables. Cette version se décline en denim Monogram upcyclé avec une signature LV Initiales oversize brodée sur le côté grâce à du fil recyclé et un logo LV upcycling sur la languette. Des lacets en polyester recyclé et une semelle extérieure 100 % polyuréthane régénéré complètent cette pièce.', 'louis-vuitton-sneaker-charlie-souliers--BN4U1PDN20_PM2_Front view.png-626954bad363f.jpg', 120, 'bleu', 50, 'louis-vuitton-sneaker-charlie-souliers--BN4U1PDN20_PM1_Closeup view.png-626954bad38e3.jpg', 'null', 'null', 'null', 'null'),
(133, 'Sneakers LV RUNNER TATIC', 'Dévoilée lors du défilé Homme de la collection Printemps-Été 2022 Louis Vuitton, cette sneaker LV Runner Tatic s\'inspire d\'un modèle de course. Elle est confectionnée dans un mélange de matières, incluant de la résille et du veau velours, et présente des fleurs de Monogram réfléchissantes sur le côté. Une cheville matelassée confortable, une doublure technique souple ainsi qu\'une semelle extérieure en gomme légère complètent ce soulier.', 'louis-vuitton-sneaker-lv-runner-tatic-souliers--BMIU1PMI45_PM2_Front view.png-626955672aa72.jpg', 150, 'vert', 50, 'louis-vuitton-sneaker-lv-runner-tatic-souliers--BMIU1PMI45_PM1_Worn view.png-626955672ac83.jpg', 'louis-vuitton-sneaker-lv-runner-tatic-souliers--BMIU1PMI45_PM1_Interior2 view.png-626955672af2f.jpg', 'louis-vuitton-sneaker-lv-runner-tatic-souliers--BMIU1PMI45_PM1_Interior view.png-626955672b0cf.jpg', 'louis-vuitton-sneaker-lv-runner-tatic-souliers--BMIU1PMI45_PM1_Closeup view.png-626955672b240.jpg', 'louis-vuitton-sneaker-lv-runner-tatic-souliers--BMIU1PMI45_PM1_Ambiance view.png-626955672b3a9.jpg'),
(134, 'Sneakers SuperMan', 'Cette version rouge, blanc et bleu de la sneaker LV Trainer associe du cuir de veau lisse et grainé à du tissu technique. Conçu par Virgil Abloh, directeur artistique de Louis Vuitton, ce modèle culte tire son inspiration des sneakers de basket-ball. La semelle extérieure rouge et blanche présente des fleurs de Monogram et un insert bleu.', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U8PMI01_PM2_Front view.png-626955f6acceb.jpg', 200, 'bleu', 50, 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U8PMI01_PM1_Other view.png-626955f6aceb2.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U8PMI01_PM1_Interior2 view.png-626955f6acff0.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U8PMI01_PM1_Interior view.png-626955f6ad104.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U8PMI01_PM1_Detail view.png-626955f6ad219.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U8PMI01_PM1_Closeup view.png-626955f6ad34e.jpg'),
(135, 'Sneakers Bien Moche et Chere', 'Cette version exceptionnelle de la sneaker LV Trainer est incrustée de cristaux scintillants. Ils mettent en valeur le montage élaboré de la tige qui a nécessité sept heures de couture aux artisans de Louis Vuitton. Inspiré par la sneaker de basket-ball vintage, ce soulier emblématique a été imaginé par le directeur artistique Virgil Abloh.', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U1PSR14_PM2_Front view.png-62695683b0015.jpg', 3000, 'Rose', 50, 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U1PSR14_PM1_Other view.png-62695683b0286.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U1PSR14_PM1_Interior view.png-62695683b0450.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U1PSR14_PM1_Detail view.png-62695683b055a.jpg', 'louis-vuitton-sneaker-lv-trainer-souliers--BL9U1PSR14_PM1_Closeup view.png-62695683b066a.jpg', 'null'),
(136, 'MOCASSIN LV DRIVER', 'Premier soulier de conduite imaginé par Virgil Abloh, ce mocassin LV Driver est confectionné en cuir de veau velours souple embossé du motif Monogram emblématique. Ce modèle présente un montage tubulaire qui offre davantage de souplesse et de légèreté, tandis que les coutures faites main sur l\'empeigne rendent hommage au savoir-faire de Louis Vuitton. Des embouts de lacets agrémentés des LV Initiales complètent cette pièce.', 'louis-vuitton-mocassin-lv-driver-souliers--BNLL2MSC22_PM2_Front view.png-626957685f30c.jpg', 95, 'bleu', 51, 'louis-vuitton-mocassin-lv-driver-souliers--BNLL2MSC22_PM1_Worn view.png-626957685f500.jpg', 'louis-vuitton-mocassin-lv-driver-souliers--BNLL2MSC22_PM1_Interior2 view.png-626957685f63d.jpg', 'louis-vuitton-mocassin-lv-driver-souliers--BNLL2MSC22_PM1_Interior view.png-626957685f759.jpg', 'louis-vuitton-mocassin-lv-driver-souliers--BNLL2MSC22_PM1_Closeup view.png-626957685f881.jpg', 'louis-vuitton-mocassin-lv-driver-souliers--BNLL2MSC22_PM1_Ambiance view.png-626957685f9c1.jpg'),
(137, 'MOCASSIN ESTATE', 'Conçue pour tous les temps, cette version du mocassin Estate est confectionnée dans un cuir de veau velours grainé déperlant avec une doublure chaude en laine. La bride sur la tige est sublimée d\'un accessoire LV Initiales. Ce soulier slip-on confortable repose sur une semelle extérieure légère et souple en micro, estampée de la signature Louis Vuitton.', 'louis-vuitton-mocassin-estate-souliers--BMCL1MNU30_PM2_Front view.png-626958392d8ac.jpg', 95, 'Noir', 51, 'louis-vuitton-mocassin-estate-souliers--BMCL1MNU30_PM1_Interior2 view.png-626958392da56.jpg', 'louis-vuitton-mocassin-estate-souliers--BMCL1MNU30_PM1_Interior view.png-626958392db6f.jpg', 'louis-vuitton-mocassin-estate-souliers--BMCL1MNU30_PM1_Detail view.png-626958392dc96.jpg', 'louis-vuitton-mocassin-estate-souliers--BMCL1MNU30_PM1_Closeup view.png-626958392ddd8.jpg', 'null'),
(138, 'PORTE-DOCUMENTS VOYAGE PM', 'Habillé de toile Damier Graphite masculine, le Porte-Documents Voyage PM affiche un style élégant et naturel. Doté de garnitures en cuir lisse et d’un intérieur spacieux, il conjugue luxe et fonctionnalité.', 'louis-vuitton-porte-documents-voyage-pm-toile-damier-graphite-sacs--N41478_PM2_Front view.png-626958f4b5ce8.jpg', 140, 'Noir', 41, 'louis-vuitton-porte-documents-voyage-pm-toile-damier-graphite-sacs--N41478_PM1_Ambiance view.png-626958f4b6013.jpg', 'louis-vuitton-porte-documents-voyage-pm-toile-damier-graphite-sacs--N41478_PM1_Interior view.png-626958f4b6169.jpg', 'louis-vuitton-porte-documents-voyage-pm-toile-damier-graphite-sacs--N41478_PM1_Side view.png-626958f4b625f.jpg', 'louis-vuitton-porte-documents-voyage-pm-toile-damier-graphite-sacs--N41478_PM1_Other view4.png-626958f4b6433.jpg', 'louis-vuitton-porte-documents-voyage-pm-toile-damier-graphite-sacs--N41478_PM1_Detail view.png-626958f4b6535.jpg'),
(139, 'PORTE-DOCUMENTS ARMAND', 'Avec ses détails délicats, le porte-documents Armand en cuir Taurillon grainé est la définition même de l’élégance alliée au style business. Ce modèle très pratique comporte de nombreux compartiments, dont un grand zippé pour votre ordinateur portable.', 'louis-vuitton-porte-documents-armand-cuir-taurillon-sacs--M54381_PM2_Front view.png-6269599e39c8a.jpg', 129, 'Noir', 41, 'louis-vuitton-porte-documents-armand-cuir-taurillon-sacs--M54381_PM1_Side view.png-6269599e3a040.jpg', 'louis-vuitton-porte-documents-armand-cuir-taurillon-sacs--M54381_PM1_Other view.png-6269599e3a17e.jpg', 'louis-vuitton-porte-documents-armand-cuir-taurillon-sacs--M54381_PM1_Interior view.png-6269599e3a393.jpg', 'louis-vuitton-porte-documents-armand-cuir-taurillon-sacs--M54381_PM1_Detail view.png-6269599e3a568.jpg', 'null'),
(140, 'SAC À DOS DISCOVERY', 'Ce sac à dos Discovery en toile Monogram Éclipse souple arbore un style à la fois décontracté et élégant. Il se distingue par ses détails pratiques tels qu’une bandoulière en cuir confortable et une poche avant dotée d’une fermeture aimantée.', 'louis-vuitton-sac-à-dos-discovery-toile-monogram-éclipse-sacs--M43186_PM2_Front view.png-62695a2d9a808.jpg', 129, 'Noir', 42, 'louis-vuitton-sac-à-dos-discovery-toile-monogram-éclipse-sacs--M43186_PM1_Worn view.png-62695a2d9ab3e.jpg', 'louis-vuitton-sac-à-dos-discovery-toile-monogram-éclipse-sacs--M43186_PM1_Side view.png-62695a2d9ad47.jpg', 'louis-vuitton-sac-à-dos-discovery-toile-monogram-éclipse-sacs--M43186_PM1_Interior view.png-62695a2d9af8b.jpg', 'louis-vuitton-sac-à-dos-discovery-toile-monogram-éclipse-sacs--M43186_PM1_Detail view.png-62695a2d9b0bd.jpg', 'louis-vuitton-sac-à-dos-discovery-toile-monogram-éclipse-sacs--M43186_PM1_Ambiance view.png-62695a2d9b25d.jpg'),
(141, 'SAC BACKPACK MULTIPOCKETS', 'Ce sac Backpack Multipockets est confectionné dans le nouveau cuir Taurillon Illusion créé par Virgil Abloh. Il présente un dégradé de couleurs fluorescentes qui donne l\'impression d\'avoir été peint à la bombe sur le cuir de vache embossé du motif Monogram. Ce modèle comprend deux poches extérieures à accès rapide et un compartiment suffisamment spacieux pour accueillir un ordinateur portable.', 'louis-vuitton-sac-backpack-multipockets-autres-cuirs-à-la-une--M59690_PM2_Front view.png-62695aac55def.jpg', 25, 'vert', 42, 'louis-vuitton-sac-backpack-multipockets-autres-cuirs-à-la-une--M59690_PM1_Interior view.png-62695aac55ffd.jpg', 'louis-vuitton-sac-backpack-multipockets-autres-cuirs-à-la-une--M59690_PM1_Detail view.png-62695aac56143.jpg', 'louis-vuitton-sac-backpack-multipockets-autres-cuirs-à-la-une--M59690_PM1_Side view.png-62695aac562b8.jpg', 'louis-vuitton-sac-backpack-multipockets-autres-cuirs-à-la-une--M59690_PM1_Closeup view.png-62695aac563e7.jpg', 'null'),
(142, 'SAC TRIO MESSENGER', 'Confectionné en toile Monogram et cuir Taïga colorés, ce sac Trio Messenger fait partie de la collection de maroquinerie Taïgarama. Il se compose d\'un compartiment principal, d\'une poche avant amovible avec fermeture à glissière et d\'un petit porte-monnaie sur la bandoulière. Bien plus qu\'un sac traditionnel, ce modèle est conçu pour les modes de vie modernes.', 'louis-vuitton-sac-trio-messenger-k45-sacs--M30848_PM2_Front view.png-62695b2d44ca2.jpg', 75, 'bleu', 43, 'louis-vuitton-sac-trio-messenger-k45-sacs--M30848_PM1_Side view.png-62695b2d44ea5.jpg', 'louis-vuitton-sac-trio-messenger-k45-sacs--M30848_PM1_Interior view.png-62695b2d44fd1.jpg', 'louis-vuitton-sac-trio-messenger-k45-sacs--M30848_PM1_Detail view.png-62695b2d45111.jpg', 'louis-vuitton-sac-trio-messenger-k45-sacs--M30848_PM1_Closeup view.png-62695b2d45294.jpg', 'louis-vuitton-sac-trio-messenger-k45-sacs--M30848_PM1_Back view.png-62695b2d4539f.jpg'),
(143, 'SAC MESSENGER TRUNK', 'Ce petit sac rectangulaire Messenger Trunk est confectionné en toile Monogram Éclipse. Inspiré des malles emblématiques de Louis Vuitton, il est orné de rivets noir mat et de renforts de fond en cuir noir. Ce modèle est doté d\'une bandoulière de sac ajustable et amovible et de nombreuses poches intérieures et extérieures qui permettent d\'organiser et d\'accéder aisément à son contenu.', 'louis-vuitton-sac-messenger-trunk-toile-monogram-éclipse-sacs--M45727_PM2_Front view.png-62695baff1586.jpg', 75, 'Noir', 43, 'louis-vuitton-sac-messenger-trunk-toile-monogram-éclipse-sacs--M45727_PM1_Worn view.png-62695baff1906.jpg', 'louis-vuitton-sac-messenger-trunk-toile-monogram-éclipse-sacs--M45727_PM1_Side view.png-62695baff1b12.jpg', 'louis-vuitton-sac-messenger-trunk-toile-monogram-éclipse-sacs--M45727_PM1_Interior view.png-62695baff1ca8.jpg', 'louis-vuitton-sac-messenger-trunk-toile-monogram-éclipse-sacs--M45727_PM1_Closeup view.png-62695baff1d9c.jpg', 'louis-vuitton-sac-messenger-trunk-toile-monogram-éclipse-sacs--M45727_PM1_Ambiance view.png-62695baff1ea8.jpg'),
(144, 'PORTEFEUILLE ZIPPY VERTICAL', 'Cette déclinaison du portefeuille Zippy Vertical à fermeture à glissière intégrale est réalisée en cuir Taïga, un matériau à la fois souple et résistant. Doté d’un design élégant, il comprend plusieurs fentes pour les cartes ainsi que des compartiments séparés pour les billets, les papiers et la monnaie. Cet accessoire indispensable est signé d’un emblème LV en métal argenté.', 'louis-vuitton-portefeuille-zippy-vertical-cuir-taïga-portefeuilles-et-petite-maroquinerie--M30317_PM2_Front view.png-62695c500a158.jpg', 60, 'Noir', 44, 'louis-vuitton-portefeuille-zippy-vertical-cuir-taïga-portefeuilles-et-petite-maroquinerie--M30317_PM1_Side view.png-62695c500a4b1.jpg', 'louis-vuitton-portefeuille-zippy-vertical-cuir-taïga-portefeuilles-et-petite-maroquinerie--M30317_PM1_Detail view.png-62695c500a5e3.jpg', 'louis-vuitton-portefeuille-zippy-vertical-cuir-taïga-portefeuilles-et-petite-maroquinerie--M30317_PM1_Interior view.png-62695c500a82e.jpg', 'louis-vuitton-portefeuille-zippy-vertical-cuir-taïga-portefeuilles-et-petite-maroquinerie--M30317_PM1_Back view.png-62695c500a94d.jpg', 'louis-vuitton-portefeuille-zippy-vertical-cuir-taïga-portefeuilles-et-petite-maroquinerie--M30317_PM1_Closeup view.png-62695c500aa6a.jpg'),
(145, 'PORTEFEUILLE BRAZZA', 'Confectionné en cuir Taïga et toile Monogram dans un coloris nuancé, ce portefeuille Brazza adopte une allure graphique instantanément reconnaissable. Son intérieur élégant comprend 16 fentes pour les cartes de crédit, un grand compartiment avec fermeture à glissière pour la monnaie, et quatre compartiments intérieurs pour les billets et les reçus. Il se glisse dans la plupart des poches.', 'louis-vuitton-portefeuille-brazza-k45-portefeuilles-et-petite-maroquinerie--M30297_PM2_Front view.png-62695cabbaf5e.jpg', 60, 'bleu', 44, 'louis-vuitton-portefeuille-brazza-k45-portefeuilles-et-petite-maroquinerie--M30297_PM1_Detail view.png-62695cabbb319.jpg', 'louis-vuitton-portefeuille-brazza-k45-portefeuilles-et-petite-maroquinerie--M30297_PM1_Interior view.png-62695cabbb513.jpg', 'louis-vuitton-portefeuille-brazza-k45-portefeuilles-et-petite-maroquinerie--M30297_PM1_Side view.png-62695cabbb637.jpg', 'louis-vuitton-portefeuille-brazza-k45-portefeuilles-et-petite-maroquinerie--M30297_PM1_Closeup view.png-62695cabbb729.jpg', 'louis-vuitton-portefeuille-brazza-k45-portefeuilles-et-petite-maroquinerie--M30297_Back view.png-62695cabbb834.jpg'),
(146, 'PORTEFEUILLE SLENDER', 'Élégant et fonctionnel, ce portefeuille Slender est réalisé en toile Monogram Éclipse Reverse et doté d\'une doublure en cuir grainé. Assez fin pour se glisser dans la plupart des poches ou des sacs, cet accessoire raffiné comporte plusieurs fentes et compartiments pour accueillir les cartes et les billets.', 'louis-vuitton-portefeuille-slender-g66-portefeuilles-et-petite-maroquinerie--M80906_PM2_Front view.png-62695de403fbf.jpg', 45, 'Noir', 45, 'louis-vuitton-portefeuille-slender-g66-portefeuilles-et-petite-maroquinerie--M80906_PM1_Side view.png-62695de40434a.jpg', 'louis-vuitton-portefeuille-slender-g66-portefeuilles-et-petite-maroquinerie--M80906_PM1_Interior view.png-62695de404576.jpg', 'louis-vuitton-portefeuille-slender-g66-portefeuilles-et-petite-maroquinerie--M80906_PM1_Detail view.png-62695de404790.jpg', 'louis-vuitton-portefeuille-slender-g66-portefeuilles-et-petite-maroquinerie--M80906_PM1_Back view.png-62695de4048e1.jpg', 'null'),
(147, 'PORTEFEUILLE MULTIPLE', 'L\'effet ton sur ton de la toile Monogram et du cuir Taïga met en évidence les lignes harmonieuses de ce portefeuille Multiple pour le Printemps-Été 2019. Il possède des compartiments et des fentes pour ranger des cartes, des reçus et des billets. Il se glisse facilement dans la plupart des poches.', 'louis-vuitton-portefeuille-multiple-k45-portefeuilles-et-petite-maroquinerie--M30299_PM2_Front view.png-62695e5389b0a.jpg', 45, 'bleu', 45, 'louis-vuitton-portefeuille-multiple-k45-portefeuilles-et-petite-maroquinerie--M30299_PM1_Side view.png-62695e5389e18.jpg', 'louis-vuitton-portefeuille-multiple-k45-portefeuilles-et-petite-maroquinerie--M30299_PM1_Interior view.png-62695e5389fa6.jpg', 'louis-vuitton-portefeuille-multiple-k45-portefeuilles-et-petite-maroquinerie--M30299_PM1_Closeup view.png-62695e538a0b5.jpg', 'louis-vuitton-portefeuille-multiple-k45-portefeuilles-et-petite-maroquinerie--M30299_PM1_Back view.png-62695e538a22c.jpg', 'null'),
(148, 'POCHETTE VOYAGE', 'Cette pochette Voyage s\'habille de la toile Damier Stripes dans un dégradé de verts. Bordée de cuir noir et sublimée par la nouvelle étiquette Louis Vuitton, cette pièce à rayures rappelle les malles historiques de la Maison. Grâce à ses fentes pour les cartes et son intérieur spacieux, elle permet de transporter aisément un téléphone, un ordinateur portable et d\'autres indispensables.', 'louis-vuitton-pochette-voyage-damier-other-portefeuilles-et-petite-maroquinerie--M81317_PM2_Front view.png-62695eb88c8cf.jpg', 65, 'vert', 46, 'louis-vuitton-pochette-voyage-damier-other-portefeuilles-et-petite-maroquinerie--M81317_PM1_Side view.png-62695eb88cce1.jpg', 'louis-vuitton-pochette-voyage-damier-other-portefeuilles-et-petite-maroquinerie--M81317_PM1_Interior view.png-62695eb88cf0d.jpg', 'louis-vuitton-pochette-voyage-damier-other-portefeuilles-et-petite-maroquinerie--M81317_PM1_Detail view.png-62695eb88d107.jpg', 'louis-vuitton-pochette-voyage-damier-other-portefeuilles-et-petite-maroquinerie--M81317_PM1_Back view.png-62695eb88d23c.jpg', 'null'),
(149, 'POCHETTE LEMON POUCH', 'Présentée lors du défilé « Amen Break » de Virgil Abloh pour la collection Printemps-Été 2022, cette nouvelle pochette Lemon Pouch est aussi astucieuse que spectaculaire. Reprenant la forme et la couleur d\'un vrai citron, elle combine la toile Monogram historique de Louis Vuitton et une « feuille » en cuir dotée d\'un crochet qui permet de l\'attacher à un anneau demi-rond ou à une tirette de fermeture à glissière. Pièce de collection exceptionnelle, elle constitue un cadeau ludique qui ravira les adeptes de la Maison.', 'louis-vuitton-pochette-lemon-pouch-autres-toiles-monogram-portefeuilles-et-petite-maroquinerie--M81197_PM2_Front view.png-62695f24d2046.jpg', 65, 'jaune', 46, 'louis-vuitton-pochette-lemon-pouch-autres-toiles-monogram-portefeuilles-et-petite-maroquinerie--M81197_PM1_Worn view.png-62695f24d2346.jpg', 'louis-vuitton-pochette-lemon-pouch-autres-toiles-monogram-portefeuilles-et-petite-maroquinerie--M81197_PM1_Side view.png-62695f24d24a1.jpg', 'louis-vuitton-pochette-lemon-pouch-autres-toiles-monogram-portefeuilles-et-petite-maroquinerie--M81197_PM1_Interior view.png-62695f24d265f.jpg', 'louis-vuitton-pochette-lemon-pouch-autres-toiles-monogram-portefeuilles-et-petite-maroquinerie--M81197_PM1_Closeup view.png-62695f24d2880.jpg', 'louis-vuitton-pochette-lemon-pouch-autres-toiles-monogram-portefeuilles-et-petite-maroquinerie--M81197_PM1_Back view.png-62695f24d29a8.jpg'),
(150, 'CEINTURE LV INITIALES 40 MM RÉVERSIBLE', 'Cette ceinture LV Initiales 40 mm réversible actualise dans une palette vibrante l’un des accessoires les plus convoités de la Maison. La lanière présente un côté en cuir de veau de couleur vive et un autre en toile Monogram Éclipse. Conçue pour s’accorder à de nombreuses silhouettes, cette pièce est sublimée d’une boucle LV Initiales en métal brillant qui souligne son esthétique contemporaine.', 'louis-vuitton-ceinture-lv-initiales-40-mm-réversible-toile-monogram-éclipse-ceintures--M0534V_PM2_Front view.png-62695f99d5853.jpg', 105, 'bleu', 47, 'louis-vuitton-ceinture-lv-initiales-40-mm-réversible-toile-monogram-éclipse-ceintures--M0534V_PM1_Worn view.png-62695f99d5bab.jpg', 'louis-vuitton-ceinture-lv-initiales-40-mm-réversible-toile-monogram-éclipse-ceintures--M0534V_PM1_Closeup view.png-62695f99d5dc8.jpg', 'louis-vuitton-ceinture-lv-initiales-40-mm-réversible-toile-monogram-éclipse-ceintures--M0534V_PM1_Back view.png-62695f99d5f03.jpg', 'louis-vuitton-ceinture-lv-initiales-40-mm-réversible-toile-monogram-éclipse-ceintures--M0534V_PM1_Other view4.png-62695f99d5ff3.jpg', 'null'),
(151, 'CEINTURE DAMIER LV 40 MM RÉVERSIBLE', 'Cette ceinture Damier LV 40 mm réversible associe un savoir-faire artisanal à un style intemporel. La lanière en cuir de veau foncé est sublimée par une boucle LV Initiales finement gravée d’un motif Damier. Entièrement réversible, cet accessoire élégant s’accorde avec des tenues variées.', 'louis-vuitton-ceinture-damier-lv-40-mm-réversible-autres-cuirs-ceintures--M0333U_PM2_Front view.png-6269600997537.jpg', 105, 'Noir', 47, 'louis-vuitton-ceinture-damier-lv-40-mm-réversible-autres-cuirs-ceintures--M0333U_PM1_Worn view.png-62696009978ab.jpg', 'louis-vuitton-ceinture-damier-lv-40-mm-réversible-autres-cuirs-ceintures--M0333U_PM1_Other view4.png-6269600997ac1.jpg', 'louis-vuitton-ceinture-damier-lv-40-mm-réversible-autres-cuirs-ceintures--M0333U_PM1_Closeup view.png-6269600997be2.jpg', 'louis-vuitton-ceinture-damier-lv-40-mm-réversible-autres-cuirs-ceintures--M0333U_PM1_Back view.png-6269600997d10.jpg', 'null'),
(152, 'ÉCHARPE PETIT DAMIER', 'L’écharpe Petit Damier mêle des textures douces à des coloris sourds. Tricotée en pure laine, elle est ornée de l’iconique motif Damier décliné dans des tons discrets. La signature LV Initials apparaît sur un écusson textile.', 'louis-vuitton-écharpe-petit-damier-s00-écharpes--M70929_PM2_Front view.png-6269618ce4fd6.jpg', 40, 'bleu', 48, 'louis-vuitton-écharpe-petit-damier-s00-écharpes--M70929_PM1_Other view3.png-6269618ce5326.jpg', 'louis-vuitton-écharpe-petit-damier-s00-écharpes--M70929_PM1_Other view2.png-6269618ce5510.jpg', 'louis-vuitton-écharpe-petit-damier-s00-écharpes--M70929_PM1_Other view.png-6269618ce5726.jpg', 'null', 'null'),
(153, 'ÉCHARPE NM PETIT DAMIER', 'Cette écharpe en laine douce est tricotée avec une grande précision afin de reproduire les détails de l’emblématique motif Damier de Louis Vuitton. Un cadeau idéal pour vous garder au chaud pendant l\'hiver.', 'louis-vuitton-écharpe-nm-petit-damier-s00-écharpes--M70030_PM2_Front view.png-626961e4cbb0c.jpg', 60, 'Noir', 48, 'louis-vuitton-écharpe-nm-petit-damier-s00-écharpes--M70030_PM1_Worn view.png-626961e4cbe60.jpg', 'louis-vuitton-écharpe-nm-petit-damier-s00-écharpes--M70030_PM1_Closeup view.png-626961e4cc091.jpg', 'null', 'null', 'null'),
(154, 'BONNET NM PETIT DAMIER', 'Ce bonnet en laine douce est tricoté avec une grande précision afin de reproduire les détails de l’emblématique motif Damier de Louis Vuitton. Un cadeau idéal pour vous garder au chaud pendant l\'hiver.', 'louis-vuitton-bonnet-nm-petit-damier-s00-chapeaux-et-gants--M70606_PM2_Front view.png-626962797327c.jpg', 25, 'Gris', 49, 'louis-vuitton-bonnet-nm-petit-damier-s00-chapeaux-et-gants--M70606_PM1_Worn view.png-6269627973593.jpg', 'null', 'null', 'null', 'null'),
(155, 'GANTS EN PEAU DE MOUTON MONOGRAM', 'Inspirés par une veste de la collection de prêt-à-porter Automne-Hiver 2020, ces gants en shearling Monogram cultivent une esthétique classique. Sublimé par le motif Monogram emblématique méticuleusement découpé au laser, ce modèle illustre avec éloquence l\'expertise de la Maison. La garniture en shearling doux aux poignets apporte à l\'ensemble une finition somptueuse.', 'louis-vuitton-gants-en-peau-de-mouton-monogram-s00-chapeaux-et-gants--M76578_PM2_Front view.png-626962c43b073.jpg', 35, 'Marron', 49, 'null', 'null', 'null', 'null', 'null'),
(156, 'BOTTINE LV BOLD LV X NBA', 'Cette bottine LV Bold est réalisée en cuir de veau nubuck embossé Monogram avec une cheville matelassée en cuir de veau lisse. Cette édition spéciale est issue de la collection Louis Vuitton x NBA qui comprend des accessoires, et des pièces de maroquinerie et de prêt-à-porter. Ce soulier présente une étiquette NBA en gomme, ainsi que le logo NBA doré marqué à chaud sur la languette.', 'louis-vuitton-bottine-lv-bold-lv-x-nba-souliers--BLEQ1XNU02_PM2_Front view.png-626963f503da2.jpg', 230, 'Noir', 52, 'louis-vuitton-bottine-lv-bold-lv-x-nba-souliers--BLEQ1XNU02_PM1_Worn view.png-626963f5040ad.jpg', 'louis-vuitton-bottine-lv-bold-lv-x-nba-souliers--BLEQ1XNU02_PM1_Interior2 view.png-626963f504281.jpg', 'louis-vuitton-bottine-lv-bold-lv-x-nba-souliers--BLEQ1XNU02_PM1_Interior view.png-626963f504434.jpg', 'louis-vuitton-bottine-lv-bold-lv-x-nba-souliers--BLEQ1XNU02_PM1_Closeup view.png-626963f5045eb.jpg', 'null'),
(157, 'BOTTINE CHELSEA CHARONNE', 'Confectionnée en cuir de veau velours, cette bottine Chelsea Charonne propose une interprétation moderne d\'un modèle classique. Ce soulier épuré est doté d\'une boucle d\'enfilage en tissu signée Louis Vuitton et de motifs fleur de Monogram sur la semelle extérieure ultra-légère en micro.', 'louis-vuitton-bottine-chelsea-charonne-souliers--BMCQ1XSC31_PM2_Front view.png-6269646f8b518.jpg', 230, 'Beige', 52, 'louis-vuitton-bottine-chelsea-charonne-souliers--BMCQ1XSC31_PM1_Interior2 view.png-6269646f8b9a5.jpg', 'louis-vuitton-bottine-chelsea-charonne-souliers--BMCQ1XSC31_PM1_Interior view.png-6269646f8bc44.jpg', 'louis-vuitton-bottine-chelsea-charonne-souliers--BMCQ1XSC31_PM1_Detail view.png-6269646f8be09.jpg', 'louis-vuitton-bottine-chelsea-charonne-souliers--BMCQ1XSC31_PM1_Closeup view.png-6269646f8bf51.jpg', 'null'),
(159, 'BLOUSON AVIATEUR EN CUIR LVSE', 'Ce blouson aviateur de la collection Staples Edition est à la fois sportif et sophistiqué. Réalisé en daim lisse certifié LWG, il possède un col amovible en shearling et une languette en cuir inspirée des techniques traditionnelles de maroquinerie de la Maison. Des poignets côtelés et un ourlet muni d\'un cordon de serrage apparent lui confèrent un style ajusté confortable. Des agrafes gravées et une étiquette LVSE amovible signent la pièce.', 'louis-vuitton-blouson-aviateur-en-cuir-lvse-prêt-à-porter--HJL45WYBJ023_PM2_Front view.png-6269656d58ebb.jpg', 580, 'Gris', 53, 'louis-vuitton-blouson-aviateur-en-cuir-lvse-prêt-à-porter--HJL45WYBJ023_PM1_Worn view-6269656d5920a.jpg', 'louis-vuitton-blouson-aviateur-en-cuir-lvse-prêt-à-porter--HJL45WYBJ023_PM1_Side view-6269656d59419.jpg', 'louis-vuitton-blouson-aviateur-en-cuir-lvse-prêt-à-porter--HJL45WYBJ023_PM1_Detail view-6269656d59524.jpg', 'louis-vuitton-blouson-aviateur-en-cuir-lvse-prêt-à-porter--HJL45WYBJ023_PM1_Closeup view-6269656d59609.jpg', 'null'),
(160, 'CHEMISE À COL DNA COUPE STANDARD', 'Cette chemise est signée du motif exclusif LV Mosaic, réinterprété en fil coupé sur un tissu de coton rayé. Déclinée dans une coupe standard, elle présente le col à pointes raccourcies distinctif de la Maison. Des surpiqûres LV ton sur ton apportent un dernier accent caractéristique sur son bouton supérieur en nacre.', 'louis-vuitton-chemise-à-col-dna-coupe-standard-prêt-à-porter--HLS51WDO9001_PM2_Front view.png-62696611c1cfd.jpg', 39, 'blanc', 54, 'louis-vuitton-chemise-à-col-dna-coupe-standard-prêt-à-porter--HLS51WDO9001_PM1_Side view-62696611c2002.jpg', 'louis-vuitton-chemise-à-col-dna-coupe-standard-prêt-à-porter--HLS51WDO9001_PM1_Worn view-62696611c2186.jpg', 'louis-vuitton-chemise-à-col-dna-coupe-standard-prêt-à-porter--HLS51WDO9001_PM1_Detail view-62696611c232b.jpg', 'louis-vuitton-chemise-à-col-dna-coupe-standard-prêt-à-porter--HLS51WDO9001_PM1_Closeup view-62696611c2486.jpg', 'null'),
(161, 'CHEMISE LETTERS TON SUR TON', 'Cette chemise célèbre le thème LV Letters de la collection avec des lettres continues recréées dans un motif jacquard tissé. Confectionnée dans une coupe standard en popeline de coton, cette pièce est plus longue à l\'arrière qu\'à l\'avant. Louis Vuitton s\'engage à améliorer les pratiques de culture du coton dans le monde avec le coton labellisé BCI (Better Cotton Initiative).', 'louis-vuitton-chemise-letters-ton-sur-ton-prêt-à-porter--HLS17WET5900_PM2_Front view.png-626966662cc6a.jpg', 39, 'Noir', 54, 'louis-vuitton-chemise-letters-ton-sur-ton-prêt-à-porter--HLS17WET5900_PM1_Worn view-626966662ce85.jpg', 'louis-vuitton-chemise-letters-ton-sur-ton-prêt-à-porter--HLS17WET5900_PM1_Side view-626966662cf8c.jpg', 'louis-vuitton-chemise-letters-ton-sur-ton-prêt-à-porter--HLS17WET5900_PM1_Detail view-626966662d084.jpg', 'louis-vuitton-chemise-letters-ton-sur-ton-prêt-à-porter--HLS17WET5900_PM1_Closeup view-626966662d18d.jpg', 'null'),
(162, 'TEE-SHIRT MONOGRAM GRADIENT LVSE', 'Ce tee-shirt revisite le motif Monogram dégradé du défilé Automne-Hiver 2020-2021, qui est imprimé de façon numérique avec un effet pixelisé. Réalisé en jersey de coton léger dans une coupe standard, ce modèle est sublimé d\'une agrafe en palladium gravée sur le côté gauche et d\'une encolure à bord-côtes texturés.', 'louis-vuitton-tee-shirt-monogram-gradient-lvse-prêt-à-porter--HKY46WNPG904_PM2_Front view.png-6269671ccf7e3.jpg', 19, 'Noir', 55, 'louis-vuitton-tee-shirt-monogram-gradient-lvse-prêt-à-porter--HKY46WNPG904_PM1_Worn view-6269671ccfc0e.jpg', 'louis-vuitton-tee-shirt-monogram-gradient-lvse-prêt-à-porter--HKY46WNPG904_PM1_Closeup view-6269671ccfe8a.jpg', 'null', 'null', 'null'),
(163, 'TEE-SHIRT À POCHE HALF DAMIER LVSE', 'Ce tee-shirt remarquable offre une interprétation contrastée du motif Damier de la collection. Réalisé en piqué de coton léger, il présente une moitié ornée du motif Damier emblématique, tandis que l\'autre unie décline la même signature sur une poche. Ce modèle de coupe standard est disponible dans le coloris vert de la saison.', 'louis-vuitton-tee-shirt-à-poche-half-damier-lvse-prêt-à-porter--HJY40WVHI325_PM2_Front view.png-62696766b0844.jpg', 19, 'vert', 55, 'louis-vuitton-tee-shirt-à-poche-half-damier-lvse-prêt-à-porter--HJY40WVHI325_PM1_Worn view-62696766b0b62.jpg', 'louis-vuitton-tee-shirt-à-poche-half-damier-lvse-prêt-à-porter--HJY40WVHI325_PM1_Side view-62696766b0d1f.jpg', 'louis-vuitton-tee-shirt-à-poche-half-damier-lvse-prêt-à-porter--HJY40WVHI325_PM1_Detail view-62696766b0e17.jpg', 'louis-vuitton-tee-shirt-à-poche-half-damier-lvse-prêt-à-porter--HJY40WVHI325_PM1_Closeup view-62696766b0f9d.jpg', 'null'),
(164, 'MAILLOT DE FOOTBALL AMÉRICAIN ÉPAIS EN INTARSIA', 'Le motif sportif de ce tee-shirt en maille épaisse évoque l\'esthétique du football américain. Ce modèle à col en V de coupe légèrement ample est confectionné avec des fils de laine mélangés. La signature Vuitton se décline en intarsia à l\'avant et au dos, tandis que des poignets et un ourlet côtelés complètent l\'ensemble.', 'louis-vuitton-maillot-de-football-américain-épais-en-intarsia-prêt-à-porter--HMN66WJYB900_PM2_Front view.png-62696888a7194.jpg', 25, 'rouge', 55, 'louis-vuitton-maillot-de-football-américain-épais-en-intarsia-prêt-à-porter--HMN66WJYB900_PM1_Worn view-62696888a7531.jpg', 'louis-vuitton-maillot-de-football-américain-épais-en-intarsia-prêt-à-porter--HMN66WJYB900_PM1_Side view-62696888a774d.jpg', 'louis-vuitton-maillot-de-football-américain-épais-en-intarsia-prêt-à-porter--HMN66WJYB900_PM1_Detail view-62696888a788e.jpg', 'louis-vuitton-maillot-de-football-américain-épais-en-intarsia-prêt-à-porter--HMN66WJYB900_PM1_Closeup view-62696888a7a1d.jpg', 'null'),
(166, 'PANTALON DE JOGGING LOUIS VUITTON', 'Ce pantalon de jogging revisite une coupe classique avec une signature moderne de Louis Vuitton sérigraphiée sur la jambe droite. Cette pièce de coupe standard est confectionnée en molleton jersey de coton brossé. Des poches latérales, une poche plaquée à l\'arrière, des chevilles côtelées et une ceinture en maille munie d\'un cordon ajustable complètent le modèle.', 'louis-vuitton-pantalon-de-jogging-louis-vuitton-prêt-à-porter--HLY69WUYR743_PM2_Front view.png-62696a22b6a03.jpg', 89, 'Gris', 56, 'louis-vuitton-pantalon-de-jogging-louis-vuitton-prêt-à-porter--HLY69WUYR743_PM1_Worn view-62696a22b6dd2.jpg', 'louis-vuitton-pantalon-de-jogging-louis-vuitton-prêt-à-porter--HLY69WUYR743_PM1_Side view-62696a22b6f77.jpg', 'louis-vuitton-pantalon-de-jogging-louis-vuitton-prêt-à-porter--HLY69WUYR743_PM1_Detail view-62696a22b7148.jpg', 'louis-vuitton-pantalon-de-jogging-louis-vuitton-prêt-à-porter--HLY69WUYR743_PM1_Closeup view-62696a22b7312.jpg', 'null'),
(167, 'PANTALON DE COSTUME DAMIER', 'Ce pantalon de costume est composé de laine issue de source responsable. Habillé du motif Damier revisité de la collection, il présente une signature Louis Vuitton sur la jambe droite. Ce modèle de coupe droite sans coutures sur les côtés comprend des poches latérales et deux poches à l\'arrière dotées de fermetures à boutons dissimulées.', 'louis-vuitton-pantalon-de-costume-damier-prêt-à-porter--HMP01WHE8618_PM2_Front view.png-6269cd2d2e5b0.jpg', 59, 'Noir', 56, 'louis-vuitton-pantalon-de-costume-damier-prêt-à-porter--HMP01WHE8618_PM1_Worn view-6269cd2d2e883.jpg', 'louis-vuitton-pantalon-de-costume-damier-prêt-à-porter--HMP01WHE8618_PM1_Side view-6269cd2d2eabe.jpg', 'louis-vuitton-pantalon-de-costume-damier-prêt-à-porter--HMP01WHE8618_PM1_Detail view-6269cd2d2eb97.jpg', 'louis-vuitton-pantalon-de-costume-damier-prêt-à-porter--HMP01WHE8618_PM1_Closeup view-6269cd2d2ec57.jpg', 'null'),
(168, 'VESTE À CAPUCHE MATELASSÉE LVSE', 'Pièce emblématique de la collection Staples Edition, cette veste à capuche légère revêt un motif fleurs de Monogram matelassé. Déclinée dans un bleu saisonnier, cette version revisitée en tissu technique recyclé brillant présente deux poches à fermeture à glissière sur le devant. Parmi ses finitions, le modèle comporte une agrafe gravée à l\'arrière et un mousqueton amovible avec une carte Louis Vuitton Staples Edition ton sur ton.', 'louis-vuitton-veste-à-capuche-matelassée-lvse-prêt-à-porter--HMB47WDH1645_PM2_Front view.png-6269cdd747bd2.jpg', 290, 'bleu', 53, 'louis-vuitton-veste-à-capuche-matelassée-lvse-prêt-à-porter--HMB47WDH1645_PM1_Worn view-6269cdd747f2e.jpg', 'louis-vuitton-veste-à-capuche-matelassée-lvse-prêt-à-porter--HMB47WDH1645_PM1_Side view-6269cdd7480e1.jpg', 'louis-vuitton-veste-à-capuche-matelassée-lvse-prêt-à-porter--HMB47WDH1645_PM1_Detail view-6269cdd7482a5.jpg', 'louis-vuitton-veste-à-capuche-matelassée-lvse-prêt-à-porter--HMB47WDH1645_PM1_Closeup view-6269cdd748459.jpg', 'null'),
(169, 'PARFUM IMAGINATION', 'L’imagination. Elle est la clé de toutes les audaces, de tous les succès, le moteur des créatifs qui donnent vie aux rêves les plus fous. Une énergie immatérielle qui se nourrit du voyage, de ces expériences qui forgent un nouvel état d’esprit. Elle guide depuis toujours le travail de Jacques Cavallier Belletrud.\r\nÀ travers une surdose d’Ambrox, véritable or blanc de la parfumerie, le Maître Parfumeur réinvente l’accord ambré pour exprimer une masculinité sensuelle et contemporaine.\r\nLes contrastes se déploient au contact des agrumes les plus nobles et du thé noir de Chine extrait au Co2, une matière magique qui porte en elle l’âme du voyage. Avec Imagination, l’esprit s’élève, s’évade, pour parcourir et conquérir les chemins de la liberté.\r\nLe flacon peut être rechargé dans les magasins disposant d\'une fontaine à parfums.', 'louis-vuitton-parfum-imagination-tous-les-parfums--LP0219_PM2_Front view.png-6269ce8926586.jpg', 70, 'bleu', 57, 'louis-vuitton-parfum-imagination-tous-les-parfums--LP0219_PM1_Side view.png-6269ce89268cd.jpg', 'louis-vuitton-parfum-imagination-tous-les-parfums--LP0219_PM1_Interior view.png-6269ce8926af3.jpg', 'louis-vuitton-parfum-imagination-tous-les-parfums--LP0219_PM1_Detail view.png-6269ce8926c73.jpg', 'louis-vuitton-parfum-imagination-tous-les-parfums--LP0219_PM1_Ambiance view.png-6269ce8926d4a.jpg', 'null'),
(170, 'PARFUM ORAGE', 'À la fois magique et effrayant, le lien entre l\'orage et le ciel évoque l\'union de l\'homme avec la terre. Il fait résonner le sacré au plus profond de soi. À partir de ce lien avec la nature sauvage, le maître-parfumeur Jacques Cavallier Belletrud a créé un parfum boisé surprenant. Pour exprimer le paradoxe entre la fragilité de l\'humanité et la force brute des éléments, Orage mêle la noblesse de l\'iris à la fraîcheur végétale du vétiver et à un cœur de feuilles de patchouli. Majestueux, le patchouli attire l\'attention, aussi lumineux qu\'un éclair. Soudain, on n\'a plus qu\'une seule envie : se pencher de plus près pour en inspirer chaque note.\r\nLe flacon est rechargeable dans les magasins disposant d\'une fontaine à parfum.', 'louis-vuitton-parfum-orage-tous-les-parfums--LP0051_PM2_Front view.png-6269cee937826.jpg', 70, 'jaune', 57, 'louis-vuitton-parfum-orage-tous-les-parfums--LP0051_PM1_Side view.png-6269cee937992.jpg', 'louis-vuitton-parfum-orage-tous-les-parfums--LP0051_PM1_Other view2.png-6269cee937a77.jpg', 'louis-vuitton-parfum-orage-tous-les-parfums--LP0051_PM1_Interior view.png-6269cee937b58.jpg', 'null', 'null'),
(171, 'PARFUM OMBRE NOMADE', 'Au fil du jour, la course du soleil dessine des motifs changeants d’ombre et de lumière sur les dunes. Alors que tout semble immobile, le désert s’anime et plonge le voyageur dans une odyssée intense. Conçu pour les amateurs d’essences rares, Ombre Nomade concentre cette sensation d’infini dans un des ingrédients les plus mythiques de la parfumerie : le bois de oud. Une matière insoumise, ivre de beauté, que le maître-parfumeur Jacques Cavallier Belletrud a facetté d’un soupçon de benjoin et d’accents de framboise. Au loin, une fumée d’encens s’élève vers les cieux. Jamais l\'oud n’avait été aussi mystique.\r\nLe flacon est rechargeable dans les magasins équipés d\'une fontaine à parfum.', 'louis-vuitton-parfum-ombre-nomade-parfums--LP0095_PM2_Front view.png-6269cf5961872.jpg', 70, 'Noir', 57, 'louis-vuitton-parfum-ombre-nomade-parfums--LP0095_PM1_Side view.png-6269cf5961bda.jpg', 'louis-vuitton-parfum-ombre-nomade-parfums--LP0095_PM1_Other view2.png-6269cf5961e59.jpg', 'louis-vuitton-parfum-ombre-nomade-parfums--LP0095_PM1_Interior view.png-6269cf5962025.jpg', 'null', 'null'),
(172, 'MONTRE CHRONOGRAPHE TAMBOUR OUTDOOR', 'Conçu pour l\'exploration et l\'aventure, ce chronographe Tambour Outdoor allie un design robuste et des fonctionnalités de pointe aux codes de la montre de luxe. Sportif et raffiné, le modèle Nautical Steel présente un boîtier en acier poli, un cadran bleu sablé et un bracelet en gomme emblématique. Les nuances contrastées sur les compteurs et le cadran assurent une lisibilité optimale à cette montre de voyage masculine.', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB194_PM2_Front view.png-6269d050691f8.jpg', 175, 'bleu', 59, 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB194_PM1_Worn view.png-6269d050693db.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB194_PM1_Side view.png-6269d05069518.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB194_PM1_Interior view.png-6269d05069635.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB194_PM1_Detail view.png-6269d05069757.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB194_PM1_Ambiance view.png-6269d05069836.jpg'),
(173, 'MONTRE CHRONOGRAPHE TAMBOUR OUTDOOR', 'Cette montre chronographe Tambour Outdoor incarne l\'art du voyage cher à la Maison dans un esprit contemporain et sportif. Idéal pour partir en exploration, le modèle Urban Jungle allie les fonctions GMT et chronographe dans une pièce somptueuse à l\'allure citadine actuelle. Le cadran vert sablé présente des compteurs bicolores et des accents de couleur vive assurant une lisibilité optimale. Un bracelet en gomme emblématique complète cette montre.', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB195_PM2_Front view.png-6269d0966c948.jpg', 175, 'Noir', 59, 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB195_PM1_Worn view.png-6269d0966ccd0.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB195_PM1_Side view.png-6269d0966ce93.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB195_PM1_Interior view.png-6269d0966d0ea.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB195_PM1_Detail view.png-6269d0966d209.jpg', 'louis-vuitton-montre-chronographe-tambour-outdoor-horlogerie-et-joaillerie--QBB195_PM1_Ambiance view.png-6269d0966d39a.jpg'),
(174, 'MONTRE ESCALE SPIN TIME', 'Cette montre Escale Spin Time offre un système d\'affichage novateur qui change de look toutes les heures. Développé par la Maison, ce mouvement unique composé de 12 cubes pivotants présente 24 chiffres et 24 drapeaux colorés peints à la main, en hommage aux malles personnalisées Louis Vuitton. Ponctué des teintes de l\'arc-en-ciel, le cadran soleillé noir prête un esprit ludique à cette pièce raffinée.', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG20_PM2_Front view.png-6269d0e40388c.jpg', 255, 'Noir', 59, 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG20_PM1_Worn view.png-6269d0e403bca.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG20_PM1_Side view.png-6269d0e403d6b.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG20_PM1_Interior view.png-6269d0e403f4c.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG20_PM1_Detail view.png-6269d0e4040db.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG20_PM1_Ambiance view.png-6269d0e40427f.jpg'),
(175, 'MONTRE ESCALE SPIN TIME', 'Cette montre Escale Spin Time propose un mouvement unique développé par la Maison. Les 12 cubes pivotants offrent un système d\'affichage qui change de look toutes les heures : 24 facettes affichent les chiffres tandis que les 24 autres présentent des drapeaux ton sur ton peints à la main, en référence aux malles personnalisées Louis Vuitton. Sublimée d\'un cadran soleillé en ruthénium, cette pièce contemporaine se prêtera aux escapades citadines.', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG10_PM2_Front view.png-6269d151169b5.jpg', 1500, 'Noir', 59, 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG10_PM1_Worn view.png-6269d15116b64.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG10_PM1_Side view.png-6269d15116c91.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG10_PM1_Interior view.png-6269d15116da7.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG10_PM1_Detail view.png-6269d15116ed5.jpg', 'louis-vuitton-montre-escale-spin-time-horlogerie-et-joaillerie--Q5DG10_PM1_Ambiance view.png-6269d15116fad.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grd_cat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `titre`, `grd_cat`, `sexe`) VALUES
(41, 'Sacs Business', 'Sacs', 'Homme'),
(42, 'Sacs à dos', 'Sacs', 'Homme'),
(43, 'Sacs bandoulière', 'Sacs', 'Homme'),
(44, 'Portefeuilles longs', 'Portefeuilles', 'Homme'),
(45, 'Portefeuilles compacts', 'Portefeuilles', 'Homme'),
(46, 'Pochettes', 'Portefeuilles', 'Homme'),
(47, 'Ceintures', 'Accessoires', 'Homme'),
(48, 'Écharpes', 'Accessoires', 'Homme'),
(49, 'Chapeaux et gants', 'Accessoires', 'Homme'),
(50, 'Sneakers', 'Souliers', 'Homme'),
(51, 'Mocassins', 'Souliers', 'Homme'),
(52, 'Bottes et bottines', 'Souliers', 'Homme'),
(53, 'Manteaux et blousons', 'Prêt-à-porter', 'Homme'),
(54, 'Chemises', 'Prêt-à-porter', 'Homme'),
(55, 'Tee-shirts et polos', 'Prêt-à-porter', 'Homme'),
(56, 'Pantalons', 'Prêt-à-porter', 'Homme'),
(57, 'Parfums', 'Parfums', 'Homme'),
(58, 'Bougies', 'Parfums', 'Homme'),
(59, 'Montres', 'Horlogerie et joaillerie', 'Homme'),
(60, 'Joaillerie', 'Horlogerie et joaillerie', 'Homme'),
(61, 'Bracelets de montres et accessoires', 'Horlogerie et joaillerie', 'Homme'),
(62, 'Sacs avec chaîne et pochettes', 'Sacs', 'Femme'),
(63, 'Sacs à dos et sacs ceinture', 'Sacs', 'Femme'),
(64, 'Sacs porté épaule', 'Sacs', 'Femme'),
(65, 'Cabas', 'Sacs', 'Femme'),
(66, 'Portefeuilles longs', 'Portefeuilles', 'Femme'),
(67, 'Portefeuilles compacts', 'Portefeuilles', 'Femme'),
(68, 'Portefeuilles avec chaîne et bandoulière', 'Portefeuilles', 'Femme'),
(69, 'Châles et écharpes', 'Accessoires', 'Femme'),
(70, 'Carrés de soie et bandeaux', 'Accessoires', 'Femme'),
(71, 'Bijoux', 'Accessoires', 'Femme'),
(72, 'Ceintures', 'Accessoires', 'Femme'),
(73, 'Lunettes de soleil', 'Accessoires', 'Femme'),
(74, 'Lunettes de soleil', 'Accessoires', 'Homme'),
(75, 'Chapeaux et gants', 'Accessoires', 'Femme'),
(76, 'Bottines et bottes', 'Souliers', 'Femme'),
(77, 'Sneakers', 'Souliers', 'Femme'),
(78, 'Escarpins', 'Souliers', 'Femme'),
(79, 'Mules', 'Souliers', 'Femme'),
(80, 'Manteaux et vestes', 'Prêt-à-porter', 'Femme'),
(81, 'Robes', 'Prêt-à-porter', 'Femme'),
(82, 'Hauts', 'Prêt-à-porter', 'Femme'),
(83, 'Pantalons', 'Prêt-à-porter', 'Femme'),
(84, 'Jupes et shorts', 'Prêt-à-porter', 'Femme'),
(85, 'Parfums', 'Parfums', 'Femme'),
(86, 'Bougies', 'Parfums', 'Femme'),
(87, 'Bagues', 'Horlogerie et joaillerie', 'Femme'),
(88, 'Boucles d\'oreilles', 'Horlogerie et joaillerie', 'Femme'),
(89, 'Colliers et pendentifs', 'Horlogerie et joaillerie', 'Femme'),
(90, 'Bracelets', 'Horlogerie et joaillerie', 'Femme'),
(91, 'Montres', 'Horlogerie et joaillerie', 'Femme'),
(92, 'Bracelets de montres et accessoires', 'Horlogerie et joaillerie', 'Femme'),
(93, 'Talons', 'Souliers', 'Femme');

-- --------------------------------------------------------

--
-- Structure de la table `code_promo`
--

CREATE TABLE `code_promo` (
  `id` int(11) NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `code_promo`
--

INSERT INTO `code_promo` (`id`, `code`, `promo`) VALUES
(1, 'AMEL50', 50),
(3, 'AMEL20', 20),
(4, 'AMEL25', 25);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `montant` double NOT NULL,
  `date` datetime NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `montant`, `date`, `etat`, `user_id`) VALUES
(46, 187.5, '2022-04-27 23:52:15', 'Livrée', 21),
(47, 120, '2022-04-28 14:47:13', 'En cours de traitement', 21),
(48, 50, '2022-04-28 14:48:15', 'En cours de traitement', 21),
(49, 52.5, '2022-04-28 14:48:59', 'En cours de traitement', 21),
(50, 750, '2022-05-11 15:17:31', 'En cours de traitement', 35);

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

CREATE TABLE `detail_commande` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `taille_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_commande`
--

INSERT INTO `detail_commande` (`id`, `quantite`, `prix`, `article_id`, `commande_id`, `taille_id`) VALUES
(38, 1, 120, 132, 46, 103),
(39, 1, 255, 174, 46, 246),
(40, 1, 120, 132, 47, 96),
(41, 2, 25, 141, 48, 153),
(42, 1, 105, 150, 49, 162),
(43, 1, 1500, 175, 50, 247);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211215095027', '2021-12-15 09:50:52', 48),
('DoctrineMigrations\\Version20211215125541', '2021-12-15 13:11:49', 80);

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

CREATE TABLE `taille` (
  `id` int(11) NOT NULL,
  `titre` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`id`, `titre`, `stock`, `article_id`) VALUES
(96, '37', 8, 132),
(97, '38', 17, 132),
(98, '39', 188, 132),
(99, '40', 19, 132),
(100, '41', 29, 132),
(101, '42', 809, 132),
(102, '43', 67, 132),
(103, '44', 44, 132),
(104, '45', 100, 132),
(105, '37', 89, 133),
(106, '38', 76, 133),
(107, '39', 43, 133),
(108, '40', 98, 133),
(109, '41', 56, 133),
(110, '42', 0, 133),
(111, '43', 2, 133),
(112, '44', 5, 133),
(113, '45', 0, 133),
(114, '37', 100, 134),
(115, '38', 69, 134),
(116, '39', 0, 134),
(117, '40', 6, 134),
(118, '41', 4, 134),
(119, '42', 78, 134),
(120, '43', 32, 134),
(121, '44', 3, 134),
(122, '45', 23, 134),
(123, '37', 11, 135),
(124, '38', 12, 135),
(125, '39', 9, 135),
(126, '40', 0, 135),
(127, '41', 0, 135),
(128, '42', 77, 135),
(129, '43', 69, 135),
(130, '44', 90, 135),
(131, '45', 2, 135),
(132, '37', 100, 136),
(133, '38', 20, 136),
(134, '39', 10, 136),
(135, '40', 1, 136),
(136, '41', 0, 136),
(137, '42', 45, 136),
(138, '43', 0, 136),
(139, '44', 98, 136),
(140, '45', 8, 136),
(141, '37', 25, 137),
(142, '38', 97, 137),
(143, '39', 255, 137),
(144, '40', 68, 137),
(145, '41', 678, 137),
(146, '42', 0, 137),
(147, '43', 67, 137),
(148, '44', 87, 137),
(149, '45', 45, 137),
(150, 'Unique', 1, 138),
(151, 'Unique', 100, 139),
(152, 'Unique', 67, 140),
(153, 'Unique', 87, 141),
(154, 'Unique', 34, 142),
(155, 'Unique', 54, 143),
(156, 'Unique', 2, 144),
(157, 'Unique', 3, 145),
(158, 'Unique', 0, 146),
(159, 'Unique', 19, 147),
(160, 'Unique', 90, 148),
(161, 'Unique', 687, 149),
(162, 'Unique', 10, 150),
(163, 'Unique', 1000, 151),
(164, 'Unique', 11, 152),
(165, 'Unique', 2, 153),
(166, 'Unique', 654, 154),
(167, 'Unique', 889, 155),
(168, '37', 897, 156),
(169, '38', 6, 156),
(170, '39', 2, 156),
(171, '40', 0, 156),
(172, '41', 0, 156),
(173, '42', 2, 156),
(174, '43', 4, 156),
(175, '44', 5, 156),
(176, '45', 6, 156),
(177, '37', 1, 157),
(178, '38', 5, 157),
(179, '39', 10, 157),
(180, '40', 11, 157),
(181, '41', 0, 157),
(182, '42', 290, 157),
(183, '43', 68, 157),
(184, '44', 42, 157),
(185, '45', 41, 157),
(191, 'XS', 90, 159),
(192, 'S', 67, 159),
(193, 'M', 0, 159),
(194, 'L', 16, 159),
(195, 'XL', 1, 159),
(196, 'XS', 2, 160),
(197, 'S', 90, 160),
(198, 'M', 78, 160),
(199, 'L', 0, 160),
(200, 'XL', 25, 160),
(201, 'XS', 677, 161),
(202, 'S', 99, 161),
(203, 'M', 1, 161),
(204, 'L', 80, 161),
(205, 'XL', 0, 161),
(206, 'XS', 0, 162),
(207, 'S', 2, 162),
(208, 'M', 5, 162),
(209, 'L', 78, 162),
(210, 'XL', 900, 162),
(211, 'XS', 2, 163),
(212, 'S', 679, 163),
(213, 'M', 65, 163),
(214, 'L', 0, 163),
(215, 'XL', 2, 163),
(216, 'XS', 890, 164),
(217, 'S', 453, 164),
(218, 'M', 675, 164),
(219, 'L', 865, 164),
(220, 'XL', 0, 164),
(226, 'XS', 20, 166),
(227, 'S', 2020, 166),
(228, 'M', 10, 166),
(229, 'L', 8, 166),
(230, 'XL', 10, 166),
(231, 'XS', 7, 167),
(232, 'S', 27, 167),
(233, 'M', 29, 167),
(234, 'L', 46, 167),
(235, 'XL', 3, 167),
(236, 'XS', 1, 168),
(237, 'S', 80, 168),
(238, 'M', 78, 168),
(239, 'L', 10, 168),
(240, 'XL', 2, 168),
(241, 'Unique', 20, 169),
(242, 'Unique', 28, 170),
(243, 'Unique', 28, 171),
(244, 'Unique', 18, 172),
(245, 'Unique', 14, 173),
(246, 'Unique', 10, 174),
(247, 'Unique', 4, 175);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `nom`, `prenom`, `sexe`, `telephone`, `adresse`, `ville`, `code_postal`) VALUES
(12, 'paul.buisson@laposte.net', '[]', 'f>i=:v!H+9FeiJ>kqI', 'dorothee50', 'Tessier', 'Émile', 'occaecati', 532546562, '63, chemin Victor Riviere', 'Charpentierdan', 48819),
(15, 'dorothee.richard@hotmail.fr', '[\"ROLE_ADMIN\"]', ':0b<\'LfX,U', 'Legros.alain', 'Legros', 'Alain', 'sit', 772690879, '99, place de Aubert', 'PierreBourg', 42644),
(16, 'osanchez@voila.fr', '[]', '4zjhd[CB(wtT8H8n', 'rlemoine', 'Blanchet', 'Victoire', 'optio', 623836579, '3, impasse de Leblanc', 'Auger-sur-Adam', 95416),
(18, 'iblondel@free.fr', '[]', 'zXL]Wsq&4D$`C\\Q=Tn', 'emile.guillou', 'Toussaint', 'Patrick', 'perspiciatis', 211995093, 'place Pages', 'Millet-sur-Mer', 26920),
(19, 'gabriel45@sfr.fr', '[\"ROLE_ADMIN\"]', 'b)Dpj=|p', 'aubry.philippine', 'Thomas', 'Constance', 'quod', 330127342, '48, boulevard Normand', 'Perrot', 80451),
(20, 'garcia.charlotte@sfr.fr', '[\"ROLE_ADMIN\"]', 'UP54!MKQ<\\T1%Gi]W@', 'lamy.margot', 'De Sousa', 'Josette', 'neque', 475672428, 'rue Stéphane Delmas', 'Guichard', 69226),
(21, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$88NqD4bx4rpySfGuObJmruiQpzjnE35aVyvGvpYQySNBbVFN9Kr6a', 'admin', 'Theo', 'Aburame', 'Homme', 202020202, 'admin', 'Mantes', 78300),
(22, 'admin78@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$PgMZr4uVrWZ/l6MdnR3XO.fDr/t2zgGSO8gYfZ5Bbj/8HgXWtAoje', 'admin78', 'Admin2', 'Admin2', 'Femme', 123456789, 'adminnn', 'adminnn', 12345),
(23, 'yassir@gmail.com', '[]', '$2y$13$OBZrRXiaMdIxH68y.30AT.XJjeO/uw0kvkVLYS4I6aO5sbPBqltNy', 'yassir78', 'Uchiwa', 'Itachi', 'Homme', 102030405, '2 rue des oiseaux', 'Poissy', 78300),
(24, 'yassir67@gmail.com', '[]', '$2y$13$XEZXn5Osm7RSPL0x/rluM.GTki8pzXKq3vpI0sRVjV18R2oYfpv8a', 'yassir783', 'hgdhgh', 'jsbx', 'Homme', 666666666, 'gdadg. des oliviers', 'Poissy', 78654),
(25, 'miaou78@gmail.com', '[]', '$2y$13$EOiTYLFqTYT4pmL.OWvFL.0SH9a.L.ABdx1m2maM04pDVWHIvkgvi', 'miaou.miaou', 'MIAOU', 'Miaou', 'Homme', 678787878, '5667 rue de la porte', 'izi', 78377),
(26, 'test1@gmail.com', '[]', '$2y$13$F2ZdYY07WG1IdREOcL.qH.HrOrRHj57LTI3PIkj56sJ7EoRE16Ccy', 'test1', 'untest', 'ceciest', 'Femme', 111111111, '10 des rue de Pierre', 'Mureaux', 78300),
(27, 'chiesa@gmail.com', '[]', '$2y$13$wAN8q58ib.V9lY4sphw83.VbfStXEWlWl4lZ.ediXvSwXyyRKVJAG', 'chiesa7', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 78654),
(28, 'chiesa2@gmail.com', '[\"\"]', '$2y$13$UlkaBwQ6nn3hGXTjVTKSxOQeF4F26a7JtBaU6ZEUbX73Opl8qfzOa', 'chiesa7', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 78654),
(29, 'nihjhjeduh@nndnejcom', '[]', '$2y$13$e7EoOA3OwjnQtJKI.cAXLO8/ws43sFAk8EAho1Zd2HSA5zLOIwSWO', 'bv hv vhbjh', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 786543),
(30, 'nihjhjeduh@nndjjjjjnejcom', '[]', '$2y$13$Dh6f/ZllWDf7aocHMMgqLuw.j0lx4HfFqxSNfRLgMZfrkFY44elN.', 'bv hv v, bjbhbjh', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 786543),
(31, 'niedhghguh@nndnejcom', '[]', '$2y$13$ztZ9aVbUpMBuGWhluhA3LeYrrYHWnE/m53RILzzWnBPNr2/EPZ5OO', 'jouou', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 786543),
(32, 'niedkoukouuh@nndnej.comi', '[]', '$2y$13$WtkdgsdRfwt/VLlbv5kPVuiZUsOgf.2RjXOZYQdfDyDj9.xVRimTS', 'kouikoui', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 78654),
(33, 'niedjsjsuh@nndnej.com', '[]', '$2y$13$K/zSSltQOe5BoyBAB7kkk.1ZQHml2JmX0uQO1Ck7iXFpe/QdF2BEK', 'jszjsj', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 78654),
(34, 'miaaaaaou@gmail.com', '[]', '$2y$13$wIRZP2IsciEK79eY5jWPhOxv2BSJfqQ2Z9xbC1YTVboGF39PhzsWW', 'miaaaaaaou', 'hgdhgh', 'jsbx', 'Homme', 897867564, 'gdadg. des oliviers', 'Poissy', 78654),
(35, 'ansufati@gmail.com', '[]', '$2y$13$3890tYXEsVTY8dfr4okjGe5dGrsN3oQnbqnqYJSORhfMyRhlmATSy', 'fati10', 'Ansu', 'Fati', 'Homme', 798976345, '10 rue de barcelone', 'Quebec', 67890);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E6612469DE2` (`category_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `code_promo`
--
ALTER TABLE `code_promo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5C4683B777153098` (`code`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67DA76ED395` (`user_id`);

--
-- Index pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_98344FA67294869C` (`article_id`),
  ADD KEY `IDX_98344FA682EA2E54` (`commande_id`),
  ADD KEY `IDX_98344FA6FF25611A` (`taille_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `taille`
--
ALTER TABLE `taille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_76508B387294869C` (`article_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `code_promo`
--
ALTER TABLE `code_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `taille`
--
ALTER TABLE `taille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `FK_98344FA67294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_98344FA682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_98344FA6FF25611A` FOREIGN KEY (`taille_id`) REFERENCES `taille` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `taille`
--
ALTER TABLE `taille`
  ADD CONSTRAINT `FK_76508B387294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
