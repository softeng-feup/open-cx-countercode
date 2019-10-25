# The following code requiers gpiozero module:
# pip install gpiozero

import time

from gpiozero import MotionSensor


pir = MotionSensor(4)

while True:
    if pir.motion_detected:
        print('Motion detected')
        time.sleep(1)
