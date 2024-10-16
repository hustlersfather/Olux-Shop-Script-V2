Start afresh from basic step to professional and create project and follow this approach making sure all are proper  according to this route making sure the IsaAdmin approval role is there for both IsResseller and IsUser Sanctum auth  api 

Create proper migration table with my below sql -- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2020 at 09:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `felux`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text DEFAULT NULL,
  `date` text NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acctype`, `country`, `infos`, `price`, `url`, `sold`, `sto`, `dateofsold`, `date`, `resseller`, `reported`, `sitename`, `login`, `pass`) VALUES

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `price` int(11) NOT NULL,
  `url` text NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL DEFAULT current_timestamp(),
  `date` text NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(255) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `acctype`, `country`, `infos`, `price`, `url`, `sold`, `sto`, `dateofsold`, `date`, `resseller`, `reported`, `bankname`, `balance`) VALUES
(1, 'banks', 'Germany', 'Fresh Accounts', 5, 'Kreis-Sparkasse Northeim | \r\nName	Hans-Walter Weigel\r\nAdresse	Brandenburgische Str 112\r\nStadt	55619 Hennweiler\r\nTelefon	00/4414371\r\nGeburtsdatum	27/07/1964\r\nEmail	hans-walter.weigel@gmx.de\r\nAusweisnummer	4431427391<<D<<6407276<2607274<<<<<<<0\r\nAblaufdatum	27/07/2026\r\nBank	Kreis-Sparkasse Northeim\r\nBLZ	26250001\r\nKontonummer	5495301235\r\nIBAN	\r\nDE80262500015495301235\r\n(Valid Check)\r\nBIC	\r\nCC.	Mastercard\r\nNo.	5232067330908730\r\nCVV2	451\r\nExp	08/23 ', 0, '', '', '24/03/2020 07:36:43 pm', 'omermaksuti', '', 'Kreis-Sparkasse Northeim', 10),


-- --------------------------------------------------------

--
-- Table structure for table `cpanels`
--

CREATE TABLE `cpanels` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` timestamp NOT NULL DEFAULT current_timestamp(),
  `resseller` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reported` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL,
  `date` text NOT NULL,
  `number` text NOT NULL,
  `reported` text NOT NULL,
  `login` text DEFAULT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `acctype`, `country`, `infos`, `url`, `price`, `resseller`, `sold`, `sto`, `dateofsold`, `date`, `number`, `reported`, `login`, `pass`) VALUES
(1, 'leads', 'United States', 'Hotmail SHOP', 'https://google.com/', 3, 'omermaksuti', 1, 'omermaksuti', '2020-03-24 19:45:22', '24/03/2020 07:42:23 pm', '5k', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mailers`
--

CREATE TABLE `mailers` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateofsold` timestamp NOT NULL DEFAULT current_timestamp(),
  `reported` varchar(255) NOT NULL,
  `sto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date`) VALUES
(1, 'NEWS BUYER', 'Bugs Updated', '2020-03-24 02:28:56'),


-- --------------------------------------------------------

--
-- Table structure for table `newseller`
--

CREATE TABLE `newseller` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newseller`
--

INSERT INTO `newseller` (`id`, `title`, `content`, `date`) VALUES
(1, 'NEWS BUYER', 'Bugs Updated', '2020-03-24 02:28:56'),


-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `amountusd` int(11) NOT NULL,
  `address` text NOT NULL,
  `p_data` text NOT NULL,
  `state` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user`, `method`, `amount`, `amountusd`, `address`, `p_data`, `state`, `date`) VALUES
(NULL, 'omermaksuti', 'Bitcoin', 0, 20, '3QQuujhjrfxxF6Z2ysY7rS4q881kPCNNCT', '22cad767b7f7d98c44ce29b34d573a87', 'pending', '2020/03/24 07:54:49'),

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `country` varchar(255) NOT NULL,
  `infos` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(100) NOT NULL,
  `reportid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `s_id`, `buyer`, `type`, `date`, `country`, `infos`, `url`, `login`, `pass`, `price`, `resseller`, `reported`, `reportid`) VALUES
(1, 8, 'fisnik', 'netflix', '2020-03-24 14:45:24', 'kosovo', 'hfjkdshfdsjk', 'hkjshfkdsj', 'hfbkdsjhkj', 'hfjkdshfkj', 10, 'omermaksuti', '', 0),

--
-- Table structure for table `rdps`
--

CREATE TABLE `rdps` (
  `id` int(11) DEFAULT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `hosting` varchar(255) NOT NULL,
  `ram` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `uid` varchar(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `acctype` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `orderid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `lastreply` text NOT NULL,
  `lastup` text NOT NULL,
  `resseller` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resseller`
--

CREATE TABLE `resseller` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `unsoldb` int(11) NOT NULL,
  `soldb` int(11) NOT NULL,
  `isold` int(11) NOT NULL,
  `iunsold` int(11) NOT NULL,
  `activate` text NOT NULL,
  `btc` text NOT NULL,
  `withdrawal` text NOT NULL,
  `allsales` int(11) DEFAULT NULL,
  `lastweek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resseller`
--

INSERT INTO `resseller` (`id`, `username`, `unsoldb`, `soldb`, `isold`, `iunsold`, `activate`, `btc`, `withdrawal`, `allsales`, `lastweek`) VALUES
(1, 'omermaksuti', 0, 106, 0, 0, '24/03/2020 04:19:53 pm', '', '', NULL, 20),

-- --------------------------------------------------------

--
-- Table structure for table `scampages`
--


--
-- Dumping data for table `scampages`
--

--
-- Table structure for table `smtps`
--


--
-- Table structure for table `stufs`
--


-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `s_url` text NOT NULL,
  `memo` text NOT NULL,
  `acctype` int(11) NOT NULL,
  `admin_r` int(11) NOT NULL,
  `date` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resseller` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `refounded` varchar(255) NOT NULL,
  `fmemo` text NOT NULL,
  `seen` int(11) NOT NULL,
  `lastreply` varchar(255) NOT NULL,
  `lastup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `uid`, `status`, `s_id`, `s_url`, `memo`, `acctype`, `admin_r`, `date`, `subject`, `type`, `resseller`, `price`, `refounded`, `fmemo`, `seen`, `lastreply`, `lastup`) VALUES
(1, 'omermaksuti', 1, 8, 'fbdsnfbdsmn', 'fbdnmsfbmdns<div class=\"panel panel-default\"><div class=\"panel-body\"><div class=\"ticket\"><b>hkjfdkjs\r\n</b></div></div><div class=\"panel-footer\"><div class=\"label label-warning\">Support</div> - 24/03/2020 04:19:53 pm</div></div>', 2, 2, '10.03.2020', 'fndsbfnmdsfbnm', 'Account', 22, 50, 'fdsfdsfdsf', 'fdsfds', 0, 'Support', '24/03/2020 04:19:53 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL,
  `date` text NOT NULL,
  `tutoname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `acctype`, `country`, `infos`, `url`, `price`, `resseller`, `sold`, `sto`, `dateofsold`, `date`, `tutoname`) VALUES
(1, 'tutorial', '-', 'Amazon GiftCards method Fresh March 2020', 'https://google.com/', 15, 'omermaksuti', 0, '', '', '24/03/2020 07:38:01 pm', 'Amazon.de');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `balance` int(11) DEFAULT 0,
  `ipurchassed` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `lastlogin` date DEFAULT NULL,
  `datereg` date DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 3
  `resseller` int(11) NOT NULL DEFAULT 0
  `img` text DEFAULT NULL,
  `testemail` varchar(255) DEFAULT NULL,
  `resetpin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  <?php

// routes/resseller.php

use App\Http\Controllers\Resseller\ResellerController;
use App\Http\Controllers\ResellerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isReseller'])->group(function () {
    Route::get('/', [ResellerController::class, 'dashboard'])->name('reseller.dashboard.index');
});

// Manage content post
Route::middleware(['auth', 'isReseller'])->group(function () {
    Route::get('/content/index', [ResellerController::class, 'contentIndex'])->name('reseller.content.index');  
    Route::get('/content/create', [ResellerController::class, 'contentCreate'])->name('reseller.content.create');
    Route::post('/content/store', [ResellerController::class, 'contentStore'])->name('reseller.content.store');
});

// Manage users
Route::middleware(['auth', 'isReseller'])->group(function () {
    Route::get('/users/index', [ResellerController::class, 'usersIndex'])->name('reseller.users.index');  
    Route::get('/users', [ResellerController::class, 'users'])->name('reseller.users');  
});

// Manage reports
Route::middleware(['auth', 'isReseller'])->group(function () {
    Route::get('/reports/index', [ResellerController::class, 'reportsIndex'])->name('reseller.reports.index');  
    Route::get('/reports', [ResellerController::class, 'reports'])->name('reseller.reports');  
});
 use App\Http\Controllers\Reseller\ResellerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isReseller'])->group(function () {
    Route::get('/', [ResellerController::class, 'dashboard'])->name('reseller.dashboard.index');

    // Content Management Routes
    Route::get('/index', [ResellerController::class, 'index'])->name('reseller.index');
    Route::get('/ajaxinfo', [ResellerController::class, 'ajaxInfo'])->name('reseller.ajaxinfo');

    // Shell Management Routes
    Route::get('/shell', [ResellerController::class, 'shell'])->name('reseller.shell.index');
    Route::get('/shellMass', [ResellerController::class, 'shellMass'])->name('reseller.shell.mass');
    Route::get('/shellTab1', [ResellerController::class, 'shellTab1'])->name('reseller.shell.tab1');
    Route::get('/shellTab2', [ResellerController::class, 'shellTab2'])->name('reseller.shell.tab2');
    Route::get('/shellTab3', [ResellerController::class, 'shellTab3'])->name('reseller.shell.tab3');

    // RDP Management Routes
    Route::get('/rdp', [ResellerController::class, 'rdp'])->name('reseller.rdp.index');
    Route::get('/rdpAdd', [ResellerController::class, 'rdpAdd'])->name('reseller.rdp.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/rdpTab1', [ResellerController::class, 'rdpTab1'])->name('reseller.rdp.tab1');
    Route::get('/rdpTab2', [ResellerController::class, 'rdpTab2'])->name('reseller.rdp.tab2');

    // Sales and Withdrawal
    Route::get('/sales', [ResellerController::class, 'sales'])->name('reseller.sales.index');
    Route::get('/withdraw', [ResellerController::class, 'withdraw'])->name('reseller.withdraw.index');

    // Reports
    Route::get('/reports', [ResellerController::class, 'reports'])->name('reseller.reports.index');
    Route::get('/reportsTab1', [ResellerController::class, 'reportsTab1'])->name('reseller.reports.tab1');
    Route::get('/reportsTab2', [ResellerController::class, 'reportsTab2'])->name('reseller.reports.tab2');

    // Premium Management
    Route::get('/premium', [ResellerController::class, 'premium'])->name('reseller.premium.index');
    Route::get('/premiumAdd', [ResellerController::class, 'premiumAdd'])->name('reseller.premium.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/premiumTab1', [ResellerController::class, 'premiumTab1'])->name('reseller.premium.tab1');
    Route::get('/premiumTab2', [ResellerController::class, 'premiumTab2'])->name('reseller.premium.tab2');

    // Bank Management
    Route::get('/banks/index', [ResellerController::class, 'banks'])->name('reseller.banks.index');
    Route::get('/banks/Add', [ResellerController::class, 'banksAdd'])->name('reseller.banks.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/banks/Tab1', [ResellerController::class, 'banksTab1'])->name('reseller.banks.tab1');
    Route::get('/banks/Tab2', [ResellerController::class, 'banksTab2'])->name('reseller.banks.tab2');

    // SMTP Management
    Route::get('/smtp/index', [ResellerController::class, 'smtp'])->name('reseller.smtp.index');
    Route::get('/smtp/Add', [ResellerController::class, 'smtpAdd'])->name('reseller.smtp.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/smtp/Tab1', [ResellerController::class, 'smtpTab1'])->name('reseller.smtp.tab1');
    Route::get('/smtp/Tab2', [ResellerController::class, 'smtpTab2'])->name('reseller.smtp.tab2');

    // Tutorials
    Route::get('/tutorial/index', [ResellerController::class, 'tutorial'])->name('reseller.tutorial.index');
    Route::get('/tutorial/Add', [ResellerController::class, 'tutorialAdd'])->name('reseller.tutorial.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/tutorial/Tab1', [ResellerController::class, 'tutorialTab1'])->name('reseller.tutorial.tab1');
    Route::get('/tutorial/Tab2', [ResellerController::class, 'tutorialTab2'])->name('reseller.tutorial.tab2');

    // Mailer Management
    Route::get('/mailer/', [ResellerController::class, 'mailer'])->name('reseller.mailer.index');
    Route::get('/mailer/Add', [ResellerController::class, 'mailerAdd'])->name('reseller.mailer.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/mailer/Tab1', [ResellerController::class, 'mailerTab1'])->name('reseller.mailer.tab1');
    Route::get('/mailer/Tab2', [ResellerController::class, 'mailerTab2'])->name('reseller.mailer.tab2');

    // cPanel Management
    Route::get('/cpanel/', [ResellerController::class, 'cpanel'])->name('reseller.cpanel.index');
    Route::get('/cpanel/Add', [ResellerController::class, 'cpanelAdd'])->name('reseller.cpanel.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/cpanel/Mass', [ResellerController::class, 'cpanelMass'])->name('reseller.cpanel.mass')->middleware('isAdmin'); // Require admin approval
    Route::get('/cpanel/Tab1', [ResellerController::class, 'cpanelTab1'])->name('reseller.cpanel.tab1');
    Route::get('/cpanel/Tab2', [ResellerController::class, 'cpanelTab2'])->name('reseller.cpanel.tab2');
    Route::get('/cpanel/Tab3', [ResellerController::class, 'cpanelTab3'])->name('reseller.cpanel.tab3');

    // Leads Management
    Route::get('/leads/', [ResellerController::class, 'leads'])->name('reseller.leads.index');
    Route::get('/lead/Add', [ResellerController::class, 'leadAdd'])->name('reseller.lead.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/lead/Tab1', [ResellerController::class, 'leadTab1'])->name('reseller.lead.tab1');
    Route::get('/lead/Tab2', [ResellerController::class, 'leadTab2'])->name('reseller.lead.tab2');

    // Scampage Management
    Route::get('/scampage/', [ResellerController::class, 'scampage'])->name('reseller.scampage.index');
    Route::get('/scampage/Add', [ResellerController::class, 'scampageAdd'])->name('reseller.scampage.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/scampage/Tab1', [ResellerController::class, 'scampageTab1'])->name('reseller.scampage.tab1');
    Route::get('/scampage/Tab2', [ResellerController::class, 'scampageTab2'])->name('reseller.scampage.tab2');

    // Dynamic routes for Vt, Vr, Refund, Order
    Route::get('/vt-{id}', [ResellerController::class, 'vt'])->name('reseller.vt');
    Route::get('/vr-{id}', [ResellerController::class, 'vr'])->name('reseller.vr');
    Route::get('/refund-{id}', [ResellerController::class, 'refund'])->name('reseller.refund');
    Route::get('/showOrder{orderId}', [ResellerController::class, 'showOrder'])->name('reseller.showOrder');
}); 
<?php

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResellerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('welcome');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

});
