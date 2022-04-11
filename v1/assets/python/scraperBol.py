import requests
from bs4 import BeautifulSoup

def DoeRequest(url):
    request = requests.get(url)
    soupBS = BeautifulSoup(request.text, "html.parser")
    #doe .prettify() erachter voor tabs
    return soupBS

linkBolHome = "https://www.bol.com/nl/nl/"
reqBolHome = DoeRequest(linkBolHome)

trendingProducten = reqBolHome.find_all("ol", {"class": "filmstrip"})

trendingProd1 = reqBolHome.find_all("div", {"class": "product-item__content"})
trendingProd1Span = reqBolHome.find_all("span", {"class": "truncate"})
# trendingProd1Span = reqBolHome.find_all("a", {"class": "product-titleproduct-title--placeholder"})

productContent = reqBolHome.find_all("div", {"class": "product-item__content"})
productContent2 = reqBolHome.find("div", {"class": "product-item__content"})


# print(productContent[0].find("div", {"class": "product-title product-title--placeholder"}).find("span", {"class": "truncate"}))
# ding = (productContent[0].find("div", {"class": "product-title product-title--placeholder"}).find("span", {"class": "truncate"}))
# print(ding.span.extract())   

# spanContent = []
# for spanneke in trendingProd1:
#     content = spanneke.find_all("span", {"class": "truncate"})
#     for i in content:
#         spanContent.append(i.get_text())
#         for y in spanContent:
#             print(y.get_text())

# print(spanContent)