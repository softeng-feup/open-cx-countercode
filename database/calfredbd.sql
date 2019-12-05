PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Entries;
DROP TABLE IF EXISTS Room;

CREATE TABLE Room (
    roomID TEXT PRIMARY KEY,
    roomName TEXT NOT NULL UNIQUE,
    roomSeats INTEGER NOT NULL,
    roomAvailable INTEGER NOT NULL
);

CREATE TABLE Entries (
    entryID INTEGER PRIMARY KEY,
    timestamp DATETIME NOT NULL UNIQUE,
    is_entry BOOLEAN NOT NULL,
    room TEXT NOT NULL,
    FOREIGN KEY (room) REFERENCES Room(roomID)
);