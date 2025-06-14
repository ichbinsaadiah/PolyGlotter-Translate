SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS translations;
CREATE TABLE translations (
  id int(11) NOT NULL,
  user_id int(11) DEFAULT NULL,
  source_text text NOT NULL,
  translated_text text NOT NULL,
  source_language varchar(10) DEFAULT NULL,
  target_language varchar(10) DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE translations
  ADD PRIMARY KEY (id),
  ADD KEY user_id (user_id);

ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY username (username),
  ADD UNIQUE KEY email (email);


ALTER TABLE translations
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
