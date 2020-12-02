-- MySQL dump 10.17  Distrib 10.3.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: testsf
-- ------------------------------------------------------
-- Server version	10.3.15-MariaDB-1:10.3.15+maria~jessie-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `change_log`
--

DROP TABLE IF EXISTS `change_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `change_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) DEFAULT NULL COMMENT 'ID de l''entité',
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Action sur l''entité à répercuter dans l''index',
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nom de l''entité sur laquelle porte l''action à répercuter.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `del_update_notfications`
--

DROP TABLE IF EXISTS `del_update_notfications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `del_update_notfications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurrence_id` int(11) DEFAULT NULL,
  `identiplante_score` int(11) DEFAULT NULL COMMENT 'Nouveau score de l''observation sur identiplante',
  `is_identiplante_validated` tinyint(1) NOT NULL COMMENT 'Statut validé (ou non) de l''observation sur identiplante',
  `date_updated` datetime DEFAULT NULL COMMENT 'Date de dernière modification',
  PRIMARY KEY (`id`),
  KEY `IDX_6C07859630572FAC` (`occurrence_id`),
  CONSTRAINT `FK_6C07859630572FAC` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `extended_field`
--

DROP TABLE IF EXISTS `extended_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extended_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `field_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_type` enum('Booléen','Texte','Date','Entier','Décimal') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type de champ - Texte, Entier, Décimal, Date, Booléen(DC2Type:fielddatatypeenum)',
  `is_visible` tinyint(1) NOT NULL COMMENT 'Champ invisible de l''utilisateur mais nécessaire au projet\n     ',
  `is_mandatory` tinyint(1) NOT NULL COMMENT 'Indique si le champ est obligatoire pour envoyer la donnée ou non',
  `min_value` decimal(10,0) DEFAULT NULL,
  `miax_value` decimal(10,0) DEFAULT NULL,
  `regexp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Format de la valeur (ex adresse mail, numéro de tel)',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unité',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_fieldid_project` (`field_id`,`project`),
  KEY `IDX_76A19DBE166D1F9C` (`project_id`),
  CONSTRAINT `FK_76A19DBE166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `tb_project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Champs étendus';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `extended_field_occurrence`
--

DROP TABLE IF EXISTS `extended_field_occurrence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extended_field_occurrence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurrence_id` int(11) NOT NULL,
  `extended_field_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Valeur renseignée par l''utilisateur',
  PRIMARY KEY (`id`),
  KEY `IDX_7DFE29EF30572FAC` (`occurrence_id`),
  KEY `IDX_7DFE29EFCCBF7175` (`extended_field_id`),
  CONSTRAINT `FK_7DFE29EF30572FAC` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`),
  CONSTRAINT `FK_7DFE29EFCCBF7175` FOREIGN KEY (`extended_field_id`) REFERENCES `extended_field` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `extendedfield_translation`
--

DROP TABLE IF EXISTS `extendedfield_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extendedfield_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extended_field_id` int(11) DEFAULT NULL,
  `project` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Intitulé',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Description du champ',
  `default_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Valeur par défaut',
  `error_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Message d''erreur',
  `language_iso_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Code iso de la langue',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_fild_project_language` (`extended_field_id`,`project`,`language_iso_code`),
  KEY `IDX_169442A8CCBF7175` (`extended_field_id`),
  CONSTRAINT `FK_169442A8CCBF7175` FOREIGN KEY (`extended_field_id`) REFERENCES `extended_field` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Contient le label et les valeurs par défaut d''un champ supplémentaire.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `occurrence`
--

DROP TABLE IF EXISTS `occurrence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occurrence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'id de l''utilisateur ayant saisi l''obs (seulement identification de tela, si utilisateur non inscrit ce champ est vide)',
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email de l''utilisateur ayant saisi l''obs',
  `user_pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Pseudo de l''utilisateur ayant saisi l''obs. Nom/Prénom si non renseigné.',
  `observer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Observateur',
  `observer_institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Structure dans le cadre de laquelle l''obs a été faite',
  `date_observed` datetime DEFAULT NULL COMMENT 'Date d''observation',
  `date_created` datetime NOT NULL COMMENT 'Date de création de l''obs',
  `date_updated` datetime DEFAULT NULL COMMENT 'Date de la dernière modification de l''obs',
  `date_published` datetime DEFAULT NULL COMMENT 'Date de publication de l''obs = transmission au réseau',
  `user_sci_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nom saisi par l''utilisateur (nom scientifique ou autre terme qualifiant  l''individu observé)',
  `user_sci_name_id` int(11) DEFAULT NULL COMMENT 'Numéro du nom (ou numéro nomenclatural ou nn) saisi par l''utilisateur, dans le cas où celui-ci est lié à un référentiel',
  `accepted_sci_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nom retenu',
  `accepted_sci_name_id` int(11) DEFAULT NULL COMMENT 'Numéro du nom (ou numéro nomenclatural ou nn) retenu',
  `plantnet_id` int(11) DEFAULT NULL COMMENT 'Identifiant plantnet',
  `family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Famille du taxon auquel appartient l''observation',
  `certainty` enum('à déterminer','douteux','certain') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Certitude de l identification taxonomique(DC2Type:certaintyenum)',
  `annotation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Commentaires concernant l''obs',
  `occurrence_type` enum('observation de terrain','issue de la bibliographie','donnée d''herbier') COLLATE utf8mb4_unicode_ci DEFAULT 'observation de terrain' COMMENT 'Type de donnée - observation de terrain, issue de la bibliographie, donnée d''herbier(DC2Type:occurrencetypeenum)',
  `is_wild` tinyint(1) DEFAULT 1 COMMENT 'Indique si l''individu observé était sauvage ou cultivé',
  `coef` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phenology` enum('00-09: germination, développement des bourgeons','10-19: développement des feuilles','11: par ex, environ 10% des feuilles épanouies','15: par ex, environ 50% des feuilles épanouies','20-29: formation de pousses latérales, tallage','30-39: développement des tiges, croissance des rosettes','40-49: développement des organes de propagation végétative','60-69: floraison','61: par ex, environ 10% des fleurs épanouies','65: par ex, environ 50% des fleurs épanouies','70-79: fructification','80-89: maturité des fruits et des graines','85: par ex, 50% des fruits matures','90-99: sénescence et dormance','91: par ex, environ 10% des feuilles jaunes','95: par ex, environ 50% des feuilles jaunes') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_herbarium` tinyint(1) DEFAULT 0 COMMENT 'Indique la présence / l''absence d''une part d''herbier associée à l''obs',
  `bibliography_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Source bibliographique',
  `input_source` enum('CEL','widget','VegLab','PlantNet','autre') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Interface utilisée pour la saisie de l''obs - CEL, VegLab, widget,  PlantNet, autre(DC2Type:inputsourceenum)',
  `is_public` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indique si l''obs est publique ou non',
  `is_visible_in_cel` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Indique si l''obs s''affiche dans le CEL ou non',
  `is_visible_in_veg_lab` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indique si l''obs s''affiche dans VegLab ou non',
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Vérification des doublons',
  `geometry` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Localisation précise de l''obs',
  `elevation` int(11) DEFAULT NULL COMMENT 'Altitude',
  `geodatum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'WGS84' COMMENT 'Système géodésique',
  `locality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Localité où se trouve l''obs',
  `locality_insee_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Code INSEE de la localité où se trouve l''obs',
  `sublocality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Lieu-dit',
  `environment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Milieu, type d''habitat',
  `locality_consistency` tinyint(1) DEFAULT NULL COMMENT 'Cohérence entre les coordonnées et la localité',
  `station` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'The string to show in the dropdown ',
  `published_location` enum('précise','localité','10x10km') COLLATE utf8mb4_unicode_ci DEFAULT 'précise' COMMENT 'Précision géographique à laquelle est publiée l''obs, permet de gérer le floutage(DC2Type:publishedlocationenum)',
  `location_accuracy` enum('0 à 10 m','10 à 100 m','100 à 500 m','Lieu-dit','Localité') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Précision (ou incertitude) de la localisation(DC2Type:locationaccuracytypeenum)',
  `osm_county` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - comté',
  `osm_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - état',
  `osm_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - code postal',
  `osm_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - pays',
  `osm_country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - code pays',
  `osm_id` bigint(20) DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - id osm',
  `osm_place_id` int(11) DEFAULT NULL COMMENT 'Champ complété automatiquement par osm - id de l''instance géographique',
  `identiplante_score` int(11) DEFAULT 0 COMMENT 'Score de l''observation sur identiplante',
  `is_identiplante_validated` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Statut validé (ou non) de l''observation sur identiplante',
  `identification_author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nom de la personne ayant identifié l''espèce observée (si différente de l''observateur)',
  `taxo_repo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Référentiel taxonomique',
  PRIMARY KEY (`id`),
  KEY `IDX_BEFD81F3166D1F9C` (`project_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `FK_BEFD81F3166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `tb_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1630 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `occurrence_user_occurrence_tag`
--

DROP TABLE IF EXISTS `occurrence_user_occurrence_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occurrence_user_occurrence_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurrence_id` int(11) NOT NULL,
  `user_occurrence_tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B06FBA5830572FAC` (`occurrence_id`),
  KEY `IDX_B06FBA58768D75C5` (`user_occurrence_tag_id`),
  CONSTRAINT `FK_B06FBA5830572FAC` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`),
  CONSTRAINT `FK_B06FBA58768D75C5` FOREIGN KEY (`user_occurrence_tag_id`) REFERENCES `user_occurrence_tag` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table de jointure entre occurrence et user_occurrence_tag.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `occurrence_validation`
--

DROP TABLE IF EXISTS `occurrence_validation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occurrence_validation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurrence_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C8C4281C30572FAC` (`occurrence_id`),
  CONSTRAINT `FK_C8C4281C30572FAC` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurrence_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'ID de l''utilisateur',
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email de l''utilisateur',
  `user_pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Pseudo de l''utilisateur propriétaire de la photo. Nom/Prénom si non renseigné.',
  `original_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nom du fichier image',
  `date_shot` datetime DEFAULT NULL COMMENT 'Date de la prise de vue',
  `latitude` double DEFAULT NULL COMMENT 'Latitude de la photo',
  `longitude` double DEFAULT NULL COMMENT 'Longitude de la photo',
  `date_created` datetime NOT NULL COMMENT 'Date de l''import du fichier',
  `date_updated` datetime DEFAULT NULL COMMENT 'Date de dernière modification',
  `date_linked_to_occurrence` datetime DEFAULT NULL COMMENT 'Date à laquelle la photo a été liée à une obs',
  `content_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14B7841830572FAC` (`occurrence_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `FK_14B7841830572FAC` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Les noms originaux doivent être uniques pour un même utilisateur.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `photo_tag`
--

DROP TABLE IF EXISTS `photo_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'ID de l''utilisateur',
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hiérarchie (mots clés parents séparés par des /)',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Mot-clé photo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `photo_tag_photo`
--

DROP TABLE IF EXISTS `photo_tag_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_tag_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `photo_tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BA5CB3F7E9E4C8C` (`photo_id`),
  KEY `IDX_3BA5CB3FEF6D1439` (`photo_tag_id`),
  CONSTRAINT `FK_3BA5CB3F7E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`),
  CONSTRAINT `FK_3BA5CB3FEF6D1439` FOREIGN KEY (`photo_tag_id`) REFERENCES `photo_tag` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table de jointure entre Photo et PhotoTag.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_settings`
--

DROP TABLE IF EXISTS `project_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `project` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Titre du wigdet à afficher',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Logo du projet',
  `language` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Langue du projet',
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxo_restriction_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Liste de valeurs possibles pour le taxon. Prend la forme ''repository_name: taxoId1,taxoId2, ...,taxoIdn''',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_type` tinyint(1) DEFAULT NULL,
  `css_style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_font` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL COMMENT 'Date de création du widget',
  `date_updated` datetime DEFAULT NULL COMMENT 'Date de dernière modif du widget',
  `taxo_restriction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Niveau de restriction pour la saisie du taxon : un seul taxon sélectionnable, plusieurs, un référentiel',
  `location_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT ' Le type de zone géographique concernée par le projet',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `environment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Valeur(s) par défaut du champ ''environment'' (milieux) de toutes les obs du projet',
  `published_location` enum('précise','localité','10x10km') COLLATE utf8mb4_unicode_ci DEFAULT '10x10km' COMMENT 'Précision géographique à laquelle est publiée l''obs, permet de gérer le floutage(DC2Type:publishedlocationenum)',
  `project_tag_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Un tag par défaut est associé à toutes les obs du projet',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_project_lang` (`project`,`language`),
  KEY `IDX_D80B2B1E166D1F9C` (`project_id`),
  CONSTRAINT `FK_D80B2B1E166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `tb_project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Info pour configurer le widget de saisie - la clé primaire est le nom du projet + la langue';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_project`
--

DROP TABLE IF EXISTS `tb_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Intitulé du projet',
  `is_private` tinyint(1) NOT NULL COMMENT 'Indique si tout le monde peut contribuer au projet (''false'') ou seulement les admin (''true'')',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_50640A4C727ACA70` (`parent_id`),
  CONSTRAINT `FK_50640A4C727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `tb_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_custom_field`
--

DROP TABLE IF EXISTS `user_custom_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_custom_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_profile_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Intitulé du champ',
  `data_type` enum('Booléen','Texte','Date','Entier','Décimal') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type de champ - Texte, Nombre, Date, Booléen(DC2Type:fielddatatypeenum)',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unité employée pour le champ',
  `default_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT ' Valeur par défaut',
  PRIMARY KEY (`id`),
  KEY `IDX_1834C1336B9DD454` (`user_profile_id`),
  CONSTRAINT `FK_1834C1336B9DD454` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profile_cel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Champs personnalisés de l''utilisateur';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_custom_field_occurrence`
--

DROP TABLE IF EXISTS `user_custom_field_occurrence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_custom_field_occurrence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurrence_id` int(11) NOT NULL,
  `user_custom_field_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Valeur renseignée par l''utilisateur',
  PRIMARY KEY (`id`),
  KEY `IDX_27C0824930572FAC` (`occurrence_id`),
  KEY `IDX_27C08249B3398C5B` (`user_custom_field_id`),
  CONSTRAINT `FK_27C0824930572FAC` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`),
  CONSTRAINT `FK_27C08249B3398C5B` FOREIGN KEY (`user_custom_field_id`) REFERENCES `user_custom_field` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_occurrence_tag`
--

DROP TABLE IF EXISTS `user_occurrence_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_occurrence_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'ID de l''utilisateur',
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hiérarchie (mots clés parents séparés par des /)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id__name` (`user_id`,`name`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Les noms de tags utilisateurs doivent être uniques (pour un même utilisateur).';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_profile_cel`
--

DROP TABLE IF EXISTS `user_profile_cel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile_cel` (
  `id` int(11) NOT NULL,
  `administered_project_id` int(11) DEFAULT NULL,
  `anonymize_data` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Anonymisation des données d''observation',
  `is_end_user_licence_accepted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Validation des conditions d''utilisation',
  `always_display_advanced_fields` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Validation des conditions d''utilisation',
  `language` enum('EN','FR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FR' COMMENT 'langage choisi pour communiquer dans l''interface.(DC2Type:languageenum)',
  PRIMARY KEY (`id`),
  KEY `IDX_EEE77E506C1DD863` (`administered_project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Gestion des préférences utilisateurs';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-04  7:18:24
