INSERT INTO Room (roomID, roomName, roomSeats, roomAvailable)
values("B304", "Sala 304", 20, 20);

INSERT INTO Room (roomID, roomName, roomSeats, roomAvailable)
values("B303", "Sala 303", 25, 25);

SELECT * FROM Room;

INSERT INTO Entries (timestamp, is_entry, room)
values(1000, 1, "B303");

INSERT INTO Entries (timestamp, is_entry, room)
values(1001, 0, "B304");

SELECT * FROM Entries;


SELECT roomName, roomSeats, is_entry, timestamp FROM Entries NATURAL JOIN Room WHERE roomName == "Sala 304";