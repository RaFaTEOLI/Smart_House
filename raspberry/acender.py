import RPi.GPIO as GPIO 
import time 
import sys 
import os
porta = int(sys.argv[1]) 
GPIO.setmode(GPIO.BOARD) 
GPIO.setwarnings(False) 
GPIO.setup(porta, GPIO.OUT) 

def ligar(): 
    GPIO.output(porta, GPIO.HIGH) 

if __name__ == "__main__": 
    ligar()