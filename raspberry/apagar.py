import RPi.GPIO as GPIO
import time
import sys
import os
porta = int(sys.argv[1]) 
GPIO.setmode(GPIO.BCM)
GPIO.setup(porta, GPIO.OUT)
GPIO.output(porta, 0 )