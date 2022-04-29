import requests
from bs4 import BeautifulSoup
import mysql.connector
from mysql.connector import Error

# NOTE: de functie GetThem (alle data nemen) 

def MysqlConnection(name, link, prijs, fotoLink, preference):
    try:
        connection = mysql.connector.connect(host='ID362561_suggesto.db.webhosting.be',
                                         database='ID362561_suggesto',
                                         user='ID362561_suggesto',
                                         password='InspirationLab2022')
        if connection.is_connected():
            db_Info = connection.get_server_info()
            print("Connected to MySQL Server version ", db_Info)
            cursor = connection.cursor()
            # cursor.execute("select database();")
            # record = cursor.fetchone()
            # print("You're connected to database: ", record)

            cursor = connection.cursor()
            cursor.execute("INSERT INTO gifts(name, link, prijs, fotoLink, preference) VALUES(" + "\""+ name + "\"" + ", " + "\"" +link + "\"" + ", " + prijs + ", " + "\"" + fotoLink + "\"" + ", " +"\""+ preference + "\"" + ");")
            connection.commit()
            # cursor.execute(str(query), val)


            # cursor.execute("SELECT * FROM gifts;")
            # res = cursor.fetchall()
            # for line in res:
            #     print(res)
            
            #cursor.fetchall() => geeft alle dingen terug als je info vraagt aan DB

    except Error as e:
        print("Error while connecting to MySQL", e)




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

def GetThem(link, hoeveelheid, preference):
    # linkBolHome = "https://www.bol.com/be/nl/s/?page=1&searchtext=voor+hem&view=list&sort=popularity1"
    reqBolHome = DoeRequest(link)
    print(link)
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

    
    # -------------------------------WRITING TO FILE-------------------------------
    # EERST CONTENT V FILE VERWIJDEREN
    # ZIE LIJN 132 => hierdoor w de contents verwijderd

    # SCHRIJF DE ITEMS NAAR FILE

    file = open("itemsCategorie.txt", "a")

    for i in range(hoeveelheid):                                                                        # bij de link moet erachter een spatie (anders w prijs meegenomen in link)
        file.write(str(topItems[i]).replace("é", "e").replace("è", "e").replace("ö", "o").replace('®', "").replace("™", "") + ";" + str(links[i])  + " " + ";" + str(images[i]) + " " + ";" + str(prices[i]).replace('€', "euro: ") + ";" + str(ratings[i]) + "\n")

        # print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")
        # print(str(topItems[i]) + " - " + str(links[i]) + " - " + str(images[i]) + " - " + str(prices[i]) + " - " + str(ratings[i]))
        # print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~")

    file.write("\n") # makkelijk categorien v elkaar te onderscheiden
    file.close()

    #querry doen naar database: ----------------------

    for i in range(hoeveelheid):
        queryString = ('''INSERT INTO gifts (name, link, prijs, fotoLink, preference) VALUES (''' + "\"" + str(topItems[i]).replace("é", "e").replace("è", "e").replace("ö", "o").replace('®', "").replace("™", "")+ "\"" + ", " + "\"" + str(links[i]) + " \"" + ", " + str(float(prices[i].replace('€', "").replace(",", ".").replace("-", ""))) + ", " + "\"" + str(images[i]) + " \"" + "," + " \"" + str(preference) + "\"" ''')''') + ";"
        # print(queryString)

        name = str(topItems[i]).replace("é", "e").replace("è", "e").replace("ö", "o").replace('®', "").replace("™", "")
        prodLink = str(links[i])
        price = str(float(prices[i].replace('€', "").replace(",", ".").replace("-", "")))
        fotoLink = str(images[i])
        pref = str(preference)

        #quer = "INSERT INTO gifts (" + name + ", " + prodLink + ", " + price + ", " + fotoLink + ", " + pref + ");"

        quer1 = "INSERT INTO gifts (name, link, prijs, fotoLink, preference) VALUES (%s, %s, %f, %s, %s)"
        val =  (str(name), str(prodLink), float(price), str(fotoLink), str(pref))

        MysqlConnection(name, prodLink, price, fotoLink, pref)
    # def MysqlConnection(name, link, prijs, fotoLink, preference):



# print(topItems + " - " + links + " - " + images + " - " + prices + " - " + ratings)

def GetCategories(lijstMetCategorien):
    for categorie in lijstMetCategorien:
        preference = categorie
        link = MakeLink(categorie)
        GetThem(link, 10, preference)
    


#_______________________________________________________________________________________________________ EINDE VAN DE FUNCTIES

linkBolVoorHem = "https://www.bol.com/be/nl/s/?page=1&searchtext=voor+hem&view=list&sort=popularity1"
LinkBolVoorHaar = "https://www.bol.com/be/nl/s/?page=1&searchtext=voor+haar&view=list&sort=popularity1&rating=all"


# -------------- TEST V FUNCTIE getCategories --------------
open("itemsCategorie.txt", "w").close() # file leegmaken

lijstMetCategorien = ["video games", "boeken", "nature", "photo", "sports", "tech", "beauty"]
GetCategories(lijstMetCategorien)

# MysqlConnection()

