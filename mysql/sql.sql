<!--USER_ACCOUNT TABLE-->
CREATE TABLE users_account(
  Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(200) NOT NULL,
  username VARCHAR(50) NOT NULL,
  profile_img VARCHAR(100) NOT NULL,
  password VARCHAR(50) NOT NULL,
  hash VARCHAR(40) NOT NULL,
  emailVerified TINYINT(1) NOT NULL,
  active TINYINT(1) NOT NULL,
  date_registered DATETIME NOT NULL,
  last_seen DATETIME NOT NULL
);

-- STATUS
CREATE TABLE status_post(
  status_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  userId int(11) NOT NULL,
  status TEXT NOT NULL,
  date_posted datetime NOT NULL
);

-- COMMENTS
CREATE TABLE comments(
	Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    statusId int(11) not null,
    userId int(11) NOT NULL,
    comment text not null,
    date_commented datetime not null
);

-- myfriends table
CREATE TABLE `myfriends` (
  `Id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `myId` int(11) NOT NULL,
  `myfriends` int(11) NOT NULL
);


-- friendship
CREATE TABLE `friendship` (
  `Id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL
);


-- message
CREATE TABLE `messages` (
  `messageId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `date` timestamp NOT NULL,
   sender_read varchar(3) not null,
   receiver_read varchar(3) not null,
   sender_delete tinyint(1) not null,
   receiver_delete tinyint(1) not null
);


-- LIKE AND UNLIKES
CREATE TABLE like_unlike(
	Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    userId int(11) not null,
    statusId int(11) not null,
    like_value varchar(20) not null
);


-- news comment table
CREATE TABLE news_comments (
	Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    userId int(11) not null,
    unique_no int(11) not null,
    comment text not null,
    `time` timestamp not null
);


-- news like table
CREATE TABLE news_likes(
	Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    news_unique_no int(11) not null,
    ip_address varchar(100) not null
);


-- quote table
CREATE TABLE quotes (
	Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    userId int(11) not null,
    quote varchar(255) not null,
    time datetime not null
);
