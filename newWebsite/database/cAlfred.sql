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


INSERT INTO User VALUES ("admin@esof.esof", "Admin", "$2y$10$oeuPFBhKkgw.sw7sP9L4RuuokgTgPeN7mF.s.ydriZue1lt1d10aa", 1);

INSERT INTO Room VALUES ("B001", "Edificio B Anfiteatro 001", 184);
INSERT INTO Room VALUES ("B002", "Edificio B Anfiteatro 002", 184);
INSERT INTO Room VALUES ("B003", "Edificio B Anfiteatro 003", 184);

INSERT INTO Talk VALUES (NULL, "admin@esof.esof", "B001","Git - The basics", 1576836000, 1576839600);
INSERT INTO Talk VALUES (NULL, "admin@esof.esof", "B002","Polyrhythms and math", 1576846000, 1576849600);

INSERT INTO TalkAttendance VALUES (1, 1576836032, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836034, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836036, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836038, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836040, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836042, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836044, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836046, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836048, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836050, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836052, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836054, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836056, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836058, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836060, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836062, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836064, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836066, 1);
INSERT INTO TalkAttendance VALUES (1, 1576836068, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836070, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836072, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836074, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836076, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836078, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836080, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836082, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836084, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836086, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836088, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836090, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836092, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836094, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836096, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836098, 0);
INSERT INTO TalkAttendance VALUES (1, 1576836100, 0);