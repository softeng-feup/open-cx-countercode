import RPi.GPIO as GPIO
import time
import datetime
import sys
import time
import random

# importing the requests library 
import requests 



def check_talk(talkID):
	r = requests.get("https://web.fe.up.pt/~up200900303/open-cx-countercode/CounterCodeWeb/rest/get_talk_data.php?id="+talkID)
	reply = r.json()
	return (reply['response_desc'] == 'OK')

def add_entry(talkID, timestamp, is_entry):
	pload = {'talkID':talkID, 'timestamp':timestamp, 'is_entry':is_entry}
	r = requests.post("https://web.fe.up.pt/~up200900303/open-cx-countercode/CounterCodeWeb/rest/insert_entry.php", data = pload)
	reply = r.json()
	if(reply['response_desc'] != 'OK'):
		print("Failed to add entry")

argc = len(sys.argv)

if(argc == 2):
	if(not check_talk(sys.argv[1])):
		print ("ERROR: Talk {:s} doesn't exist".format(sys.argv[1]))
		exit(-1)
else:
	print ("USAGE: {:s} <talkID>".format(sys.argv[0]))
	exit(-1)


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
			add_entry(sys.argv[1], datetime.datetime.now(), 'true')
			state = IDLE
		elif(pin1 == 0):
			state = IDLE
	elif (state == S2):
		if(pin1 == 1):
			print("Saida")
			add_entry(sys.argv[1], datetime.datetime.now(), 'false')
			state = IDLE
		elif(pin2 == 0):
			state = IDLE
	else:
		pass

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