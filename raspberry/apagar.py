
import RPi.GPIO as GPIO 
import time 
import sys 
import os 
porta = int(sys.argv[1]) 
GPIO.setmode(GPIO.BOARD) 
GPIO.setwarnings(False) 
GPIO.setup(porta, GPIO.OUT) 
 
def desligar(): 
    GPIO.output(porta, GPIO.LOW) 
 
if __name__ == "__main__": 
    desligar()