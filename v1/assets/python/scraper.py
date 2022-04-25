import requests
from bs4 import BeautifulSoup
import re
#problemen: prijs, dingen werken enkel op top page voor 1ste genre, niet voor de onderste 2

def DoeRequest(url):
    request = requests.get(url)
    soupBS = BeautifulSoup(request.text, "html.parser")
    #doe .prettify() erachter voor tabs
    return soupBS

def GetTop3AmazonPets():
    print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")
    GetTopPet(0)
    print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")
    GetTopPet(1)
    print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")
    GetTopPet(2)
    print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")

# def PrintUit(dictionary):
#     for key, value in dictionary.items():
#         print(key, "=", value)

amazonBestsellersLinks = [
    "https://www.amazon.nl/gp/bestsellers/pet-supplies", #huisdieren
    # "https://www.amazon.nl/gp/bestsellers/music", #muziek
    # "https://www.amazon.nl/gp/bestsellers/software", #software
    # "https://www.amazon.nl/gp/bestsellers/fashion", #kleding, schoenen, sieraden
    # "https://www.amazon.nl/gp/bestsellers/lawn-and-garden", #tuin, terras, gazon
    # "https://www.amazon.nl/gp/bestsellers/home", #wonen, keuken

]

def GetTopPet(index):
    gebruikteIndex = index * 4 #deze moet je gebruiken bij het scrapen van de link => het vermeerderd altijd met 4
    link1 = "https://www.amazon.nl/gp/bestsellers/?ref_=nav_cs_bestsellers" #homepagina
    # link1 = "https://www.amazon.nl/gp/bestsellers/pet-supplies" #huisdieren
    # link1 = "https://www.amazon.nl/gp/bestsellers/software" #software
    # link1 = "https://www.amazon.nl/gp/bestsellers/music" #muziek
    req = DoeRequest(link1)
    names = req.find_all("a", {"class": "a-link-normal"})
    deelVanLink = names[gebruikteIndex].get("href") #deel van de link krijgen => fe /FEANDREA-krabpaal-kattenboom-lichtgrijs-PCT161W01/dp/B08XTMNMMZ/ref=zg_bs_pet-supplies_1/000-0000000-0000000?pd_rd_i=B09FKVP9S2&psc=1 # magische getal is 4
    echteLink = "https://www.amazon.nl" + deelVanLink #link vervolledigen => dit is product pagina link 
    # print(deelVanLink)
    print("link:", echteLink)                                                                                                                                                      # °_°

    # NAAM VINDEN:----
    name = req.find_all("div", {"class": "a-section a-spacing-mini _p13n-zg-list-grid-desktop_maskStyle_noop__3Xbw5"}) #dont worry, ik heb gechecked en deze link is overal zo raar
    tussenStapName = name[index].find("img")
    naamVoluit = ""
    counter = 0
    for i in str(tussenStapName):
        if(counter == 1):
            naamVoluit += i
        if(i == '\"'):
            counter += 1
    # print(counter)
    # print(tussenStap)
    naamVoluit = naamVoluit.replace("\"", "") # dont ask, dees is echt me strings proberen
    print("naam:", naamVoluit)                                                                                                                                                       # °_°

    # STAR RATING VINDEN:----
    stars = req.find_all("i", {"class": "a-icon a-icon-star-small a-star-small-4-5 aok-align-top"})
    aantalSterren = stars[index].get_text()
    print("aantal sterren:", aantalSterren)                                                                                                                                                    # °_°

    # TOTAL RATINGS:----
    totalRatings = req.find_all("span", {"class": "a-size-small"})
    aantalRatings = totalRatings[index].get_text()
    print("aantal ratings:", aantalRatings)                                                                                                                                                    # °_°


GetTop3AmazonPets()












#PRIJS VINDEN: werkt niet, oplossing hier, maar zouden we dit wel doen, je moet pip install lxml doen enz => https://stackoverflow.com/questions/61210203/beautiful-soup-selector-returns-an-empty-list
# (kijk op link in comments)

#werkt ook niet (met echteLink geprobeerd):
# reqProduct = DoeRequest(echteLink)
# prices = reqProduct.find_all("div", {"class": "a-section a-spacing-none aok-align-center"})
# print(prices)



# doesnt work (met eerste link geprobeerd):
# price = req.find_all("a",{"class": "a-link-normal a-text-normal"})
# price = req.find_all("span", {"class": "_a-size-base a-color-price"}) #dont worry, ik heb gechecked en deze link is overal zo raar
# ding = requests.get("https://www.amazon.nl/gp/bestsellers/pet-supplies")
# soupy = BeautifulSoup(ding.text, "lxml")
# price = req.find_all("span", {"class": "_p13n-zg-list-grid-desktop_price_p13n-sc-price__3mJ9Z"}) #dont worry, ik heb gechecked en deze link is overal zo raar
# print(price)

# tussenStapPrice = price[0].find()