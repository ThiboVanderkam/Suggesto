import requests
from bs4 import BeautifulSoup
import mysql.connector
from mysql.connector import Error
from scraperClass import ScraperBol



#_______________________________________________________________________________________________________ EINDE VAN DE FUNCTIES


s = ScraperBol()
s.clearEntries()
s.GetCategories()
s.closeConnection()

