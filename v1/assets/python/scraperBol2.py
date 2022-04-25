import requests
from bs4 import BeautifulSoup



# NOTE: de functie GetThem (alle data nemen) werkt niet bij producten die 18 plus zijn vanwege de andere lay out !!! °_° (so no buttplugs yet)


def DoeRequest(url):
    request = requests.get(url)
    soupBS = BeautifulSoup(request.text, "html.parser")
    #doe .prettify() erachter voor tabs
    return soupBS

def CreateLink():
    inbut = input()

    inbut = inbut.replace(" ", "+")

    begin = "https://www.bol.com/be/nl/s/?page=1&searchtext="
    eind = "&view=list&sort=popularity1"

    deLink = begin + inbut + eind
    return(deLink)

def MakeLink(product):  #dit is als alternatief als je geen input wilt

    product = product.replace(" ", "+")

    begin = "https://www.bol.com/be/nl/s/?page=1&searchtext="
    eind = "&view=list&sort=popularity1"

    deLink = begin + product + eind
    return(deLink)



def GetThem(link, hoeveelheid):
    # linkBolHome = "https://www.bol.com/be/nl/s/?page=1&searchtext=voor+hem&view=list&sort=popularity1"
    reqBolHome = DoeRequest(link)

    topItems = []
    links = []
    images = []
    prices = []
    ratings = []


    for i in range(hoeveelheid):

        # GET THE NAME------------------------------------------------------

        nameOfProduct = reqBolHome.find_all("ul", {"id": "js_items_content"})[0].find_all("li", {"class": "product-item--row js_item_root"})[i].find_all("a", {"class": "product-title px_list_page_product_click"})[0].get_text()
        topItems.append(nameOfProduct)

        # NU DE PRODUCT LINK------------------------------------------------------

        linkNaarProduct = "https://www.bol.com" + reqBolHome.find_all("div", {"class": "h-o-hidden"})[i].find_all("a", {"class": "product-image product-image--list px_list_page_product_click"})[0].get("href")
        links.append(linkNaarProduct)

        # NU DE FOTO LINK------------------------------------------------------

        linkNaarFoto = reqBolHome.find_all("div", {"class": "h-o-hidden"})[i].find_all("a", {"class": "product-image product-image--list px_list_page_product_click"})[0].find_all("img")[0]
        if(i == 0): #(de class van de eerste had een andere naam)
            linkNaarFoto = reqBolHome.find_all("div", {"class": "h-o-hidden"})[i].find_all("a", {"class": "product-image product-image--list px_list_page_product_click"})[0].find_all("img")[0].get("src")
        else:
            linkNaarFoto = reqBolHome.find_all("div", {"class": "h-o-hidden"})[i].find_all("a", {"class": "product-image product-image--list px_list_page_product_click"})[0].find_all("img")[0].get("data-src")
        images.append(linkNaarFoto)

        # NU DE PRIJS------------------------------------------------------

        priceOfProduct =  "€" + reqBolHome.find_all("ul", {"id": "js_items_content"})[0].find_all("span", {"class": "promo-price"})[i].get_text().replace("\n", "").replace(" ", ",", 1).replace(" ", "") #prijzen mooi maken
        prices.append(priceOfProduct)

        # NU DE RATINGS------------------------------------------------------

        ratingsOfProduct = reqBolHome.find_all("div", {"class": "star-rating"})[i].get("title")
        ratings.append(ratingsOfProduct)

    # print(links)
    # print(images)
    # print(prices)
    # print(ratings)
    
    # -------------------------------WRITING TO FILE-------------------------------
    # EERST CONTENT V FILE VERWIJDEREN
    # ZIE LIJN 132 => hierdoor w de contents verwijderd

    # SCHRIJF DE ITEMS NAAR FILE

    file = open("itemsCategorie.txt", "a")

    for i in range(hoeveelheid):                                                                        # bij de link moet erachter een spatie (anders w prijs meegenomen in link)
        file.write(str(topItems[i]).replace("é", "e").replace("è", "e").replace("ö", "o").replace('®', "").replace("™", "") + ";" + str(links[i])  + " " + ";" + str(images[i]) + " " + ";" + str(prices[i]).replace('€', "euro: ") + ";" + str(ratings[i]) + "\n")

        print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")
        print(str(topItems[i]) + " - " + str(links[i]) + " - " + str(images[i]) + " - " + str(prices[i]) + " - " + str(ratings[i]))
        print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")

    file.write("\n") # makkelijk categorien v elkaar te onderscheiden
    file.close()
# print(topItems + " - " + links + " - " + images + " - " + prices + " - " + ratings)

def GetCategories(lijstMetCategorien):
    for categorie in lijstMetCategorien:
        link = MakeLink(categorie)
        GetThem(link, 10)


#_______________________________________________________________________________________________________ EINDE VAN DE FUNCTIES

linkBolVoorHem = "https://www.bol.com/be/nl/s/?page=1&searchtext=voor+hem&view=list&sort=popularity1"
LinkBolVoorHaar = "https://www.bol.com/be/nl/s/?page=1&searchtext=voor+haar&view=list&sort=popularity1&rating=all"
# GetThem(LinkBolVoorHaar, 6)




# print(topItems + " - " + links + " - " + images + " - " + prices + " - " + ratings)
# roberto = reqBolHome.find_all("ul", {"id": "js_items_content"}).find_all("ul", {"id": "js_items_content"})
# roberto = reqBolHome.find("ul", {"id": "js_items_content"}).find("li", {"class": "product-item--row js_item_root"}).find("a", {"class": "product-title px_list_page_product_click"})

# linkos = "https://www.bol.com/be/nl/s/?page=1&searchtext=fortnite&view=list&sort=popularity1"
# GetThem(linkos, 4)
# linkos = "https://www.bol.com/be/nl/s/?searchtext=voor+hem"

# linkos = CreateLink()
# GetThem(linkos, 10)
# print(linkos)

# -------------- TEST V FUNCTIE getCategories --------------
open("itemsCategorie.txt", "w").close() # file leegmaken

lijstMetCategorien = ["video games", "boeken", "nature", "photo", "sports", "tech", "beauty"]
GetCategories(lijstMetCategorien)



#     https://www.bol.com/be/nl/s/?searchtext=voor+hem    op relevantie
#     https://www.bol.com/be/nl/s/?page=1&searchtext=voor+hem&view=list&sort=popularity1    op populariteit
# video games (games werkt niet lijn 42)
# boeken
# nature
# photo (photography werkt niet)
# sports
# tech
# beauty