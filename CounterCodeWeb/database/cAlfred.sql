PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Room;
DROP TABLE IF EXISTS Talk;
DROP TABLE IF EXISTS TalkAttendance;

CREATE TABLE User (
    email TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    hash TEXT NOT NULL UNIQUE,
    is_admin BOOLEAN DEFAULT 0
);

CREATE TABLE Room (
    roomID TEXT PRIMARY KEY,
    roomName TEXT NOT NULL UNIQUE,
    roomSeats INTEGER NOT NULL
);

CREATE TABLE Talk (
    talkID INTEGER PRIMARY KEY,
    email TEXT NOT NULL,
    roomID TEXT NOT NULL,
    title TEXT NOT NULL,
    date_start DATETIME NOT NULL,
    date_end DATETIME NOT NULL,
    UNIQUE(email, roomID, date_start),
    FOREIGN KEY (email) REFERENCES User(email),
    FOREIGN KEY (roomID) REFERENCES Room(roomID)
);

CREATE TABLE TalkAttendance (
    talkID INTEGER NOT NULL,
    timestamp DATETIME NOT NULL UNIQUE,
    is_entry BOOLEAN NOT NULL,
    FOREIGN KEY (talkID) REFERENCES Talk(talkID)
);

CREATE TABLE TalkRating (
    talkID INTEGER NOT NULL,
    rating INTEGER DEFAULT NULL,
    CHECK(rating BETWEEN 1 AND 5 OR rating is NULL),
    FOREIGN KEY (talkID) REFERENCES Talk(talkID)
);

INSERT INTO User VALUES ("admin@esof.esof", "Admin", "$2y$10$oeuPFBhKkgw.sw7sP9L4RuuokgTgPeN7mF.s.ydriZue1lt1d10aa", 1);
INSERT INTO User VALUES ("speaker1@esof.esof", "John Doe", "$2y$10$p40WrO1QQQBBvTPzznQNDuNJvgOfmJzBSgdE.IU131Jf7UR4PKgLm", 0);
INSERT INTO User VALUES ("speaker2@esof.esof", "Jane Doe", "$2y$10$kpe65Uqu/81jYfcDozueCe4toGbmADwUJuhJsPD7X7qCLK5idtNHa", 0);
INSERT INTO User VALUES ("speaker3@esof.esof", "Jon Doe", "$2y$10$2TOX7sIHNWe6u/22TvVIGu6noKnUSCwxCCFqDl8BSpooXLwExLKSC", 0);
INSERT INTO User VALUES ("speaker4@esof.esof", "Janet Doe", "$2y$10$d.YScbROoyIvPMlmDoCV6ODlZznicsP5jFtROo9rSC1gjBrJnspVe", 0);

INSERT INTO Room VALUES ("B001", "Edificio B Anfiteatro 001", 184);
INSERT INTO Room VALUES ("B002", "Edificio B Anfiteatro 002", 184);
INSERT INTO Room VALUES ("B003", "Edificio B Anfiteatro 003", 184);

INSERT INTO Talk VALUES (NULL, "speaker1@esof.esof", "B001","Git - The basics", 1576836000, 1576839600);
INSERT INTO Talk VALUES (NULL, "speaker2@esof.esof", "B002","Polyrhythms and math", 1576846000, 1576849600);
INSERT INTO Talk VALUES (NULL, "speaker3@esof.esof", "B002","Marine biology and python", 1576690200, 1576695600);
INSERT INTO Talk VALUES (NULL, "speaker4@esof.esof", "B002","How to sleep better", 1576866000, 1576869600);

INSERT INTO TalkRating VALUES (1, 5);
INSERT INTO TalkRating VALUES (1, 4);
INSERT INTO TalkRating VALUES (1, 4);
INSERT INTO TalkRating VALUES (1, 3);
INSERT INTO TalkRating VALUES (1, 2);
INSERT INTO TalkRating VALUES (1, 2);
INSERT INTO TalkRating VALUES (1, 1);
INSERT INTO TalkRating VALUES (1, 1);
INSERT INTO TalkRating VALUES (1, 1);


INSERT INTO TalkAttendance VALUES (1, 1576836032, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836034, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836036, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836038, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836040, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836042, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836044, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836046, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836048, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836050, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836052, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836054, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836056, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836058, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836060, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836062, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836064, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836066, 'true');
INSERT INTO TalkAttendance VALUES (1, 1576836068, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836070, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836072, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836074, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836076, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836078, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836080, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836082, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836084, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836086, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836088, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836090, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836092, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836094, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836096, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836098, 'false');
INSERT INTO TalkAttendance VALUES (1, 1576836100, 'false');