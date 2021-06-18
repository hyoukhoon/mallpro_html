import requests
from bs4 import BeautifulSoup as bs
from selenium import webdriver
import pymysql
from datetime import datetime
import datetime
import sys
import os
import json
import re
import random
from pprint import pprint
import urllib.request
import urllib.parse
from urllib.parse import quote
import urllib3
import time
import hashlib
import wget
from pyvirtualdisplay import Display
conn = pymysql.connect(host='localhost', user='mallpro', password='soon06051007?!', db='mallpro', charset='utf8')
curs = conn.cursor()
curs2 = conn.cursor()
curs3 = conn.cursor()

def set_user_agent():
    USER_AGENTS = [
        "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)",
        "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 1.0.3705; .NET CLR 1.1.4322)",
        "Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2; .NET CLR 3.0.04506.30)",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN) AppleWebKit/523.15 (KHTML, like Gecko, Safari/419.3) Arora/0.3 (Change: 287 c9dfb30)",
        "Mozilla/5.0 (X11; U; Linux; en-US) AppleWebKit/527+ (KHTML, like Gecko, Safari/419.3) Arora/0.6",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2pre) Gecko/20070215 K-Ninja/2.1.1",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9) Gecko/20080705 Firefox/3.0 Kapiko/3.0",
        "Mozilla/5.0 (X11; Linux i686; U;) Gecko/20070322 Kazehakase/0.4.5"
    ]

    user_agent = random.choice(USER_AGENTS)
    return user_agent

class TaoBao:
    def __init__(self):
        
        self.test_url='https://s.taobao.com/search?q=厨具&type=p&tmhkh5=&spm=a21wu.241046-kr.a2227oh.d100&from=sea_1_searchbutton&catId=100&bcoffset=3&ntoffset=3&p4ppushleft=1%2C48&s=0'
        self.headers={"Origin":"https://login.taobao.com",
            "Upgrade-Insecure-Requests":"1",
            "Content-Type":"application/x-www-form-urlencoded",
            "Accept":"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
            "Referer":"https://login.taobao.com/member/login.jhtml?redirectURL=https%3A%2F%2Fwww.taobao.com%2F",
            "Accept-Encoding":"gzip, deflate, br",
            "Accept-Language":"zh-CN,zh;q=0.9",
            "User-Agent":set_user_agent()}
        self.cookies = {}    
        self.res_cookies_txt = "" 
        

    def read_cookies(self):
        with open("tc.txt",'r',encoding='utf-8') as f:
            cookies_txt = f.read().strip(';')  #读取文本内容
            #由于requests只保持 cookiejar 类型的cookie，而我们手动复制的cookie是字符串需先将其转为dict类型后利用requests.utils.cookiejar_from_dict转为cookiejar 类型
            #手动复制的cookie是字符串转为字典：
            for item in cookies_txt.split(';'):
                name,value=item.strip().split('=',1)  #用=号分割，分割1次
                self.cookies[name]=value  #为字典cookies添加内容
        #将字典转为CookieJar：
        cookiesJar = requests.utils.cookiejar_from_dict(self.cookies, cookiejar=None,overwrite=True)
        return cookiesJar
        
#保存模拟登陆成功后从服务器返回的cookies，通过对比可以发现是有所不同的
    def set_cookies(self,cookies):
    # 将CookieJar转为字典：
        res_cookies_dic = requests.utils.dict_from_cookiejar(cookies)
    #将新的cookies信息更新到手动cookies字典
        for k in res_cookies_dic.keys():
            self.cookies[k] = res_cookies_dic[k]
#        print(self.cookies)
    #将服务器返回的cookies写入到taoCookie.txt中实现更新
        for k in self.cookies.keys():
            self.res_cookies_txt += k+"="+self.cookies[k]+";"
        with open('tc2.txt',"w",encoding="utf-8") as f:
            f.write(self.res_cookies_txt)

    def login(self,url):
    #开启一个session会话
        session = requests.session()
    #设置请求头信息
        session.headers = self.headers
    #将cookiesJar赋值给会话
        session.cookies=self.read_cookies()
    #向测试站点发起请求
        response = session.get(url)
        #print(response.content)
        #print(response.content.decode('GBK', 'ignore'))
        #sys.exit()
#        print(response.content.decode())
        #html=response.content.decode('utf-8', 'ignore')
        html=response.content.decode('GBK', 'ignore')
        self.set_cookies(response.cookies)
        return html

def addslashes(s):
    d = {'"':'\\"', "'":"\\'", "\0":"\\\0", "\\":"\\\\"}
    return ''.join(d.get(c, c) for c in s)

def promoPrice(fullUrl):
    req = urllib.request.Request(fullUrl, headers={'User-Agent': 'Mozilla/5.0','referer' : 'https://item.taobao.com/item.htm?spm=2013.1.20160405.11.2b1c5e93OTfWBE&scm=1007.13066.125438.0&id=566393246857','cookie':'cookie2=1931989c2f8353e2b98a696937baf12d; t=34fe4b099dcb61f4fca4105f623f17eb; _tb_token_=73763db3e86be; thw=kr; cna=TiwuFczn+i0CAd5srRjB5N9t; hng=KR%7Czh-CN%7CKRW%7C410; _fbp=fb.1.1554521601381.858057990; tg=0; enc=Q8Lvz8zW2Me3maP7lVTVu3cKNQTdY3vXPgVb6Y8QfTDIqTy6EohL33CDgD071cQ25Rhs1RlsYXkXUGWgZRnWGA%3D%3D; alitrackid=world.taobao.com; swfstore=302658; x=e%3D1%26p%3D*%26s%3D0%26c%3D0%26f%3D0%26g%3D0%26t%3D0%26__ll%3D-1%26_ato%3D0; _cc_=UIHiLt3xSw%3D%3D; whl=-1%260%260%261554604420346; v=0; lastalitrackid=world.taobao.com; JSESSIONID=6980BA0D098191937FED8BCA46B083A6; _m_h5_tk=d997c6e3b44782841ad927aa372af69b_1554622774562; _m_h5_tk_enc=a75cdb89af0dc39eacbeac1a2dd0248a; uc1=cookie14=UoTZ4Mn6X6XP%2BQ%3D%3D; mt=ci=-1_0; l=bB_XLtJ7v6tmCW8vXOCNZQebLK_O9IRfguS-lCvwi_5autY1GSWOlGiDI3v6VA5lOd-B402lRpyTje7zJs5..; isg=BHd3OkqZ5-efFmNlhxpvd64-BmttIkqMf2BVr8kkrsateJa6wQ1I7mUeWoCDkCMW'})
    response = urllib.request.urlopen(req).read()
    text = response.decode('utf-8')
    arr  = json.loads(text)
    try:
        promoPrice=arr["data"]["promotion"]["promoData"]["def"][0]["price"]
    except Exception as e:
        promoPrice=0
    return promoPrice

def tmallPromoPrice(pid):
    fullUrl = 'https://h5api.m.taobao.com/h5/mtop.taobao.detail.getdetail/6.0/?jsv=2.4.11&appKey=12574478&t=1556588123467&sign=d6e7723c5cc213c61b8ed0fa67028cf6&api=mtop.taobao.detail.getdetail&v=6.0&ttid=2017%40htao_h5_1.0.0&type=jsonp&dataType=jsonp&callback=mtopjsonp1&data=%7B%22exParams%22%3A%22%7B%5C%22countryCode%5C%22%3A%5C%22KR%5C%22%7D%22%2C%22itemNumId%22%3A%22'+pid+'%22%7D'
    #req = urllib.request.Request(fullUrl)
    #response = urllib.request.urlopen(req).read()
    #text = response.decode('utf-8', 'ignore')
    text=urlSource(fullUrl)
    arr1=str(text).split("mtopjsonp1(")
    arr2=arr1[1][:-1]
    arr = json.loads(arr2)
    try:
        pp=arr["data"]["apiStack"][0]["value"]
        ppArr = json.loads(pp)
        proPrice=ppArr["skuCore"]["sku2info"]["0"]["price"]["priceText"]
    except Exception as e:
        proPrice=0
    return proPrice
#    promoPrice=ppArr["skuCore"]["sku2info"]
#    print(promoPrice)
    
def tmallOptPromoPrice(pid):
    fullUrl = 'https://h5api.m.taobao.com/h5/mtop.taobao.detail.getdetail/6.0/?jsv=2.4.11&appKey=12574478&t=1556588123467&sign=d6e7723c5cc213c61b8ed0fa67028cf6&api=mtop.taobao.detail.getdetail&v=6.0&ttid=2017%40htao_h5_1.0.0&type=jsonp&dataType=jsonp&callback=mtopjsonp1&data=%7B%22exParams%22%3A%22%7B%5C%22countryCode%5C%22%3A%5C%22KR%5C%22%7D%22%2C%22itemNumId%22%3A%22'+pid+'%22%7D'
    #req = urllib.request.Request(fullUrl)
    #response = urllib.request.urlopen(req).read()
    #text = response.decode('utf-8', 'ignore')
    #print(text)
    text=urlSource(fullUrl)
    arr1=str(text).split("mtopjsonp1(")
    arr2=arr1[1][:-1]
    arr = json.loads(arr2)
    #print(arr)
    try:
        pp=arr["data"]["apiStack"][0]["value"]
        ppArr = json.loads(pp)
        promoPrice=ppArr["skuCore"]["sku2info"]
    except Exception as e:
        promoPrice=0
    return promoPrice

def urlSource(fullUrl):
    req = urllib.request.Request(fullUrl, headers={'User-Agent': 'Mozilla/5.0','referer' : '','cookie':'thw=kr; cna=IYSQFfJU7kMCAd5srRjAzDnp; t=3c5e5e872707dc02e8d36197dacfe6da; tracknick=partenon; lgc=partenon; tg=0; enc=6Pno6FDKOIbCbJKwfE1w2Qpvh3Du%2F9sPMVF5tLQBsXMSC2gwKZQmbGqIdCpDLtfNDneqUBhaUDBbQPJRwtJh7A%3D%3D; hng=KR%7Czh-CN%7CKRW%7C410; x=e%3D1%26p%3D*%26s%3D0%26c%3D0%26f%3D0%26g%3D0%26t%3D0%26__ll%3D-1%26_ato%3D0; _fbp=fb.1.1560910026674.854494586; v=0; cookie2=107947abcf793475f056c32e0d81fea5; _tb_token_=ebe64b7638131; dnk=partenon; unb=3026362365; uc3=lg2=URm48syIIVrSKA%3D%3D&nk2=E6U0i11Gfsw%3D&id2=UNDWpI%2BzhMd8pQ%3D%3D&vt3=F8dByuPa1Y8lKxtB1DY%3D; csg=d384700a; cookie17=UNDWpI%2BzhMd8pQ%3D%3D; skt=6bc2ec51dd7bf5ad; existShop=MTU2Nzc3NTQ2OQ%3D%3D; uc4=nk4=0%40EbzVnZ%2FcMwSL7VnlV15Jz7w9rA%3D%3D&id4=0%40UgcmDhaohH5caGj5FPlW6vvX1PJF; _cc_=URm48syIZQ%3D%3D; _l_g_=Ug%3D%3D; sg=n50; _nk_=partenon; cookie1=BdXaGSf%2BVtQ5k13PEDzWTtIwh4Otz1AJXxpppbxgDug%3D; mt=ci=4_1; _m_h5_tk=e148c6fc2d22ce3e335498e2d538d121_1567784006810; _m_h5_tk_enc=86c19a18d42ea97b501b01a2890ba05f; uc1=cart_m=0&cookie14=UoTaH0A3MDOgbw%3D%3D&lng=zh_CN&cookie16=UtASsssmPlP%2Ff1IHDsDaPRu%2BPw%3D%3D&existShop=false&cookie21=WqG3DMC9Eman&tag=8&cookie15=URm48syIIVrSKA%3D%3D&pas=0; isg=BHR0ohcOldXougHiKOUmtVQ4RTJKU5kl-RVp9w7VB_-TeRTDNl8txS87-ekEgdCP; l=cBac1-24qjYjjCntBOCwourza77tjIRAguPzaNbMi_5dg6L-gT7OkrkYUFp6cAWdtwLB4JuaUMv9-etkZcgP9P--g3fP.; whl=-1%260%260%261567779244164'})
    response = urllib.request.urlopen(req).read()
    text = response.decode('utf-8')
    return text

taobao=TaoBao()
datas={}
para1=[]
para2=[]
para3=[]
para4=[]
arraySize=['地毯尺寸','文胸尺码','参考身高','鞋码','规格','轮径尺寸','尺码','尺寸','长度','套餐类型','伞面尺寸','开关类型','大小','适用尺码','高度','件数','标价属性','数量/价','安装方式','头盔尺码','容量','包袋大小','适用床尺寸']
arrayColor=['颜色分类','主要颜色']
arraySizeMulti=['面料','是否加绒','情侣款','外框类型']

def arrMultiNameis(multi):
    if(multi=="面料"):
        return "소재"
    elif(multi=="是否加绒"):
        return "캐시미어추가여부"
    elif(multi=="情侣款"):
        return "커플모델"
    elif(multi=="外框类型"):
        return "프레임"


proPrice=0
thumbSavePath = "/var/www/mallpro/public_html/thumb/"
optionSavePath = "/var/www/mallpro/public_html/optionImage/"

display = Display(visible=0, size=(1024, 768)) 
display.start() 
driver = webdriver.Chrome('/home/propick/chromedriver', service_args=['--verbose', '--log-path=/home/propick/chromedriver.log'])

mall="taobao"
ppid=sys.argv[1]
puid=sys.argv[2]
#curs.execute("SELECT num,url FROM taobao where gubun>'0'")
#curs.execute("SELECT num,url FROM taobao where num='798'")
#curs.execute("SELECT num,url FROM taobao where pid='41908322638'")
curs.execute("SELECT num,url FROM taobao where pid='%s' and uid='%s' order by num desc limit 1" % (ppid,puid))
#curs.execute("SELECT num,url FROM taobao where subject='제품정보를 가져올 수 없는제품입니다.'")
#560753741218
#590705417134
#583217433771
for rs in curs:
    pnum=str(rs[0])
    iurl=str(rs[1])
    print(iurl)
    print(datetime.datetime.now())
    pid1=iurl
    pid2=pid1.split("id=")
    pid3=pid2[1].split("&")
    pid=pid3[0]
    if(str(iurl).find("?id=")>0):
        pid2=pid1.split("?id=")
        pid3=pid2[1].split("&")
        pid=pid3[0]
    elif(str(iurl).find("&id=")>0):
        pid2=pid1.split("&id=")
        pid3=pid2[1].split("&")
        pid=pid3[0]
    #print(pid)
    #sys.exit()
    img1=""
    videoUrl=""
    proPrice=""
    option=[]
    optionName1=""
    optionName2=""
    optionName3=""
    optionNum=[]
    optionNum1=[]
    optionNum2=[]
    optionNum3=[]
    optionValue=[]
    optionValue1=""
    optionValue2=""
    optionValue3=""
    optionValueSize=""
    optionValueColor=""
    optionPrice=[]
    optionSize=[]
    optionImage=""
    optImage=""
    optPrice=""
    colorNumber=0
    sizeNumber=0
    optionType=0
    optionCount=0
    driver.get(iurl)
    driver.implicitly_wait(10)
    html = driver.page_source
    #html=open('taoView.txt', 'r')
    soup = bs(html, 'html.parser') # Soup으로 만들어 줍시다.
    realUrl=driver.current_url
    #print(realUrl)
    driver.close()

    if(str(realUrl).find("item.taobao.com")<=0 and str(realUrl).find("detail.tmall.com")<=0):
        query="update taobao set mall='"+mall+"', price='0', gubun='0', subject='없는 제품이거나 정보를 가져올 수 없는 제품입니다.' where url='"+iurl+"'"
        curs2.execute(query)

#    print(soup)
    elif(str(soup).find("很抱歉")<=0):

        #순서정하기
        pnArray=[]
        optionName=[None] * 500000
        taoName=[None] * 500000
        p1=0
        p1name=""
        for arco in arrayColor:
            if(p1<=0):
                p1=str(soup).find("data-property=\"%s\"" % arco)
                taoName[p1]=arco
                optionName[p1]="컬러"
                if(p1>0):
                    pnArray=pnArray+[p1]
        p2=0
        p2name=""    
        for arsz in arraySize:
            if(p2<=0):
                p2=str(soup).find("data-property=\"%s\"" % arsz)
                taoName[p2]=arsz
                optionName[p2]="사이즈"
                if(p2>0):
                    pnArray=pnArray+[p2]
                

        p3=0
        p3name=""
        for arszm in arraySizeMulti:
            if(p3<=0):
                p3=str(soup).find("data-property=\"%s\"" % arszm)
                taoName[p3]=arszm
                optionName[p3]=arrMultiNameis(taoName[p3])
                if(p3>0):
                    pnArray=pnArray+[p3]

        #print("a=>"+str(p1))
        #print("b=>"+str(p2))
        #print("c=>"+str(p3))
        
        pnArray.sort()
        #print(pnArray)
        optionNameArray=[]
        taoNameArray=[]
        for pnNum in pnArray:
            optionType=1
            optionNameArray=optionNameArray+[optionName[pnNum]]
            taoNameArray=taoNameArray+[taoName[pnNum]]

#        print(optionNameArray)
#        sys.exit()
        
        try:
            if(optionNameArray[0]):
                optionName1=optionNameArray[0]
                p1name=taoNameArray[0]
        except Exception as e:
            pass
        try:
            if(optionNameArray[1]):
                optionName2=optionNameArray[1]
                p2name=taoNameArray[1]
        except Exception as e:
            pass
        try:
            if(optionNameArray[2]):
                optionName3=optionNameArray[2]
                p3name=taoNameArray[2]
        except Exception as e:
            pass

              
#        print(optionName1)
#        print(optionName2)
#        print(optionName3)
#        sys.exit()
        optionName=[None]*1

        subj=""
        subject = soup.select('#J_DetailMeta > div.tm-clear > div.tb-property > div > div.tb-detail-hd > h1')
        for subject2 in subject:
            subj=subject2.text.strip()
        if(str(soup).find("Setup")>0):#tmall.com
            optCnt= soup.find_all('dl', {'class': 'tm-sale-prop'})
            optionCount=len(optCnt)
            dt = soup.find_all('script')
            for dtt in dt:
                dtt=str(dtt)
                if(dtt.find("Setup")>0):
                    dt1=dtt
            dt2=dt1.split("Setup(")
    #        print(dt2[1])
            dt3=str(dt2[1]).split(");")
            desc=dt3[0].strip()
#            print(desc)
            arr  = json.loads(desc)
            if(str(arr).find("valItemInfo")>0):
                for arsz in arraySize:
                    opt=[]
                    opt= soup.find_all('ul', {'data-property': '%s' % arsz})
                    optSize=0
                    for opt2 in opt:
                        optSize=optSize+1
                        opt3=opt2.text.strip()
                        opt3=opt3.replace("已选中","")
                        opt3=opt3.replace("\n\n\n\n\n",",")
                        optionValueSize=opt3

                for arco in arrayColor:
                    opt=[]
                    opt= soup.find_all('ul', {'data-property': '%s' % arco})
                    for opt2 in opt:
                        opt3=opt2.text.strip()
                        opt3=opt3.replace("已选中","")
                        opt3=opt3.replace("\n\n\n\n\n",",")
                        optionValueColor=opt3        

                for arszm in arraySizeMulti:
                    opt=[]
                    opt= soup.find_all('ul', {'data-property': '%s' % arszm})
                    for opt2 in opt:
                        opt3=opt2.text.strip()
                        opt3=opt3.replace("已选中","")
                        opt3=opt3.replace("\n\n\n\n\n\n",",")
                        opt3=opt3.replace("\n\n","")
                        optionValueMulti=opt3

                
                optionValueArray=[]
                for ona in optionNameArray:
                    if(ona=="컬러"):
                        optionValueArray=optionValueArray+[optionValueColor]
                    elif(ona=="사이즈"):
                        optionValueArray=optionValueArray+[optionValueSize]
                    else:
                        optionValueArray=optionValueArray+[optionValueMulti]

                try:
                    optionValue1=optionValueArray[0]
                except Exception as e:
                    pass
                try:
                    optionValue2=optionValueArray[1]
                except Exception as e:
                    pass
                try:
                    optionValue3=optionValueArray[2]
                except Exception as e:
                    pass
#                print(optionValue1)
#                print(optionValue2)
#                print(optionValue3)
#                sys.exit()

    #옵션값 알아내기

    #            print(p1name)
    #            print(p2name)
    #            print(p3name)
    #            sys.exit()

                optImg=soup.select('#J_DetailMeta > div.tm-clear > div.tb-property > div > div.tb-key > div > div > dl.tb-prop.tm-sale-prop.tm-clear.tm-img-prop > dd > ul > li > a')
#                print(optImg)
                if(len(optImg)>0):
                    for optImg2 in optImg:
                        optImg3=optImg2.get("style")
                        if(optImg3):
                            optImg5=optImg3.split("(")
                            optImg6=optImg5[1].split(")")
                            optImg7="http:"+optImg6[0].replace("30x30","800x800")
                            optImg7=optImg7.replace("40x40","800x800")
                            optImage=optImage+","+optImg7
                            fileExt = os.path.splitext(optImg7)[1]
                            originNames = optImg7.split("/")
                            thumbFile=originNames[len(originNames) - 1]
                            thumbFile=hashlib.sha256(str(thumbFile).encode('utf-8')).hexdigest()+fileExt
                            optionImage=optionImage+","+thumbFile
                            '''
                            try:
                                urllib.request.urlretrieve(optImg7, optionSavePath+thumbFile)
                            except Exception as e:
                                continue
                            '''
                        else:
                            noneImage="https://i.imgur.com/IVhEITK.jpg"
                            optImage=optImage+","+noneImage
                    optImage=optImage[1:]
                    optionImage=optionImage[1:]
#                print(optionImage)
#                sys.exit()
#사이즈
                if(len(optionName1)>0):
                    optNum = soup.select('#J_DetailMeta > div.tm-clear > div.tb-property > div > div.tb-key > div > div > dl > dd > ul > li')
                    for optNum2 in optNum:
                        optNum3=optNum2.get("data-value")
                        if(optNum3!=None):
                            optionNum1=optionNum1+[optNum3]
#컬러
                if(len(optionName2)>0):
                    optNum = soup.select('#J_DetailMeta > div.tm-clear > div.tb-property > div > div.tb-key > div > div > dl.tb-prop.tm-sale-prop.tm-clear.tm-img-prop > dd > ul > li')
                    for optNum2 in optNum:
                        optNum3=optNum2.get("data-value")
                        if(optNum3!=None):
                            optionNum2=optionNum2+[optNum3]

                if(len(optionNum1)>0 and len(optionNum2)>0):
                    for on1 in optionNum2:
                        optionNum1.remove(on1)

                if(len(optionNum1)>0 and len(optionNum2)>0):
                    opNum1=optionNum1
                    opNum2=optionNum2
                else:
                    opNum1=optionNum1+optionNum2
                    opNum2=optionNum1+optionNum2

                if(p1>0 and p2>0):
                    if(p1>p2):
                        optionNum1=opNum1
                        optionNum2=opNum2
                    elif(p1<p2):
                        optionNum1=opNum2
                        optionNum2=opNum1
                if(p1>0 and p2<0):
                    optionNum1=opNum2
                    optionNum2=""
                if(p1<0 and p2>0):
                    optionNum1=opNum1
                    optionNum2=""

#                print(optionNum1)
#                print(optionNum2)
#                sys.exit()

                optPrice=arr["valItemInfo"]["skuMap"]
                optPrice=json.dumps(optPrice)
#                print(optPrice)
#                sys.exit()
                pid=arr["itemDO"]["itemId"]
                desc=arr["api"]["descUrl"]
                pvs=";"+arr["valItemInfo"]["skuList"][0]["pvs"]+";"
                #price=arr["valItemInfo"]["skuMap"][pvs]["price"]
                price=0
                price=arr["detail"]["defaultItemPrice"]
                #gubunCode=arr["valItemInfo"]["skuList"][0]["skuId"]
                proPrice=tmallPromoPrice(pid)
                optPromoPrice=tmallOptPromoPrice(pid)
                #print(proPrice)
                #print(optPromoPrice)
                #sys.exit()
                if(str(price).find("-")>0):
                    optionType='2'
                if(str(proPrice).find("-")>0):
                    optionType='2'

                if(str(arr).find("imgVedioUrl")>0):
                    videoUrl=arr["itemDO"]["imgVedioUrl"]
                desc=desc.replace("//","http://")
                imgt1=soup.select('#J_UlThumb > li > a > img')
                for imgt2 in imgt1:
                    imgSrc=imgt2.get('src')
                    imgsplit=imgSrc.split("//")
                    if(imgsplit[0]=="https:"):
                        imgt3=imgSrc.replace("60x60","430x430")
                    else:
                        imgt3="http:"+imgSrc.replace("60x60","430x430")
                    imgt3=imgt3.replace("50x50","430x430")
                    imgt3=imgt3.replace("_.webp","")
                    fileExt = os.path.splitext(imgt3)[1]
                    originNames = imgt3.split("/")
                    thumbFile=originNames[len(originNames) - 1]
                    thumbFile=hashlib.sha256(str(thumbFile).encode('utf-8')).hexdigest()+fileExt
                    img1=img1+","+thumbFile
                    try:
                        urllib.request.urlretrieve(imgt3, thumbSavePath+thumbFile)
                    except Exception as e:
                        continue
                optionJson=quote(json.dumps(option, ensure_ascii=False, indent="\t"))

            elif(str(arr).find("valLoginIndicator")>0):
                desc=arr["api"]["descUrl"]
                price=0
                price=arr["detail"]["defaultItemPrice"]
                proPrice=tmallPromoPrice(pid)
                optPromoPrice=tmallOptPromoPrice(pid)
                if(str(price).find("-")>0):
                    optionType='2'
                if(str(proPrice).find("-")>0):
                    optionType='2'
                desc=desc.replace("//","http://")
                imgt1=soup.select('#J_UlThumb > li > a > img')
                if(str(arr).find("imgVedioUrl")>0):
                    videoUrl=arr["itemDO"]["imgVedioUrl"]
                for imgt2 in imgt1:
                    imgSrc=imgt2.get('src')
                    imgsplit=imgSrc.split("//")
                    if(imgsplit[0]=="https:"):
                        imgt3=imgSrc.replace("60x60","430x430")
                    else:
                        imgt3="http:"+imgSrc.replace("60x60","430x430")
                    imgt3=imgt3.replace("50x50","430x430")
                    imgt3=imgt3.replace("_.webp","")
                    fileExt = os.path.splitext(imgt3)[1]
                    originNames = imgt3.split("/")
                    thumbFile=originNames[len(originNames) - 1]
                    thumbFile=hashlib.sha256(str(thumbFile).encode('utf-8')).hexdigest()+fileExt
                    img1=img1+","+thumbFile
                    try:
                        urllib.request.urlretrieve(imgt3, thumbSavePath+thumbFile)
                    except Exception as e:
                        continue
            #print(desc)
            html=taobao.login(desc)
            #print(html)
            soup = bs(html, 'html.parser')
            soupsp=html.replace("var desc='","")
            soupsp=soupsp.replace("';","")
            #soupsp=soupsp.replace("<p>","")
            #soupsp=soupsp.replace("</p>","")
            #soupsp=soupsp.replace("overflow: hidden","")
            #soupsp=soupsp.replace("overflow:hidden","")
            contents=addslashes(str(soupsp))
            contents=quote(contents)
            #print(contents)
            #sys.exit()
            #print(soup);
            #img = soup.find_all('img', {'align': 'absmiddle'})
            img = soup.find_all('img')
            para=[]
            savePath = "/var/www/mallpro/public_html/itemImage/"
            for img2 in img:
                imgUrl=img2.get('src')
                if imgUrl is not None:
                    fileExt = os.path.splitext(imgUrl)[1]
                    originNames = imgUrl.split("/")
                    imgFile=originNames[len(originNames) - 1]
                    imgFile=hashlib.sha256(str(imgFile).encode('utf-8')).hexdigest()+fileExt
                    try:
                        urllib.request.urlretrieve(imgUrl, savePath+imgFile)
                    except Exception as e:
    #                    print(e)
                        continue
                    para=para+[imgFile]
            imgJson=json.dumps(para, ensure_ascii=False, indent="\t")
        else:#taobao.com

            optCnt= soup.find_all('ul', {'class': 'J_TSaleProp'})
            optionCount=len(optCnt)

            for arco in arrayColor:
                opt=[]
                opt= soup.find_all('ul', {'data-property': '%s' % arco})
                for opt2 in opt:
                    opt3=opt2.text.strip()
                    opt3=opt3.replace("已选中","")
                    opt3=opt3.replace("\n\n\n\n\n\n",",")
                    opt3=opt3.replace("\n\n","")
                    optionValueColor=opt3

            optImg=soup.select('#J_isku > div > dl.J_Prop.tb-prop.tb-clear.J_Prop_Color > dd > ul > li > a')
#            print(optImg)
#            sys.exit()
            for optImg2 in optImg:
                optImg3=optImg2.get("style")
                if(optImg3):
                    optImg5=optImg3.split("(")
                    optImg6=optImg5[1].split(")")
                    optImg7="http:"+optImg6[0].replace("30x30","800x800")
                    optImg7=optImg7.replace("40x40","800x800")
                    optImage=optImage+","+optImg7
                    fileExt = os.path.splitext(optImg7)[1]
                    originNames = optImg7.split("/")
                    thumbFile=originNames[len(originNames) - 1]
                    thumbFile=hashlib.sha256(str(thumbFile).encode('utf-8')).hexdigest()+fileExt
                    optionImage=optionImage+","+thumbFile
                    '''
                    try:
                        urllib.request.urlretrieve(optImg7, optionSavePath+thumbFile)
                    except Exception as e:
                        continue
                    '''
                else:
                    noneImage="https://i.imgur.com/IVhEITK.jpg"
                    optImage=optImage+","+noneImage
            optImage=optImage[1:]
            optionImage=optionImage[1:]
#            print(optImage)
#            print(optionImage)
#            sys.exit()
            for arsz in arraySize:
                opt=[]
                opt= soup.find_all('ul', {'data-property': '%s' % arsz})
                for opt2 in opt:
                    opt3=opt2.text.strip()
                    opt3=opt3.replace("已选中","")
                    opt3=opt3.replace("\n\n\n\n\n\n",",")
                    opt3=opt3.replace("\n\n","")
                    optionValueSize=opt3

            for arszm in arraySizeMulti:
                opt=[]
                opt= soup.find_all('ul', {'data-property': '%s' % arszm})
                for opt2 in opt:
                    opt3=opt2.text.strip()
                    opt3=opt3.replace("已选中","")
                    opt3=opt3.replace("\n\n\n\n\n\n",",")
                    opt3=opt3.replace("\n\n","")
                    optionValueMulti=opt3

            
            optionValueArray=[]
            for ona in optionNameArray:
                if(ona=="컬러"):
                    optionValueArray=optionValueArray+[optionValueColor]
                elif(ona=="사이즈"):
                    optionValueArray=optionValueArray+[optionValueSize]
                else:
                    optionValueArray=optionValueArray+[optionValueMulti]

            try:
                optionValue1=optionValueArray[0]
            except Exception as e:
                pass
            try:
                optionValue2=optionValueArray[1]
            except Exception as e:
                pass
            try:
                optionValue3=optionValueArray[2]
            except Exception as e:
                pass
#            print(optionValue1)
#            print(optionValue2)
#            print(optionValue3)
#            sys.exit()

#옵션값 알아내기

#            print(p1name)
#            print(p2name)
#            print(p3name)
#            sys.exit()
            def optNumis(opt):
                optionNumValue=[]
                optNum1= soup.find_all('ul', {'data-property': '%s' % opt})
                optNum11= optNum1[0].find_all('li')
                for optNum2 in optNum11:
                    optNum3=optNum2.get("data-value")
                    if(optNum3!=None):
                        optionNumValue=optionNumValue+[optNum3]
                return optionNumValue

            optionNum1=optNumis(p1name)
            optionNum2=optNumis(p2name)
            optionNum3=optNumis(p3name)    
#            print(optionNum1)
#            print(optionNum2)
#            print(optionNum3)
#            sys.exit()
         
            if(p1>0 or p2>0):
                optPrice1=str(soup).split("skuMap")
                optPrice2=str(optPrice1[1]).split("propertyMemoMap")
                optPrice3=optPrice2[0].strip()
                optPrice3=optPrice3[1:]
                optPrice3=optPrice3[:-1]
                optPrice=optPrice3.strip()
    #            print(optPrice)
    #            sys.exit()
            if(str(soup).find("'video',")>0):
                vdata=str(soup).split("'video',")
                v1=vdata[1].split(");")
                vd=v1[0].strip()
                varray=json.loads(vd)
                videoId=varray["videoId"]
                videoOwnerId=varray["videoOwnerId"]
                videoUrl="//cloud.video.taobao.com/play/u/"+videoOwnerId+"/p/1/e/6/t/1/"+videoId+".mp4"
#            print(videoUrl)
#            print(datetime.datetime.now())
#            sys.exit()
            itemId=soup.find_all('input', {'name': 'item_id'})
            for item1 in itemId:
                itemId=item1.get("value")
            pid=itemId
            subject=soup.find_all('h3', {'class': 'tb-main-title'})
            for subject2 in subject:
                subj=subject2.text.strip()
            price=0
            price=soup.find('em', {'class': 'tb-rmb-num'})
            price=price.text.strip()
            if(str(price).find("-")>0):
                optionType='2'
            '''
            pp1=str(soup).split("sibUrl")
            pp2=str(pp1[1]).split("',")
            pp3=pp2[0].replace("'","")
            pp4=pp3.replace(":","")
            pp4=pp4.replace("&amp;","&")
            promoUrl="https:"+pp4.strip()
            '''
            proPrice=tmallPromoPrice(pid)
            optPromoPrice=tmallOptPromoPrice(pid)
            #print(proPrice)
            #print(optPromoPrice)
            #sys.exit()
            dt2=str(soup).split("'http:' ? '")
            dt3=str(dt2[1]).split("'")
            desc=dt3[0].strip()
            desc=desc.replace("//","http://")
            timg=str(soup).split("auctionImages")
            timg1=timg[1].split("]")
            timg2=timg1[0].split("[")
            imgt1=timg2[1].split(",")
#            print(imgt1)
#            print(datetime.datetime.now())
#            sys.exit()
            #imgt1=soup.select('#J_UlThumb > li > div > a > img')
            for imgt2 in imgt1:
                #imgSrc=imgt2.get('src')
                imgt2=imgt2.replace("\"","")
                imgsplit=imgt2.split("//")
                if(imgsplit[0]=="https:"):
                    imgt3=imgt2.replace("60x60","430x430")
                else:
                    imgt3="http:"+imgt2.replace("60x60","430x430")
                imgt3=imgt3.replace("50x50","430x430")
                imgt3=imgt3.replace("_.webp","")
              
                fileExt = os.path.splitext(imgt3)[1]
                if(fileExt==".SS2"):
                    fileExt=".jpg"
                originNames = imgt3.split("/")
                thumbFile=originNames[len(originNames) - 1]
                thumbFile=hashlib.sha256(str(thumbFile).encode('utf-8')).hexdigest()+fileExt
                #img1=img1+","+thumbFile
                try:
#                    print(imgt3)
#                    thumbOk=urllib.request.urlretrieve(imgt3, thumbSavePath+thumbFile)
#                    local_image_filename = wget.download(imgt3, out=thumbSavePath+thumbFile)
                    imgData = urllib.request.urlopen(imgt3).read()
                    output = open(thumbSavePath+thumbFile,'wb')
                    output.write(imgData)
                    output.close()
                    img1=img1+","+thumbFile
                except Exception as e:
#                    print(e)
                    continue
#            print(img1)
#            print(datetime.datetime.now())
            #sys.exit()
#            print(desc)

#            sys.exit()
            html=taobao.login(desc)
#            print(html)
#            print(datetime.datetime.now())
#            sys.exit()
            soup = bs(html, 'html.parser')
            soupsp=html.replace("var desc='","")
            soupsp=soupsp.replace("';","")
            #soupsp=soupsp.replace("<p>","")
            #soupsp=soupsp.replace("</p>","")
            #soupsp=soupsp.replace("overflow: hidden","")
            #soupsp=soupsp.replace("overflow:hidden","")
            #print(soupsp)
            #sys.exit()
            contents=addslashes(str(soupsp))
            contents=quote(contents)
#            print(contents)
#            print(datetime.datetime.now())
#            sys.exit()
            img = soup.find_all('img')
            para=[]
            savePath = "/var/www/mallpro/public_html/itemImage/"
            for img2 in img:
                imgUrl=img2.get('src')
                if imgUrl is not None:
                    fileExt = os.path.splitext(imgUrl)[1]
                    originNames = imgUrl.split("/")
                    imgFile=originNames[len(originNames) - 1]
                    imgFile=hashlib.sha256(str(imgFile).encode('utf-8')).hexdigest()+fileExt
#                    try:
#                        urllib.request.urlretrieve(imgUrl, savePath+imgFile)
#                    except Exception as e:
    #                    print(e)
#                        continue
                    para=para+[imgFile]
            imgJson=json.dumps(para, ensure_ascii=False, indent="\t")
#            print(imgJson)
#            print(datetime.datetime.now())
        subj=addslashes(subj)
        img1=img1[1:]
        proPrice=str(proPrice)
#        print(proPrice)
#        print(datetime.datetime.now())
#        sys.exit()
        query="update taobao set mall='"+mall+"', pid='"+pid+"', subject='"+subj+"', itemView='"+desc+"', price='"+price+"', itemImage='"+imgJson+"',thumbFile='"+img1+"', contents='"+contents+"', promoPrice='"+proPrice+"', videoUrl='"+videoUrl+"', optionImage='"+optImage+"', optionType='"+str(optionType)+"', optionCount='"+str(optionCount)+"', gubun=0 where url='"+iurl+"'"
#        print(query)
#        sys.exit()
        curs2.execute(query)


        optionNum1Json=quote(json.dumps(optionNum1, ensure_ascii=False, indent="\t"))
        optionNum2Json=quote(json.dumps(optionNum2, ensure_ascii=False, indent="\t"))
        optionNum3Json=quote(json.dumps(optionNum3, ensure_ascii=False, indent="\t"))
#        print(optPrice)
#        sys.exit()
        optionPriceJson=quote(str(optPrice))
        optionPromoPriceJson=quote(str(optPromoPrice))
        #print(optionPriceJson)
        optionValue1=addslashes(optionValue1)
        optionValue2=addslashes(optionValue2)
        optionValue3=addslashes(optionValue3)

        query2="insert into optiontable (pnum,optionName1,optionName2,optionName3,optionValue1,optionValue2,optionValue3,optionNum1,optionNum2,optionNum3,optionPrice,optionPromoPrice,optionImage) values (\""+pnum+"\",\""+optionName1+"\",\""+optionName2+"\",\""+optionName3+"\",\""+optionValue1+"\",\""+optionValue2+"\",\""+optionValue3+"\",\""+optionNum1Json+"\",\""+optionNum2Json+"\",\""+optionNum3Json+"\",\""+optionPriceJson+"\",\""+optionPromoPriceJson+"\",\""+optionImage+"\") ON DUPLICATE KEY UPDATE optionName1=\""+optionName1+"\",optionName2=\""+optionName2+"\",optionName3=\""+optionName3+"\",optionValue1=\""+optionValue1+"\",optionValue2=\""+optionValue2+"\",optionValue3=\""+optionValue3+"\",optionNum1=\""+optionNum1Json+"\", optionNum2=\""+optionNum2Json+"\", optionNum3=\""+optionNum3Json+"\", optionPrice=\""+optionPriceJson+"\", optionPromoPrice=\""+optionPromoPriceJson+"\", optionImage=\""+optionImage+"\""
        #print(query2)
        curs3.execute(query2)
        print(datetime.datetime.now())
    else:
        query="update taobao set mall='"+mall+"', price='0', gubun='0', subject='없는 제품이거나 정보를 가져올 수 없는 제품입니다!!' where url='"+iurl+"'"
        curs2.execute(query)
    conn.commit()


conn.close()