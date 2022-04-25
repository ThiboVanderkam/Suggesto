DROP DATABASE IF EXISTS suggesto;
CREATE DATABASE suggesto;

USE suggesto;

DROP TABLE IF EXISTS user;
CREATE TABLE user (
	u_isverified INT DEFAULT 0, #0 is not verified, 1 is verified
    u_firstname VARCHAR(100) NOT NULL,
    u_lastname VARCHAR(100) NOT NULL,
    u_dob DATE NOT NULL,
    u_email VARCHAR(100) NOT NULL UNIQUE,
    u_password VARCHAR(500) NOT NULL,
    u_id INT NOT NULL UNIQUE,
    PRIMARY KEY(u_id)
);

DROP TABLE IF EXISTS gender;
CREATE TABLE gender (
	g_gender VARCHAR(100) NOT NULL,
    g_id INT NOT NULL UNIQUE,
    FOREIGN KEY (g_id) REFERENCES user(u_id)
);

DROP TABLE IF EXISTS platforms;
CREATE TABLE platforms (
	platformname VARCHAR(100) NOT NULL UNIQUE,
    link VARCHAR(100) NOT NULL,
    PRIMARY KEY(link)
);

DROP TABLE IF EXISTS events;
CREATE TABLE events (
	eventname VARCHAR(100) NOT NULL UNIQUE,
    eventdate VARCHAR(20) NOT NULL,
    e_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    PRIMARY KEY(e_id)
);

DROP TABLE IF EXISTS localfriends;
CREATE TABLE localfriends (
	local_id INT NOT NULL UNIQUE,
    l_firstname VARCHAR(100) NOT NULL,
    l_lastname VARCHAR(100) NOT NULL,
    l_dob DATE NOT NULL
    
);

DROP TABLE IF EXISTS interests;
CREATE TABLE interests (
	keywords INT NOT NULL,
    userpref INT NOT NULL
);

DROP TABLE IF EXISTS favourites;
CREATE TABLE favourites (
	friend_id INT NOT NULL,
    item VARCHAR(100) NOT NULL,
    u_fav INT NOT NULL,
    PRIMARY KEY(friend_id, item)
);

DROP TABLE IF EXISTS isfriendswith;

CREATE TABLE isfriendswith (
	u_id1 INT NOT NULL,
    u_id2 INT NOT NULL,
    FOREIGN KEY (u_id1) REFERENCES user(u_id),
	FOREIGN KEY (u_id2) REFERENCES user(u_id)
    
);

ALTER TABLE user
	ADD FOREIGN KEY (local_friend) REFERENCES localfriends(local_id);
ALTER TABLE interests
	ADD FOREIGN KEY (userpref) REFERENCES user(u_id);
ALTER TABLE favourites
	ADD FOREIGN KEY (u_fav) REFERENCES user(u_id);


