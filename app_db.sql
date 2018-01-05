SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `app_db`
--
CREATE DATABASE IF NOT EXISTS `app_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `app_db`;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'new',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_date` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `title`, `description`, `status`, `create_date`, `task_date`) VALUES
(1, 'Grocery!!!', 'Buy some foods and drinks for this week.', 'done', '2018-01-04 17:49:14', '2018-01-08'),
(2, 'Finish Exam by Friday', 'Create a to do list app with a rest api backend running in php, and display it in a frontend using vuejs.', 'done', '2018-01-04 17:50:28', '2018-01-09'),
(23, 'Add api buttons', 'Add update and delete in the UI.', 'done', '2018-01-05 05:02:24', '2018-01-04'),
(29, 'Docker', 'Create Docker file', 'new', '2018-01-05 05:10:35', '2018-01-05'),
(30, 'Gitlab.....', 'Uploading time.', 'new', '2018-01-05 05:11:02', '2018-01-05'),
(24, 'Check CSS', 'Check all design.', 'done', '2018-01-05 05:11:21', '2018-01-05'),
(28, 'Mobile view', 'Create mobile view.', 'done', '2018-01-05 05:11:27', '2018-01-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
