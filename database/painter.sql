-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2020 at 02:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `painter`
--
CREATE DATABASE IF NOT EXISTS `painter` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `painter`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `superadmin` smallint(6) DEFAULT 0,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bind_to_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT 0,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `rate_count` int(11) DEFAULT 0,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `last_seen_ts` double DEFAULT NULL,
  `fb_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_id` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`, `lat`, `lng`, `address`, `country`, `rate`, `rate_count`, `photo`, `fname`, `lname`, `last_seen`, `last_seen_ts`, `fb_id`, `phone`, `mobile_confirmed`, `symbol`, `city`, `state`, `zip`, `tax_id`, `address_2`, `auth_expiry`) VALUES
(6, 'admin', '_i3lTRTDt3hFrKiA2SnZNlsHUlC8s35otaIVDJwD-oUFonKJJnVHiBB_xRakY9rshFn8HpExltCCvqOdhHZCDQHtEkonIrdG_1592676496', '$2y$13$PgGR2mz5B3MM6bEqL8hUT.wMtCDnRAjGDSrguDX9hBjQJf3QCWioW', NULL, 1, 1, 1460684844, 1592676496, '::1', '', 'admin@example.com', 1, 0, 0, 'asdasda', 'syria', 0, 0, NULL, 'admin', 'admin', NULL, NULL, NULL, '7', 1, '7ipwVuGkanHWxsl', NULL, NULL, NULL, NULL, NULL, '2020-07-20 11:08:16'),
(12, 'ttt', 'FdLIUKgL1dfg-LyDgIeIt8zvJ3kRSpg7', '$2y$13$RMAu9HpiwlOYNPE7vaaMoe490bkZjWGYOoOLKr/xpQVTuOkPhLpka', NULL, 1, 0, 1600889131, 1600889131, '::1', '', 'admxxin@example.com', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'ttt', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_info`
--

CREATE TABLE `app_info` (
  `id` int(11) NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_info`
--

INSERT INTO `app_info` (`id`, `description`, `email`, `phone`, `mobile`, `site_url`, `facebook_url`, `instagram_url`, `linkedin_url`, `twitter_url`) VALUES
(1, '<p>You&rsquo;ve probably heard of&nbsp;<a href=\"https://www.webfx.com/tools/lorem-ipsum-generator/\">Lorem Ipsum</a>&nbsp;before &ndash; it&rsquo;s the most-used dummy text excerpt out there. People use it because it has a fairly normal distribution of letters and words (making it look like normal English), but it&rsquo;s also Latin, which means your average reader won&rsquo;t get distracted by trying to read it. It&rsquo;s perfect for showcasing design work as it should look when fleshed out with text, because it allows viewers to focus on the design work itself, instead of the text. It&rsquo;s also a great way to showcase the functionality of programs like word processors, font types, and more.</p>\r\n<p>We&rsquo;ve taken Lorem Ipsum to the next level with our HTML-Ipsum tool. As you can see, this Lorem Ipsum is tailor-made for websites and other online projects that are based in HTML. Most&nbsp;<a href=\"https://www.webfx.com/How-much-should-web-site-cost.html\">web design projects</a>&nbsp;use Lorem Ipsum excerpts to begin with, but you always have to spend an annoying extra minute or two formatting it properly for the web.</p>\r\n<p>Maybe you have a custom-styled ordered list you want to show off, or maybe you just want a long chunk of Lorem Ipsum that&rsquo;s already wrapped in paragraph tags. No matter the need, we&rsquo;ve put together a number of Lorem Ipsum samples ready to go with HTML tags and formatting in place. All you have to do is click the heading of any section on this page, and that HTML-Ipsum block is copied to your clipboard and ready to be loaded into a website redesign template, brand new design mockup, or any other digital project you might need dummy text for.</p>\r\n<p>No matter the project, please remember to replace your fancy HTML-Ipsum with real content before you go live - this is especially important if you\'re planning to implement a&nbsp;<a href=\"https://www.webfx.com/content-marketing-strategy.html\">content-based marketing strategy</a>&nbsp;for your new creation! Lorem Ipsum text is all well and good to demonstrate a design or project, but if you set a website loose on the Internet without replacing dummy text with relevant,&nbsp;<a href=\"https://www.webfx.com/content-marketing/elements-of-high-quality-content.html\">high quality content</a>, you&rsquo;ll run into all sorts of potential&nbsp;<a href=\"https://www.webfx.com/SEO-Pricing.html\">Search Engine Optimization</a>&nbsp;issues like thin content, duplicate content, and more.</p>\r\n<p>HTML-Ipsum is maintained by&nbsp;<a href=\"https://www.governor.pa.gov/governor-wolf-announces-webfx-expansion-of-national-headquarters-in-dauphin-county-creation-of-80-jobs/\">WebFX</a>. For more information about us, please visit&nbsp;<a href=\"https://clutch.co/profile/webfx\">WebFX Reviews</a>. To learn more about the&nbsp;<a href=\"https://www.webfx.com/industries/\">industries</a>&nbsp;we drive&nbsp;<a href=\"https://www.webfx.com/\">Internet marketing</a>&nbsp;performormance for and our revenue driving services:&nbsp;<a href=\"https://www.webfx.com/seo-checker/\">SEO</a>,&nbsp;<a href=\"https://www.webfx.com/ppc-management-services.html\">PPC</a>,&nbsp;<a href=\"https://www.webfx.com/Social-Media-Pricing.html\">social media</a>,&nbsp;<a href=\"https://www.webfx.com/best-web-design-company.html\">web design</a>,&nbsp;<a href=\"https://www.webfx.com/local-seo-pricing.html\">local SEO</a>&nbsp;and online&nbsp;<a href=\"https://www.webfx.com/blog/business-advice/the-cost-of-advertising-nationally-broken-down-by-medium/\">advertising services</a>.</p>', 'http://example.com', '+9647518728458', '+9647518728458', 'http://example.com', 'http://example.com', 'http://example.com', 'http://example.com', 'http://example.com');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`, `symbol`) VALUES
('admin', 11, NULL, NULL),
('admin', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`, `symbol`, `order`) VALUES
('role_index', 2, 'Role Index', NULL, NULL, 1599509840, 1599509840, 'role', NULL, NULL),
('site_error', 2, 'Site Error', NULL, NULL, 1599509841, 1599509841, 'site', NULL, NULL),
('admin_index', 2, 'Admin Index', NULL, NULL, 1599509845, 1599509845, 'admin', NULL, NULL),
('site_index', 2, 'Site Index', NULL, NULL, 1599510149, 1599510149, 'site', NULL, NULL),
('ads-manage_index', 2, 'Ads-manage Index', NULL, NULL, 1599510565, 1599510565, 'ads-manage', NULL, NULL),
('ads-manage_create', 2, 'Ads-manage Create', NULL, NULL, 1599510887, 1599510887, 'ads-manage', NULL, NULL),
('ads-manage_change-status', 2, 'Ads-manage Change-status', NULL, NULL, 1599512231, 1599512231, 'ads-manage', NULL, NULL),
('ads-manage_view', 2, 'Ads-manage View', NULL, NULL, 1599512235, 1599512235, 'ads-manage', NULL, NULL),
('app-info_view', 2, 'App-info View', NULL, NULL, 1599512309, 1599512309, 'app-info', NULL, NULL),
('app-info_update', 2, 'App-info Update', NULL, NULL, 1599512456, 1599512456, 'app-info', NULL, NULL),
('site_docs', 2, 'Site Docs', NULL, NULL, 1599515927, 1599515927, 'site', NULL, NULL),
('site_json-schema', 2, 'Site Json-schema', NULL, NULL, 1599515928, 1599515928, 'site', NULL, NULL),
('ads-manage_update', 2, 'Ads-manage Update', NULL, NULL, 1599520465, 1599520465, 'ads-manage', NULL, NULL),
('auth_login', 2, 'Auth Login', NULL, NULL, 1599582458, 1599582458, 'auth', NULL, NULL),
('auth_logout', 2, 'Auth Logout', NULL, NULL, 1599586427, 1599586427, 'auth', NULL, NULL),
('site_subcategories-list', 2, 'Site Subcategories-list', NULL, NULL, 1599608825, 1599608825, 'site', NULL, NULL),
('site_maincategories-list', 2, 'Site Maincategories-list', NULL, NULL, 1599609525, 1599609525, 'site', NULL, NULL),
('site_main-categories-list', 2, 'Site Main-categories-list', NULL, NULL, 1599609702, 1599609702, 'site', NULL, NULL),
('site_cities-list', 2, 'Site Cities-list', NULL, NULL, 1599610733, 1599610733, 'site', NULL, NULL),
('site_state-list', 2, 'Site State-list', NULL, NULL, 1599611326, 1599611326, 'site', NULL, NULL),
('site_get-sub-categories', 2, 'Site Get-sub-categories', NULL, NULL, 1599706684, 1599706684, 'site', NULL, NULL),
('site_get-categories', 2, 'Site Get-categories', NULL, NULL, 1599706684, 1599706684, 'site', NULL, NULL),
('site_get-state', 2, 'Site Get-state', NULL, NULL, 1599706688, 1599706688, 'site', NULL, NULL),
('site_get-cities', 2, 'Site Get-cities', NULL, NULL, 1599706688, 1599706688, 'site', NULL, NULL),
('site_get-top-categories', 2, 'Site Get-top-categories', NULL, NULL, 1599719142, 1599719142, 'site', NULL, NULL),
('service_index', 2, 'Service Index', NULL, NULL, 1600172271, 1600172271, 'service', NULL, NULL),
('category_index', 2, 'Category Index', NULL, NULL, 1600251489, 1600251489, 'category', NULL, NULL),
('category_update', 2, 'Category Update', NULL, NULL, 1600251492, 1600251492, 'category', NULL, NULL),
('category_view', 2, 'Category View', NULL, NULL, 1600251501, 1600251501, 'category', NULL, NULL),
('common-question_view', 2, 'Common-question View', NULL, NULL, 1602752956, 1602752956, 'common-question', NULL, NULL),
('category_create', 2, 'Category Create', NULL, NULL, 1600277796, 1600277796, 'category', NULL, NULL),
('common-question_update', 2, 'Common-question Update', NULL, NULL, 1602752949, 1602752949, 'common-question', NULL, NULL),
('state_index', 2, 'State Index', NULL, NULL, 1600853211, 1600853211, 'state', NULL, NULL),
('city_index', 2, 'City Index', NULL, NULL, 1600853212, 1600853212, 'city', NULL, NULL),
('site_about', 2, 'Site About', NULL, NULL, 1602748072, 1602748072, 'site', NULL, NULL),
('place_view', 2, 'Place View', NULL, NULL, 1602590438, 1602590438, 'place', NULL, NULL),
('product_view', 2, 'Product View', NULL, NULL, 1602588022, 1602588022, 'product', NULL, NULL),
('site_lang', 2, 'Site Lang', NULL, NULL, 1602567235, 1602567235, 'site', NULL, NULL),
('common-question_index', 2, 'Common-question Index', NULL, NULL, 1602488253, 1602488253, 'common-question', NULL, NULL),
('category_change-status', 2, 'Category Change-status', NULL, NULL, 1600858474, 1600858474, 'category', NULL, NULL),
('state_change-status', 2, 'State Change-status', NULL, NULL, 1600858482, 1600858482, 'state', NULL, NULL),
('state_create', 2, 'State Create', NULL, NULL, 1600858485, 1600858485, 'state', NULL, NULL),
('city_create', 2, 'City Create', NULL, NULL, 1600858488, 1600858488, 'city', NULL, NULL),
('service_change-status', 2, 'Service Change-status', NULL, NULL, 1600858495, 1600858495, 'service', NULL, NULL),
('service_create', 2, 'Service Create', NULL, NULL, 1600858497, 1600858497, 'service', NULL, NULL),
('ads-manage_delete', 2, 'Ads-manage Delete', NULL, NULL, 1600859744, 1600859744, 'ads-manage', NULL, NULL),
('product_index', 2, 'Product Index', NULL, NULL, 1602488202, 1602488202, 'product', NULL, NULL),
('category_delete', 2, 'Category Delete', NULL, NULL, 1600860129, 1600860129, 'category', NULL, NULL),
('site_get-main-categories', 2, 'Site Get-main-categories', NULL, NULL, 1600860410, 1600860410, 'site', NULL, NULL),
('state_delete', 2, 'State Delete', NULL, NULL, 1600860539, 1600860539, 'state', NULL, NULL),
('service_delete', 2, 'Service Delete', NULL, NULL, 1600860987, 1600860987, 'service', NULL, NULL),
('place_index', 2, 'Place Index', NULL, NULL, 1602412564, 1602412564, 'place', NULL, NULL),
('admin_view', 2, 'Admin View', NULL, NULL, 1600888026, 1600888026, 'admin', NULL, NULL),
('admin_change-password', 2, 'Admin Change-password', NULL, NULL, 1600888076, 1600888076, 'admin', NULL, NULL),
('admin-permission_set', 2, 'Admin-permission Set', NULL, NULL, 1600888117, 1600888117, 'admin-permission', NULL, NULL),
('admin_create', 2, 'Admin Create', NULL, NULL, 1600888188, 1600888188, 'admin', NULL, NULL),
('admin_update', 2, 'Admin Update', NULL, NULL, 1600888226, 1600888226, 'admin', NULL, NULL),
('role_create', 2, 'Role Create', NULL, NULL, 1600888636, 1600888636, 'role', NULL, NULL),
('admin', 1, 'مدير', NULL, NULL, 1600888647, 1600888647, NULL, NULL, NULL),
('role_view', 2, 'Role View', NULL, NULL, 1600888647, 1600888647, 'role', NULL, NULL),
('admin_delete', 2, 'Admin Delete', NULL, NULL, 1600888794, 1600888794, 'admin', NULL, NULL),
('service_update', 2, 'Service Update', NULL, NULL, 1601314618, 1601314618, 'service', NULL, NULL),
('common-question_create', 2, 'Common-question Create', NULL, NULL, 1602752988, 1602752988, 'common-question', NULL, NULL),
('common-question_change-status', 2, 'Common-question Change-status', NULL, NULL, 1602753015, 1602753015, 'common-question', NULL, NULL),
('site_faqs', 2, 'Site Faqs', NULL, NULL, 1602754787, 1602754787, 'site', NULL, NULL),
('place_update', 2, 'Place Update', NULL, NULL, 1603011382, 1603011382, 'place', NULL, NULL),
('place_add-new-content', 2, 'Place Add-new-content', NULL, NULL, 1603011390, 1603011390, 'place', NULL, NULL),
('product_update', 2, 'Product Update', NULL, NULL, 1603011404, 1603011404, 'product', NULL, NULL),
('product_delete', 2, 'Product Delete', NULL, NULL, 1603187356, 1603187356, 'product', NULL, NULL),
('product_change-status', 2, 'Product Change-status', NULL, NULL, 1603187502, 1603187502, 'product', NULL, NULL),
('product_product-details', 2, 'Product Product-details', NULL, NULL, 1603353496, 1603353496, 'product', NULL, NULL),
('product_add-new-image', 2, 'Product Add-new-image', NULL, NULL, 1603360555, 1603360555, 'product', NULL, NULL),
('product_add-frame', 2, 'Product Add-frame', NULL, NULL, 1603366472, 1603366472, 'product', NULL, NULL),
('place_place-details', 2, 'Place Place-details', NULL, NULL, 1603600220, 1603600220, 'place', NULL, NULL),
('product_create', 2, 'Product Create', NULL, NULL, 1603798967, 1603798967, 'product', NULL, NULL),
('paintings_index', 2, 'Paintings Index', NULL, NULL, 1603799171, 1603799171, 'paintings', NULL, NULL),
('places_index', 2, 'Places Index', NULL, NULL, 1603800292, 1603800292, 'places', NULL, NULL),
('tools_index', 2, 'Tools Index', NULL, NULL, 1603800620, 1603800620, 'tools', NULL, NULL),
('halls_index', 2, 'Halls Index', NULL, NULL, 1603864420, 1603864420, 'halls', NULL, NULL),
('courses_index', 2, 'Courses Index', NULL, NULL, 1603865050, 1603865050, 'courses', NULL, NULL),
('packages_index', 2, 'Packages Index', NULL, NULL, 1603866090, 1603866090, 'packages', NULL, NULL),
('paintings_painting-details', 2, 'Paintings Painting-details', NULL, NULL, 1603875301, 1603875301, 'paintings', NULL, NULL),
('tools_tool-details', 2, 'Tools Tool-details', NULL, NULL, 1603875921, 1603875921, 'tools', NULL, NULL),
('packages_package-details', 2, 'Packages Package-details', NULL, NULL, 1603876852, 1603876852, 'packages', NULL, NULL),
('courses_course-details', 2, 'Courses Course-details', NULL, NULL, 1603877284, 1603877284, 'courses', NULL, NULL),
('halls_hall-details', 2, 'Halls Hall-details', NULL, NULL, 1603877364, 1603877364, 'halls', NULL, NULL),
('auth_registration', 2, 'Auth Registration', NULL, NULL, 1604224488, 1604224488, 'auth', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_group`
--

CREATE TABLE `auth_item_group` (
  `code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`, `symbol`) VALUES
('admin', 'Admin', 1599509845, 1599509845, NULL),
('admin-permission', 'Admin-permission', 1600888117, 1600888117, NULL),
('ads-manage', 'Ads-manage', 1599510565, 1599510565, NULL),
('app-info', 'App-info', 1599512309, 1599512309, NULL),
('auth', 'Auth', 1599582458, 1599582458, NULL),
('category', 'Category', 1600251488, 1600251488, NULL),
('city', 'City', 1600853212, 1600853212, NULL),
('common-question', 'Common-question', 1602488253, 1602488253, NULL),
('courses', 'Courses', 1603865050, 1603865050, NULL),
('halls', 'Halls', 1603864420, 1603864420, NULL),
('packages', 'Packages', 1603866090, 1603866090, NULL),
('paintings', 'Paintings', 1603799171, 1603799171, NULL),
('place', 'Place', 1600277024, 1600277024, NULL),
('places', 'Places', 1603800292, 1603800292, NULL),
('product', 'Product', 1602488202, 1602488202, NULL),
('role', 'Role', 1599509840, 1599509840, NULL),
('service', 'Service', 1600172271, 1600172271, NULL),
('site', 'Site', 1599509840, 1599509840, NULL),
('state', 'State', 1600853211, 1600853211, NULL),
('tools', 'Tools', 1603800620, 1603800620, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `common_question`
--

CREATE TABLE `common_question` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `common_question`
--

INSERT INTO `common_question` (`id`, `question`, `answer`, `create_date`, `status`) VALUES
(6, 'fgfffff', 'dffdfdf', '2020-10-08 12:21:41', 1),
(7, 'wafwqeaqfewfW', 'EQWFQWEFRQWAF', '2020-10-15 12:09:54', 1),
(8, 'EADHWAERHDGFHAEDF', '<EGHERGRGDGH', '2020-10-15 12:10:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `symbol`) VALUES
(1, 'painter@yahoo.com', 'Er2Qps3hnB4G2mE');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1453226110),
('m130524_201442_init', 1453226111),
('m181123_182700_add_column_symbol_to_all_tables', 1549135760),
('m181123_184143_set_symbol_to_all_tables', 1549136984),
('m181123_190937_create_table_queues', 1549136984),
('m181123_192249_test_migrate', 1549136984),
('m181126_212521_create_settings_table', 1549137228),
('m181126_213142_seeds_add_row_confing', 1549137246);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_activation`
--

CREATE TABLE `mobile_activation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `course_type` tinyint(2) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `oneday_price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `seats_number` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `status` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id`, `name`, `type`, `course_type`, `image`, `price`, `oneday_price`, `description`, `capacity`, `start_date`, `end_date`, `seats_number`, `create_date`, `status`) VALUES
(5, 'تدمر', 0, 0, NULL, 10, NULL, 'zcxzxc', NULL, NULL, NULL, 10, '2020-10-02 12:41:03', 1),
(6, 'تدمر', 0, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2020-10-02 12:42:36', 1),
(7, 'sdsjhjjjj', 0, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2020-10-02 12:46:56', 1),
(10, 'مرسم1', 2, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 10:38:54', 1),
(11, 'القاعة رقم 1', 1, NULL, '5f992d4540321.jpg', NULL, 20, '<p>وصف ما</p>', 20, NULL, NULL, NULL, '2020-10-07 07:10:26', 1),
(12, 'مرسم رقم 1', 2, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-07 07:12:19', 1),
(13, 'jhfgh', 2, NULL, NULL, 10, NULL, NULL, NULL, '0000-00-00', NULL, NULL, '2020-10-08 09:55:57', 1),
(14, 'regrew', 0, 1, NULL, 10, NULL, '<p>kkkkkkkkkkkkkkkkkkkkkkkkkkkkk</p>', NULL, '2020-10-04', '2020-10-14', 4, '2020-10-08 11:57:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `place_contents`
--

CREATE TABLE `place_contents` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `place_contents`
--

INSERT INTO `place_contents` (`id`, `place_id`, `content`) VALUES
(9, 10, 'محتوى 1'),
(10, 10, 'محتوى 2'),
(12, 12, 'ؤرءؤءرءؤر'),
(13, 12, 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff'),
(14, 12, 'ؤرءؤءرءؤر');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `image` varchar(512) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `image`, `price`, `description`, `create_date`, `status`) VALUES
(6, 'eee', 1, '5f8eb3203854e.jpg', 10, '<p>qq</p>', '2020-10-01 02:59:55', 1),
(7, 'eee', 1, '5f751c42556be.png', 10, '22', '2020-10-01 03:01:06', 0),
(8, 'eee', 0, '5f7523b5843d4.png', 10, 'xx', '2020-10-01 03:32:53', 1),
(11, 'T-shirt', 1, '5f8eb3437b870.jpg', 55, '<p>xdc</p>', '2020-10-02 02:29:24', 1),
(14, 'ss', 1, '5f8eb365ab97d.png', 49, '<p>xc</p>', '2020-10-02 02:33:30', 1),
(15, 'Greaves', 1, '5f912efed25dc.png', 49, '<p>ds</p>', '2020-10-02 02:35:35', 1),
(18, 'Jacket', 1, '5f912f1cd37c8.png', 68, '<p>cv</p>', '2020-10-02 02:44:39', 1),
(22, 'xcccxv', 1, NULL, 20, '<p>zcz</p>', '2020-10-05 02:58:12', 1),
(24, 'sdsdcf', 1, NULL, 10, '<p>ZXZX</p>', '2020-10-05 03:02:14', 1),
(27, 'eee', 1, NULL, 10, '<p>jljjl</p>', '2020-10-07 10:39:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_frames`
--

CREATE TABLE `product_frames` (
  `id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_frames`
--

INSERT INTO `product_frames` (`id`, `name`, `product_id`, `image`) VALUES
(4, '', 6, '5f771663572bf.png'),
(6, '', 11, '5f779d49cbab9.jpg'),
(13, 'eee', 6, '5f91575157ded.jpg'),
(14, 'eee', 6, '5f91575e98dff.jpg'),
(15, 'eee', 6, '5f915767eca4c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bind_to_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT 0,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_postal_code` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_num` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `rate_count` int(11) NOT NULL DEFAULT 0,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `last_seen_ts` double DEFAULT NULL,
  `fb_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `auth_expiry` datetime DEFAULT NULL,
  `need_password` tinyint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`, `lat`, `lng`, `address`, `city`, `state`, `zip_postal_code`, `fax_num`, `country`, `rate`, `rate_count`, `photo`, `fname`, `lname`, `last_seen`, `last_seen_ts`, `fb_id`, `phone`, `mobile_confirmed`, `symbol`, `second_email`, `birth_date`, `auth_expiry`, `need_password`) VALUES
(7, 'First', '2qVlPy3cFD_ozcP9WNG0bj_E20K8D01FKvhIoctlmTsxrmXLGgcavCqXivYfEk_Hx51GjEZJECSSOmfROiMijrFp4QK1_aIu_1598880769', '$2y$13$L8MlJjyXlniOpyNccR9OzediZVqKi9xqUgkNtDWzbwz/fhBvqXkoi', 'akq-MeA4cmJE4d71yuMlh3BlRw_rpB4e_1598857673', 1, 1598857673, 1598881157, '::1', '', 'yusef.shahoud@gmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'string', 'string', NULL, NULL, NULL, 'string', 1, NULL, NULL, NULL, '2020-10-01 06:32:49', 0),
(9, 'wassim', '8LN4SzlM7vCUF49NvR84DMm_ijn6iQAX', '$2y$13$UItBVG0q4crWbXuh37D7U.2OPMJZcRGAnRMaDF.MVZhFJp5WuCDfq', 'mvXiknZkZXg-l8hePraGWrNASnZkVigT_1604224624', 1, 1604224625, 1604224625, '::1', '', 'wassim@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(10, 'wasssim', 'lLj-FjeoErmXA1IGQKO0pW10WYaPQktF', '$2y$13$etnMk2NYztTDQ/e9hBu3puCZlt0UguNJMCfZ7nZK.9CgUHzaAtRBO', 'HpwB6lIhisOaj9DxGyApkJfdBeSJ8J4i_1604235527', 1, 1604235528, 1604235528, '::1', '', 'wassim@gmailaa.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(11, 'wasssim', '8Giiyq7e36HaYgtIDbDZSqcFdXwL2WMG', '$2y$13$9uj6PCNdGe3o6F.3tl6YkOZnNA3EsJFblB0RBOYdEM.qDXYmfdboG', '-WM2L3A41BLTl_PkQIq-YEEFphRKQO95_1604235588', 1, 1604235589, 1604235589, '::1', '', 'wassim@gmailaaww.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(12, 'ali', '_rBMSXupPgqLxM9g0K3fQY3EAnFxhWdM', '$2y$13$XbJsndPP7XtEov9L3XmOWOOGksbj40li64NvwTCo/zYmGc9SP3qhO', 't8FQeC9U7Oi27XfF9xyhzypa2_rSS42P_1604297440', 1, 1604297440, 1604297440, '::1', '', 'ali@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(13, 'ss', 'U23AGo7LME2fHjR-DrfZnfkik6kGL6Bj', '$2y$13$80gu9FPio49dNCJPME6SpuA23RSHMBweJvG9AtCB22pDVVaye628m', 'aVxjI-HdfNKApGu6L1z-PeKIrvtTZ-tO_1604297589', 1, 1604297589, 1604297589, '::1', '', 'ss@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(14, 'assi', '6nidHXeR-8vCPIsq8gg1IMx2hf7tbyyr', '$2y$13$kRLyA1.wxxdGrocDkDbbXuTDsFjWhxAjYdl8cGcrrrZ2/8hPCtdtu', '3cL2ekokVV8krRshK32rzndlPzsoZuhG_1604310022', 1, 1604310023, 1604310023, '::1', '', 'assi@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_mobile_email`
--

CREATE TABLE `user_mobile_email` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `is_primary` tinyint(4) NOT NULL DEFAULT 0,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user set of his emails and mobile numbers that can confirm';

--
-- Dumping data for table `user_mobile_email`
--

INSERT INTO `user_mobile_email` (`id`, `user_id`, `mobile`, `email`, `confirm_code`, `is_confirmed`, `is_primary`, `symbol`, `type`) VALUES
(7, 7, NULL, 'yusef.shahoud@gmail.com', '55284', 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_visit_log`
--

CREATE TABLE `user_visit_log` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `language` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `view_obj_log`
--

CREATE TABLE `view_obj_log` (
  `id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `from` varchar(24) COLLATE utf8_unicode_ci NOT NULL COMMENT 'web/mobile',
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `mobile_confirmed` (`mobile_confirmed`);

--
-- Indexes for table `app_info`
--
ALTER TABLE `app_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_item_group`
--
ALTER TABLE `auth_item_group`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `common_question`
--
ALTER TABLE `common_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mobile_activation`
--
ALTER TABLE `mobile_activation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_contents`
--
ALTER TABLE `place_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_frames`
--
ALTER TABLE `product_frames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `mobile_confirmed` (`mobile_confirmed`);

--
-- Indexes for table `user_mobile_email`
--
ALTER TABLE `user_mobile_email`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_mobile_email_key` (`user_id`,`mobile`,`email`);

--
-- Indexes for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `view_obj_log`
--
ALTER TABLE `view_obj_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obj_id` (`obj_id`),
  ADD KEY `date` (`date`),
  ADD KEY `from` (`from`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `obj_id_2` (`obj_id`),
  ADD KEY `obj_id_3` (`obj_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `app_info`
--
ALTER TABLE `app_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `common_question`
--
ALTER TABLE `common_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobile_activation`
--
ALTER TABLE `mobile_activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `place_contents`
--
ALTER TABLE `place_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_frames`
--
ALTER TABLE `product_frames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_mobile_email`
--
ALTER TABLE `user_mobile_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `view_obj_log`
--
ALTER TABLE `view_obj_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `place_contents`
--
ALTER TABLE `place_contents`
  ADD CONSTRAINT `place_contents_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_frames`
--
ALTER TABLE `product_frames`
  ADD CONSTRAINT `product_frames_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_mobile_email`
--
ALTER TABLE `user_mobile_email`
  ADD CONSTRAINT `user_mobile_email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
