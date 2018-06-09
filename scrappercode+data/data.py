#!/usr/bin/env python
# encoding: utf-8
from bs4 import BeautifulSoup
import requests
import tweepy 
import json
import csv
import sys

#reload(sys)
#sys.setdefaultencoding('utf-8')

#print(soup.prettify())
#print(list(soup.children))
#print([type(item) for item in list(soup.children)])

#temp=soup.find_all(class_="MT15 PT10 PB10")
#print(temp[0])

def passurl():
	
	for i in range(11,0,-1): #depends in the pagination count of the year
		get_all_news("https://www.moneycontrol.com/news/tags/cryptocurrency.html/page-"+str(i)+"/")
		
def get_all_news(url):
	
	#print(url)
	page = requests.get(url)
	soup = BeautifulSoup(page.content, 'html.parser')
	
	all_news=[]
	i=0
	#print(soup)
	for item in soup.find_all(class_="fader"):
		#print("hi")
		print(item["alt"])
	'''	if not(item.strong):
			continue
		else:
			all_news.append([])
			all_news[i].append(item.p.text+"")
			all_news[i].append(item.strong.text+"")
			i+=1
			#all_news[i].append(item.strong.text)
			#print(item.strong.text)
			#print(item.p.text)
			#print(item.strong.text)
			
	
	
#write the csv    
with open('news.csv', 'ab') as f:
	writer = csv.writer(f)
	#writer.writerow(["date","title"])
	writer.writerows(all_news)
pass


'''
	
if __name__ == '__main__':
    passurl()
	#get_all_news("https://www.moneycontrol.com/news/tags/cryptocurrency.html/page-3/")		