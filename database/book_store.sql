-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 11:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `pass`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_isbn` varchar(20) NOT NULL,
  `book_title` varchar(60) DEFAULT NULL,
  `book_author` varchar(60) DEFAULT NULL,
  `book_image` varchar(40) DEFAULT NULL,
  `book_descr` text DEFAULT NULL,
  `book_price` decimal(6,2) NOT NULL,
  `publisherid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_isbn`, `book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `publisherid`) VALUES
('567895678', 'tyuighjkgbh', 'bnhjbhj', 'hobbit.jpg', 'ghjghjsdjgfdhgsaojghdfhgshkhffashdkadfsh', 123.00, 2),
('65128351235613286', 'cvbnmvbnghjk', 'haksjdhakds', 'hobbit.jpg', 'dlskjfkjldsfkjlskldjf', 22.00, 1),
('978-0-7303-1484-4', 'Doing Good By Doing Good', 'Peter Baines', 'doing_good.jpg', 'Doing Good by Doing Good shows companies how to improve the bottom line by implementing an engaging, authentic, and business-enhancing program that helps staff and business thrive. International CSR consultant Peter Baines draws upon lessons learnt from the challenges faced in his career as a police officer, forensic investigator, and founder of Hands Across the Water to describe the Australian CSR landscape, and the factors that make up a program that benefits everyone involved. Case studies illustrate the real effect of CSR on both business and society, with clear guidance toward maximizing involvement, engaging all employees, and improving the bottom line. The case studies draw out the companies that are focusing on creating shared value in meeting the challenges of society whilst at the same time bringing strong economic returns.\r\n\r\nConsumers are now expecting that big businesses with ever-increasing profits give back to the community from which those profits arise. At the same time, shareholders are demanding their share and are happy to see dividends soar. Getting this right is a balancing act, and Doing Good by Doing Good helps companies delineate a plan of action for getting it done.', 20.00, 2),
('978-0544003415', 'The Hobbit', 'J.R.R. Tolkien', 'hobbit.jpg', 'A fantasy novel about Bilbo Baggins\' journey to recover treasure guarded by the dragon Smaug.', 15.99, 1),
('978-05440034151', 'The Hobbit 1', '1231', 'hobbit.jpg', 'adsdsd', 90.00, 1),
('978-1-118-94924-5', 'Programmable Logic Controllers', 'Dag H. Hanssen', 'logic_program.jpg', 'Widely used across industrial and manufacturing automation, Programmable Logic Controllers (PLCs) perform a broad range of electromechanical tasks with multiple input and output arrangements, designed specifically to cope in severe environmental conditions such as automotive and chemical plants.Programmable Logic Controllers: A Practical Approach using CoDeSys is a hands-on guide to rapidly gain proficiency in the development and operation of PLCs based on the IEC 61131-3 standard. Using the freely-available* software tool CoDeSys, which is widely used in industrial design automation projects, the author takes a highly practical approach to PLC design using real-world examples. The design tool, CoDeSys, also features a built in simulator / soft PLC enabling the reader to undertake exercises and test the examples.', 20.00, 2),
('978-1-1180-2669-4', 'Professional JavaScript for Web Developers, 3rd Edition', 'Nicholas C. Zakas', 'pro_js.jpg', 'If you want to achieve JavaScript\'s full potential, it is critical to understand its nature, history, and limitations. To that end, this updated version of the bestseller by veteran author and JavaScript guru Nicholas C. Zakas covers JavaScript from its very beginning to the present-day incarnations including the DOM, Ajax, and HTML5. Zakas shows you how to extend this powerful language to meet specific needs and create dynamic user interfaces for the web that blur the line between desktop and internet. By the end of the book, you\'ll have a strong understanding of the significant advances in web development as they relate to JavaScript so that you can apply them to your next website.', 20.00, 1),
('978-1-44937-019-0', 'Learning Web App Development', 'Semmy Purewal', 'web_app_dev.jpg', 'Grasp the fundamentals of web application development by building a simple database-backed app from scratch, using HTML, JavaScript, and other open source tools. Through hands-on tutorials, this practical guide shows inexperienced web app developers how to create a user interface, write a server, build client-server communication, and use a cloud-based service to deploy the application.\r\n\r\nEach chapter includes practice problems, full examples, and mental models of the development workflow. Ideal for a college-level course, this book helps you get started with web app development by providing you with a solid grounding in the process.', 20.00, 3),
('978-1-44937-075-6', 'Beautiful JavaScript', 'Anton Kovalyov', 'beauty_js.jpg', 'JavaScript is arguably the most polarizing and misunderstood programming language in the world. Many have attempted to replace it as the language of the Web, but JavaScript has survived, evolved, and thrived. Why did a language created in such hurry succeed where others failed?\r\n\r\nThis guide gives you a rare glimpse into JavaScript from people intimately familiar with it. Chapters contributed by domain experts such as Jacob Thornton, Ariya Hidayat, and Sara Chipps show what they love about their favorite language - whether it\'s turning the most feared features into useful tools, or how JavaScript can be used for self-expression.', 20.00, 3),
('978-1-4571-0402-2', 'Professional ASP.NET 4 in C# and VB', 'Scott Hanselman', 'pro_asp4.jpg', 'ASP.NET is about making you as productive as possible when building fast and secure web applications. Each release of ASP.NET gets better and removes a lot of the tedious code that you previously needed to put in place, making common ASP.NET tasks easier. With this book, an unparalleled team of authors walks you through the full breadth of ASP.NET and the new and exciting capabilities of ASP.NET 4. The authors also show you how to maximize the abundance of features that ASP.NET offers to make your development process smoother and more efficient.', 20.00, 1),
('978-1-484216-40-8', 'Android Studio New Media Fundamentals', 'Wallace Jackson', 'android_studio.jpg', 'Android Studio New Media Fundamentals is a new media primer covering concepts central to multimedia production for Android including digital imagery, digital audio, digital video, digital illustration and 3D, using open source software packages such as GIMP, Audacity, Blender, and Inkscape. These professional software packages are used for this book because they are free for commercial use. The book builds on the foundational concepts of raster, vector, and waveform (audio), and gets more advanced as chapters progress, covering what new media assets are best for use with Android Studio as well as key factors regarding the data footprint optimization work process and why new media content and new media data optimization is so important.', 20.00, 4),
('978-1-484217-26-9', 'C++ 14 Quick Syntax Reference, 2nd Edition', '	Mikael Olsson', 'c_14_quick.jpg', 'This updated handy quick C++ 14 guide is a condensed code and syntax reference based on the newly updated C++ 14 release of the popular programming language. It presents the essential C++ syntax in a well-organized format that can be used as a handy reference.\r\n\r\nYou won\'t find any technical jargon, bloated samples, drawn out history lessons, or witty stories in this book. What you will find is a language reference that is concise, to the point and highly accessible. The book is packed with useful information and is a must-have for any C++ programmer.\r\n\r\nIn the C++ 14 Quick Syntax Reference, Second Edition, you will find a concise reference to the C++ 14 language syntax. It has short, simple, and focused code examples. This book includes a well laid out table of contents and a comprehensive index allowing for easy review.', 20.00, 4),
('978-1-49192-706-9', 'C# 6.0 in a Nutshell, 6th Edition', 'Joseph Albahari, Ben Albahari', 'c_sharp_6.jpg', 'When you have questions about C# 6.0 or the .NET CLR and its core Framework assemblies, this bestselling guide has the answers you need. C# has become a language of unusual flexibility and breadth since its premiere in 2000, but this continual growth means there\'s still much more to learn.\r\n\r\nOrganized around concepts and use cases, this thoroughly updated sixth edition provides intermediate and advanced programmers with a concise map of C# and .NET knowledge. Dive in and discover why this Nutshell guide is considered the definitive reference on C#.', 20.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `book_isbn` varchar(20) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`book_isbn`, `category_id`) VALUES
('567895678', 3),
('65128351235613286', 2),
('978-0-7303-1484-4', 1),
('978-0-7303-1484-4', 2),
('978-0-7303-1484-4', 11),
('978-05440034151', 2),
('978-1-118-94924-5', 1),
('978-1-118-94924-5', 2),
('978-1-118-94924-5', 17),
('978-1-1180-2669-4', 1),
('978-1-1180-2669-4', 2),
('978-1-44937-019-0', 1),
('978-1-44937-019-0', 2),
('978-1-44937-019-0', 17),
('978-1-44937-075-6', 1),
('978-1-44937-075-6', 2),
('978-1-4571-0402-2', 1),
('978-1-4571-0402-2', 2),
('978-1-484216-40-8', 1),
('978-1-484216-40-8', 2),
('978-1-484216-40-8', 20),
('978-1-484217-26-9', 1),
('978-1-484217-26-9', 2),
('978-1-484217-26-9', 19),
('978-1-49192-706-9', 1),
('978-1-49192-706-9', 2),
('978-1-49192-706-9', 19);

-- --------------------------------------------------------

--
-- Table structure for table `book_tags`
--

CREATE TABLE `book_tags` (
  `book_isbn` varchar(20) NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `book_tags`
--

INSERT INTO `book_tags` (`book_isbn`, `tag_id`) VALUES
('567895678', 32),
('65128351235613286', 45),
('978-0-7303-1484-4', 12),
('978-0-7303-1484-4', 15),
('978-05440034151', 14),
('978-1-118-94924-5', 13),
('978-1-118-94924-5', 15),
('978-1-118-94924-5', 40),
('978-1-1180-2669-4', 14),
('978-1-1180-2669-4', 31),
('978-1-1180-2669-4', 40),
('978-1-1180-2669-4', 41),
('978-1-44937-019-0', 12),
('978-1-44937-019-0', 31),
('978-1-44937-019-0', 40),
('978-1-44937-019-0', 41),
('978-1-44937-075-6', 13),
('978-1-44937-075-6', 40),
('978-1-44937-075-6', 41),
('978-1-4571-0402-2', 14),
('978-1-4571-0402-2', 40),
('978-1-4571-0402-2', 41),
('978-1-484216-40-8', 5),
('978-1-484216-40-8', 12),
('978-1-484216-40-8', 40),
('978-1-484217-26-9', 13),
('978-1-484217-26-9', 31),
('978-1-484217-26-9', 40),
('978-1-49192-706-9', 14),
('978-1-49192-706-9', 31),
('978-1-49192-706-9', 40);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Programming'),
(2, 'Technology'),
(3, 'Literary Fiction'),
(4, 'Mystery & Thriller'),
(5, 'Science Fiction'),
(6, 'Fantasy'),
(7, 'Romance'),
(8, 'Historical Fiction'),
(9, 'Biography'),
(10, 'History'),
(11, 'Science'),
(12, 'Philosophy'),
(13, 'Business'),
(14, 'Self-Help'),
(15, 'Travel'),
(16, 'Cooking'),
(17, 'Academic'),
(18, 'Language Learning'),
(19, 'Reference'),
(20, 'Art & Design'),
(21, 'Music'),
(22, 'Photography'),
(23, 'Health & Fitness'),
(25, 'Hobbies & Crafts');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(80) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `name`, `password`, `phone`, `address`, `city`, `zip_code`, `country`) VALUES
(20, 'taitap', '123', '0123', '11', '11', '11', 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ship_name` char(60) NOT NULL,
  `ship_address` char(80) NOT NULL,
  `ship_city` char(30) NOT NULL,
  `ship_zip_code` char(10) NOT NULL,
  `ship_country` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`, `ship_name`, `ship_address`, `ship_city`, `ship_zip_code`, `ship_country`) VALUES
(38, 20, 260.00, '2025-01-17 08:01:40', 'taitap', '11', '11', '11', 'Vietnam'),
(39, 20, 20.00, '2025-01-17 08:17:34', 'taitap', '11', '11', '11', 'Vietnam'),
(40, 20, 40.00, '2025-01-23 02:45:13', 'taitap', '11', '11', '11', 'Vietnam'),
(41, 20, 9999.99, '2025-01-23 08:50:43', 'taitap', '11', '11', '11', 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `book_isbn` varchar(20) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderid`, `book_isbn`, `item_price`, `quantity`) VALUES
(38, '978-1-49192-706-9', 20.00, 12),
(38, '978-1-4571-0402-2', 20.00, 1),
(39, '978-1-484217-26-9', 20.00, 1),
(40, '978-1-49192-706-9', 20.00, 1),
(40, '978-1-44937-075-6', 20.00, 1),
(41, '978-1-118-94924-5', 20.00, 255);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisherid` int(10) UNSIGNED NOT NULL,
  `publisher_name` varchar(60) NOT NULL,
  `publisher_image` varchar(40) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `website_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisherid`, `publisher_name`, `publisher_image`, `facebook_link`, `twitter_link`, `website_link`) VALUES
(1, 'Wrox', 'mark.png', NULL, NULL, NULL),
(2, 'Wiley', 'Wiley.png', NULL, NULL, NULL),
(3, 'O\'Reilly Media', 'oreilly.png', NULL, NULL, NULL),
(4, 'Apress', 'Apress.png', NULL, NULL, NULL),
(5, 'Packt Publishing', 'Packt.png', NULL, NULL, NULL),
(6, 'Addison-Wesley 1', 'addison.svg', NULL, NULL, NULL),
(9, 'Epsion', 'retail-week.svg', NULL, NULL, 'epsion.com');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `tag_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'Hardcover'),
(2, 'Paperback'),
(3, 'Ebook'),
(4, 'Audiobook'),
(5, 'Illustrated'),
(6, 'Series'),
(7, 'Anthology'),
(8, 'Children 1'),
(10, 'Adult'),
(11, 'All Ages'),
(12, 'Beginner'),
(13, 'Intermediate'),
(14, 'Advanced'),
(15, 'Academic'),
(16, 'Award Winner'),
(17, 'Bestseller'),
(18, 'Classic'),
(19, 'New Release'),
(20, 'Featured'),
(21, 'Limited Edition'),
(22, 'Career Development'),
(23, 'Personal Finance'),
(24, 'Mental Health'),
(25, 'Relationships'),
(26, 'Leadership'),
(27, 'Innovation'),
(28, 'Sustainability'),
(29, 'Political'),
(30, 'Cultural'),
(31, 'Educational'),
(32, 'Mystery'),
(33, 'Romance'),
(34, 'Adventure'),
(35, 'Horror'),
(36, 'Comedy'),
(37, 'Drama'),
(38, 'Poetry'),
(39, 'Short Stories'),
(40, 'Programming'),
(41, 'Web Development'),
(42, 'Data Science'),
(43, 'Artificial Intelligence'),
(44, 'Digital Marketing'),
(45, 'English'),
(46, 'Spanish'),
(47, 'French'),
(48, 'German'),
(49, 'Chinese'),
(50, 'Japanese');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`name`,`pass`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_isbn`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`book_isbn`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `book_tags`
--
ALTER TABLE `book_tags`
  ADD PRIMARY KEY (`book_isbn`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisherid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD CONSTRAINT `book_categories_ibfk_1` FOREIGN KEY (`book_isbn`) REFERENCES `books` (`book_isbn`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_tags`
--
ALTER TABLE `book_tags`
  ADD CONSTRAINT `book_tags_ibfk_1` FOREIGN KEY (`book_isbn`) REFERENCES `books` (`book_isbn`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
