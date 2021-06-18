display = Display(visible=0, size=(1024, 768)) 
display.start() 
driver = webdriver.Chrome('/home/test/chromedriver', service_args=['--verbose', '--log-path=/home/test/chromedriver.log'])
driver.get('http://www.wemakeprice.com/best')
driver.implicitly_wait(3)
html = driver.page_source
soup = bs(html, 'html.parser')