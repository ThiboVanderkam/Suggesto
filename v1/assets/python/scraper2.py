import requests
from bs4 import BeautifulSoup
import re
#problemen: prijs, dingen werken enkel op top page voor 1ste genre, niet voor de onderste 2

def DoeRequest(url):
    request = requests.get(url)
    soupBS = BeautifulSoup(request.text, "html.parser")
    #doe .prettify() erachter voor tabs
    return soupBS

# GETTING THE CATEGORIES

link1 = "https://www.amazon.nl/gp/bestsellers/?ref_=nav_cs_bestsellers" #homepagina
req = DoeRequest(link1)
categorien = req.find_all("a", {"class": "a-link-normal"})
linksArray = []
for i in categorien:
    if (i.get_text() == "Meer bekijken"): # i = categorien
        deelVanLink = i.get("href") # => /gp/bestsellers/pet-supplies
        echteLink = "https://www.amazon.nl" + deelVanLink #link vervolledigen => dit is product pagina link 
        linksArray.append(echteLink)
# print(linksArray)

# GETTING THE TOP ITEMS FROM THE CATEGORIES

# for i in range(0, 2, 1):
link2 = linksArray[1] #uit alle categorien
req2 = DoeRequest(link2)
linkNaarProduct = req.find_all("a", {"class": "a-link-normal"}) #60 = nero plat, 40 = multitude, 50 = norton, 49 = bestsellers in software , | 48 = nivana einde, 44 = andere plaat, 43 = review, 42 = ook andere plaat (ik denk vinyl), 41 = ook nog steeds andere plaat, 40 = multitude, daft punk = 28 => hele tijd - 4
tussenLink = linkNaarProduct[28].get("href") #je moet i * 5 doen
eindLink = "https://www.amazon.nl" + tussenLink #link vervolledigen => dit is product pagina link 
print(tussenLink)
print(eindLink)
# print(linksArray)