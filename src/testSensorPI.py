import RPi.GPIO as GPIO
import time
import datetime
import sqlite3
import sys

conn = None
db_cursor = None

check_room_query = 'SELECT roomID FROM Room WHERE roomID=?'
add_room_query = """INSERT INTO 'Room' ('roomID', 'roomName', 'roomSeats', 'roomAvailable') VALUES(?, ?, ?, ?);"""
add_entry_query = """INSERT INTO 'Entries' ('timestamp', 'is_entry', 'room') values(?, ?, ?);"""

def commit_database():
    if(conn != None):
        conn.commit()

def exec_query(query, data_tuple):
    if(connect_database()):
        db_cursor.execute(query, data_tuple)
        return True
    else:
        return False

def connect_database():
    global conn
    global db_cursor

    if(conn == None):
        conn = sqlite3.connect('calfred.db')
        if(db_cursor != None): db_cursor.close()
        db_cursor = conn.cursor()
    elif(db_cursor == None):
        db_cursor = conn.cursor()

    return (db_cursor != None)

def close_database():
    if(db_cursor != None):
        db_cursor.close()

    if(conn != None):
        db_cursor.close()

def check_room(roomID):
    if(exec_query(check_room_query, (roomID,))):
        got_room = db_cursor.fetchone()
        print(got_room)
        return (got_room != None)
    else:
        return False

def add_room(roomID, roomName, roomSeats):
    if(not check_room(roomID)):
        room_data = (roomID, roomName, roomSeats, roomSeats)
        if(exec_query(add_room_query, room_data)):
            conn.commit()
            return True
    return False

def add_entry(timestamp, is_entry, roomID):
    entry_data = (timestamp, is_entry, roomID)
    if(exec_query(add_entry_query, entry_data)):
        conn.commit()
        return True
    return False





connect_database()

argc = len(sys.argv)

if(argc == 2):
    check_room(sys.argv[1])
elif(argc == 4):
    add_room(sys.argv[1], sys.argv[2], sys.argv[3])
else:
    print ("USAGE: {:s} <roomID>".format(sys.argv[0]))
    print ("USAGE: {:s} <roomID> <roomName> <roomSeats>".format(sys.argv[0]))


# Database
# sqlite_insert_with_param = """INSERT INTO 'Entries'
#                           ('timestamp', 'is_entry') 
#                           VALUES (?, ?);"""

# sqlite_insert_with_param = """INSERT INTO 'Entries' ('timestamp', 'is_entry', 'room')
# values(?, ?, ?);"""

probePin = 18
probePin_btn = 17
GPIO.setmode(GPIO.BCM)
GPIO.setup(probePin, GPIO.IN)
GPIO.setup(probePin_btn, GPIO.IN)

# States
IDLE = 0
S1 = 1
S2 = 2
state = IDLE
state_names = {
  0: "IDLE",
  1: "S1",
  2: "S2"
}

# Pin readings
pin = 0
pin_btn = 0
count0 = 0
count1 = 0

# Timer vars
timer = 60
timerElapsed = 0
lastTime = time.time()
moveTime = 9999
pulse = 0
pulseTimer = 0.1

def statemachine(pin1, pin2):
    global state
    if (state == IDLE):
        if(pin1 == pin2): return
        state = S1 if (pin1 > pin2) else S2
    elif (state == S1):
        if(pin2 == 1):
            print("Entrada")
            add_entry(datetime.datetime.now(), 1, sys.argv[1])
            # data_tuple = (datetime.datetime.now(), 1, sys.argv[1])
            # db_cursor.execute(sqlite_insert_with_param, data_tuple)
            # conn.commit()
            state = IDLE
        elif(pin1 == 0):
            state = IDLE
    elif (state == S2):
        if(pin1 == 1):
            print("Saida")
            add_entry(datetime.datetime.now(), 0, sys.argv[1])
            # data_tuple = (datetime.datetime.now(), 0, sys.argv[1])
            # db_cursor.execute(sqlite_insert_with_param, data_tuple)
            # conn.commit()
            state = IDLE
        elif(pin2 == 0):
            state = IDLE
    else:
        pass

    # global state
    # if (state == IDLE):
    #     print("IDLE")
    #     if(pin1 == 1 and pin2 == 0):
    #         state = S1
    #     elif(pin1 == 0 and pin2 == 1):
    #         state = S2
    # elif (state == S1):
    #     print("S1")
    #     if(pin2 == 1):
    #         print("Entrada")
    #         state = IDLE
    #     elif(pin1 == 0):
    #         state = IDLE
    # elif (state == S2):
    #     print("S2")
    #     if(pin1 == 1):
    #         print("Saida")
    #         state = IDLE
    #     elif(pin2 == 0):
    #         state = IDLE
    # else:
    #     pass


while(timerElapsed < timer ):
    tNow = time.time()
    deltaTime = tNow - lastTime
    lastTime = tNow
    timerElapsed += deltaTime

    pulse += deltaTime
    if(pulse >= pulseTimer):
        pulse = 0
        pin = GPIO.input(probePin)
        pin_btn = GPIO.input(probePin_btn)

        statemachine(pin, pin_btn)
        print ("State: {:4s} | S: {:1s} | B:  {:1s}".format(state_names.get(state), str(pin), str(pin_btn)))


        # if(pin == 1):
        #     count1 += 1
        # elif(pin == 0):
        #     count0 += 1

        # if(state == IDLE and pin == 1):
        #     state = S1
        #     start = time.time()
        #     print("IDLE to S1")
        
        # elif (state == S1 and pin == 0):
        #     end = time.time()
        #     moveTime = end - start
        #     if(moveTime > 0.001):
        #         state = IDLE
        #         print("S1 to idle")
        #         print("MOVE" + str(moveTime))

                # data_tuple = (datetime.datetime.now(), 1)
                # db_cursor.execute(sqlite_insert_with_param, data_tuple)
                # conn.commit()

close_database()