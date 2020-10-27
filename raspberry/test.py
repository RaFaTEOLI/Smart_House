import sys
import os
path=r"c:\xampp\htdocs\smart_house\raspberry\texto.txt"
os.system('echo ' + sys.argv[1] + ' > ' + path + ' && echo foi')
