-- user table
CREATE TABLE admin(
  Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(200) NOT NULL,
  password VARCHAR(50) NOT NULL,
  hash VARCHAR(40) NOT NULL,
  profile_img VARCHAR(100) NOT NULL,
  emailVerified TINYINT(1) NOT NULL,
  active TINYINT(1) NOT NULL,
  date_registered timestamp NOT NULL
);

-- news
CREATE TABLE news(
	Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    full_name varchar(100) not null,
    unique_no int(11) not null,
    news_title varchar(255) not null,
    news_desc text not null,
    news_img varchar(255) not null,
    `date` timestamp not null
);

-- news single
CREATE TABLE news_single(
    Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    full_name varchar(100) not null,
    unique_no int(11) not null,
    news_title varchar(255) not null,
    news_desc text not null,
    news_img varchar(255) not null,
    `date` timestamp not null
);
