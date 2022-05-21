import requests
from bs4 import BeautifulSoup
import mysql.connector
from mysql.connector import Error

class ScraperBol():
    lijstMetCategorien = ["video games", "nature", "photo", "sports", "tech", "beauty"]
    def __init__(self):
        self.connection = mysql.connector.connect(host='ID362561_suggesto.db.webhosting.be',
                                         database='ID362561_suggesto',
                                         user='ID362561_suggesto',
                                         password='InspirationLab2022')
        

    def MysqlConnection(self, name, link, prijs, fotoLink, preference):
        try:
            connection = self.connection
            if connection.is_connected():
                db_Info = connection.get_server_info()
                print("Connected", db_Info, "[SUCCES]")

                cursor = connection.cursor()
                
                cursor.execute("INSERT INTO gifts(name, link, prijs, fotoLink, preference) VALUES(" + "\""+ name + "\"" + ", " + "\"" +link + "\"" + ", " + prijs + ", " + "\"" + fotoLink + "\"" + ", " +"\""+ preference + "\"" + ");")
                connection.commit()
                cursor.close()     
        except Error as e:
            print("Error while connecting to MySQL", e)


    def DoeRequest(self, url):
        request = requests.get(url)
        soupBS = BeautifulSoup(request.text, "html.parser")
        return soupBS


    def MakeLink(self, product):  #dit is als alternatief als je geen input wilt

        product = product.replace(" ", "+")

        begin = "https://www.bol.com/be/nl/s/?page=1&searchtext="
        eind = "&view=list&sort=popularity1"

        deLink = begin + product + eind
        return(deLink)

    def GetThem(self, link, hoeveelheid, preference):
        reqBolHome = self.DoeRequest(link)
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


        #querry doen naar database: ----------------------

        for i in range(hoeveelheid):
            queryString = ('''INSERT INTO gifts (name, link, prijs, fotoLink, preference) VALUES (''' + "\"" + str(topItems[i]).replace("é", "e").replace("è", "e").replace("ö", "o").replace('®', "").replace("™", "")+ "\"" + ", " + "\"" + str(links[i]) + " \"" + ", " + str(float(prices[i].replace('€', "").replace(",", ".").replace("-", ""))) + ", " + "\"" + str(images[i]) + " \"" + "," + " \"" + str(preference) + "\"" ''')''') + ";"

            name = str(topItems[i]).replace("é", "e").replace("è", "e").replace("ö", "o").replace('®', "").replace("™", "")
            prodLink = str(links[i])
            price = str(float(prices[i].replace('€', "").replace(",", ".").replace("-", "")))
            fotoLink = str(images[i])
            pref = str(preference)


            quer1 = "INSERT INTO gifts (name, link, prijs, fotoLink, preference) VALUES (%s, %s, %f, %s, %s)"
            val =  (str(name), str(prodLink), float(price), str(fotoLink), str(pref))

            self.MysqlConnection(name, prodLink, price, fotoLink, pref)


    def GetCategories(self):

        for categorie in self.lijstMetCategorien:
            preference = categorie
            link = self.MakeLink(categorie)
            self.GetThem(link, 10, preference)

    def clearEntries(self):
        connection = self.connection
        if connection.is_connected():
            db_Info = connection.get_server_info()
            print("Connected", db_Info, "[SUCCES]")

            cursor = connection.cursor()
            cursor.execute("DELETE FROM gifts WHERE 1;")
            connection.commit()

    def closeConnection(self):
        self.connection.close()