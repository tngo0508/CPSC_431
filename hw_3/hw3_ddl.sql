DROP DATABASE IF EXISTS CPSC_431_HW3;
CREATE DATABASE IF NOT EXISTS CPSC_431_HW3;
DROP USER IF EXISTS 'thomas'@'localhost';
GRANT SELECT, INSERT, DELETE, UPDATE
ON CPSC_431_HW3.*
TO 'thomas'@'localhost' IDENTIFIED BY 'me123';
USE CPSC_431_HW3;

CREATE TABLE TeamRoster
(
  ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name_First VARCHAR(100),
  Name_Last VARCHAR(150) NOT NULL,
  Street VARCHAR(250),
  City VARCHAR(100),
  State VARCHAR(100),
  Country VARCHAR(100),
  ZipCode CHAR(10),

  CONSTRAINT CHK_ZipCode CHECK (ZipCode REGEXP '(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?')
);

CREATE INDEX lastname ON TeamRoster(Name_Last);
CREATE UNIQUE INDEX fullname ON TeamRoster(Name_First, Name_Last);

INSERT INTO TeamRoster VALUES
(100, 'Donald', 'Duck', '1313 S. Harbor Blvd.', 'Anaheim', 'CA', 'USA', '92808-3232'),
(101, 'Daisy', 'Duck', '1180 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830'),
(102, 'Mickey', 'Mouse', '1313 S.Harbor Blvd.', 'Anaheim', 'CA', 'USA', '92808-3232'),
(103, 'Pluto', 'Dog', '1313 S. Harbor Blvd.', 'Anaheim', 'CA', 'USA', '92808-3232'),
(104, 'Scrooge', 'McDuck', '1180 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830'),
(105, 'Huebert (Huey)', 'Duck', '1110 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830'),
(106, 'Deuteronomy (Dewey)', 'Duck', '1180 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830'),
(107, 'Louie', 'Duck', '1180 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830'),
(108, 'Phooey', 'Duck', '1-1 Maihama Urayasu', 'Chiba Prefecture', 'Disney Tokyo', 'Japan', NULL),
(109, 'Della', 'Duck', '77700 Boulevard du Parc', 'Coupvray', 'Disney Paris', 'France', NULL);

CREATE TABLE Statistics
(
  ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Player INT(10) UNSIGNED NOT NULL,
  PlayingTimeMin TINYINT(2) UNSIGNED DEFAULT 0,
  PlayingTimeSec TINYINT(2) UNSIGNED DEFAULT 0,
  Points TINYINT(3) UNSIGNED DEFAULT 0,
  Assists TINYINT(3) UNSIGNED DEFAULT 0,
  Rebounds TINYINT(3) UNSIGNED DEFAULT 0,

  CONSTRAINT FK_Player FOREIGN KEY (Player) REFERENCES TeamRoster(ID),
  CONSTRAINT CHK_PlayingTimeMin CHECK (PlayingTimeMin <= 40),
  CONSTRAINT CHK_PlayingTimeSec CHECK (PlayingTimeSec < 60)
);

INSERT INTO Statistics VALUES
(17, 100, 35, 12, 47, 11, 21),
(18, 102, 13, 22, 13, 1, 3),
(19, 103, 10, 0, 18, 2, 4),
(20, 107, 2, 45, 9, 1, 2),
(21, 102, 15, 39, 26, 3, 7),
(22, 100, 29, 47, 27, 9, 8);
