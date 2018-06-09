import sys
import os
import requests
import json
import string
import re
from unidecode import unidecode
import math
import schedule
import time
import codecs 
import csv
import pandas as pd
import tweepy
import pandas
from textblob import TextBlob
import pandas as pd





# Source: http://stackoverflow.com/questions/19790188/expanding-english-language-contractions-in-python
contractions = { 
"ain't": "am not",
"aren't": "are not",
"can't": "cannot",
"can't've": "cannot have",
"'cause": "because",
"could've": "could have",
"couldn't": "could not",
"couldn't've": "could not have",
"didn't": "did not",
"doesn't": "does not",
"don't": "do not",
"hadn't": "had not",
"hadn't've": "had not have",
"hasn't": "has not",
"haven't": "have not",
"he'd": "he would",
"he'd've": "he would have",
"he'll": "he will",
"he'll've": "he will have",
"he's": "he is",
"how'd": "how did",
"how'd'y": "how do you",
"how'll": "how will",
"how's": "how is",
"I'd": "I would",
"I'd've": "I would have",
"I'll": "I will",
"I'll've": "I will have",
"I'm": "I am",
"I've": "I have",
"isn't": "is not",
"it'd": "it had",
"it'd've": "it would have",
"it'll": "it will",
"it'll've": "it will have",
"it's": "it is",
"let's": "let us",
"ma'am": "madam",
"mayn't": "may not",
"might've": "might have",
"mightn't": "might not",
"mightn't've": "might not have",
"must've": "must have",
"mustn't": "must not",
"mustn't've": "must not have",
"needn't": "need not",
"needn't've": "need not have",
"o'clock": "of the clock",
"oughtn't": "ought not",
"oughtn't've": "ought not have",
"shan't": "shall not",
"sha'n't": "shall not",
"shan't've": "shall not have",
"she'd": "she had",
"she'd've": "she would have",
"she'll": "she will",
"she'll've": "she will have",
"she's": "she is",
"should've": "should have",
"shouldn't": "should not",
"shouldn't've": "should not have",
"so've": "so have",
"so's": "so is",
"that'd": "that had",
"that'd've": "that would have",
"that's": "that is",
"there'd": "there had",
"there'd've": "there would have",
"there's": "there is",
"they'd": "they would",
"they'd've": "they would have",
"they'll": "they will",
"they'll've": "they will have",
"they're": "they are",
"they've": "they have",
"to've": "to have",
"wasn't": "was not",
"we'd": "we had",
"we'd've": "we would have",
"we'll": "we will",
"we'll've": "we will have",
"we're": "we are",
"we've": "we have",
"weren't": "were not",
"what'll": "what will",
"what'll've": "what will have",
"what're": "what are",
"what's": "what is",
"what've": "what have",
"when's": "when is",
"when've": "when have",
"where'd": "where did",
"where's": "where is",
"where've": "where have",
"who'll": "who will",
"who'll've": "who will have",
"who's": "who is",
"who've": "who have",
"why's": "why is",
"why've": "why have",
"will've": "will have",
"won't": "will not",
"won't've": "will not have",
"would've": "would have",
"wouldn't": "would not",
"wouldn't've": "would not have",
"y'all": "you all",
"y'all'd": "you all would",
"y'all'd've": "you all would have",
"y'all're": "you all are",
"y'all've": "you all have",
"you'd": "you had",
"you'd've": "you would have",
"you'll": "you will",
"you'll've": "you will have",
"you're": "you are",
"you've": "you have"
}

tweet_text = dict()

consumer_key = 'ULqvEPN92Py8L2csw6c84sGSk'
consumer_secret = 'b9vXWF9qz1e8xIiQtY9RYFDNjSsaiJv4ASVoorotnNsxr0XbLr'

access_token = '2936694138-8LIvb244Vq0nhiMcA9qTamd3TgaGbFCEdZ7PgRc'
access_token_secret = 'ntNYbkfMO0saEiwpdbKHmZmdOcpaOb0isKc1I39WdWInp'

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)



#read the words from the sentiwordnet (list with positivity and negativity scores for over 13,000 words)
def create_dict():
	scores_file = open("SentiWordNet.txt", "r")
	scores_dict = dict()

	#add the word into the dictionary with the positive score - the negative score 
	for line in scores_file:
		line = line.strip()
		if line[0] != "#":
			tmp = line.split()
			word = tmp[4].split("#")
			scores_dict[str(word[0])] = float(tmp[2]) - float(tmp[3])

	#read in emoji dictionary
	reader = csv.reader(open('EmojiSentiment.csv'))

	emojiDict = dict()

	#add emoji scores to the dictionary
	for row in reader:
		emojiDict[row[0]] = row[1]
	scores_dict.update(emojiDict);

	return scores_dict

# Function to tokenize text
def tokenizeText(line, wordNet_dict):
	
	tokens = []
	#split the tweet into words by spaces
	words = line.strip().split()

	tmplist = list()
	for word in words:
		try:
			word = unidecode(word)
		except:
			pass
        # APOSTROPHES:
        # Tokenize "'" if in contraction:
		if "'" in word:
			if word in contractions:
				expansion = contractions[word]
				all_words = expansion.split()
				for all_word in all_words:
					tmplist.append(all_word)
		else:
			tmplist.append(word)

	final_tokenized_list = list()

	#cleaning the text
	for tmp_words in tmplist:
		replace_punctuation = str.maketrans(string.punctuation, ' '*len(string.punctuation))
		tmp_words = tmp_words.translate(replace_punctuation)
		tmp_word = tmp_words.split()
		final_tokenized_list.extend(tmp_word)

	#return a list of the words of one tweet 
	return final_tokenized_list

#returns the score of one tweet
def sentimentAnalysis(tweet_list, scores_dict, retweet_count):
	count = 0.0
	tweet_score = 0.0

	#iterate through each word in a single tweet and get the score from the sentiment library
	for each_tweet_word in tweet_list:
		if each_tweet_word.lower() in scores_dict:
			tweet_score = tweet_score + scores_dict[each_tweet_word.lower()]
			count = count + 1.0

	#if no tweets are collected 0 is returned
	if count != 0.0:
		retweet_count = float(retweet_count) + 2.0 #not simply ignoring not tweeted tweets
		weight_factor = math.log(float(retweet_count), 10)
		return weight_factor*(float(tweet_score)/count) #normalizing per tweet to avoid length factor
	else:
		return 0.0

		
		
'''		
#computes the final score by summing the tweets and normalizing
def scoreTweets(all_tweets_scores,valuepolsub):
	
	#print(all_tweets_scores[0])
	#print(valuepolsub.shape)
	
	max_abs_val = math.fabs(all_tweets_scores[0])
	max_abs_pol_val = math.fabs(valuepolsub.iat[0,2])
	max_abs_sub_val = math.fabs(valuepolsub.iat[0,3])
	
	length=len(all_tweets_scores)
	
	for num in range(1, length):
		
		if math.fabs(all_tweets_scores[num]) > max_abs_val:
			max_abs_val = math.fabs(all_tweets_scores[num])

		if math.fabs(valuepolsub.iat[num,2]) > max_abs_pol_val:
			max_abs_pol_val = math.fabs(valuepolsub.iat[num,2])
		
		if math.fabs(valuepolsub.iat[num,3]) > max_abs_sub_val:
			max_abs_sub_val = math.fabs(valuepolsub.iat[num,3])
		
		

		
	total_pos_score = 0.0
	total_neg_score = 0.0
	k=0
	
	total_pospol_score=0.0
	total_negpol_score=0.0
	
	total_subjectivity_score=0.0
	
	for each_tweet_score in all_tweets_scores:
		if float(each_tweet_score) > 0:
			total_pos_score = total_pos_score + (float(each_tweet_score)/float(max_abs_val))
		elif float(each_tweet_score) < 0:	
			total_neg_score = total_neg_score + (float(each_tweet_score)/float(max_abs_val))
		
		if valuepolsub.iat[k,2] > 0 :
			total_pospol_score = total_pospol_score + (float(valuepolsub.iat[k,2])/float(max_abs_pol_val))
		elif valuepolsub.iat[k,2] < 0 :
			total_negpol_score = total_negpol_score + (float(valuepolsub.iat[k,2])/float(max_abs_pol_val))
		
		total_subjectivity_score = total_subjectivity_score + (float(valuepolsub.iat[k,3])/float(max_abs_sub_val))
		
		k=k+1
	

	
	total_pos_score_avg = float(total_pos_score)/float(length)	
	total_neg_score_avg = float(total_neg_score)/float(length)
	
	total_pospol_score_avg = float(total_pospol_score)/float(length)	
	total_negpol_score_avg = float(total_negpol_score)/float(length)
	
	total_subjectivity_score_avg = float(total_subjectivity_score)/float(length*10)
	
	#return the percent value
	
	print(total_pos_score_avg)
	print(total_neg_score_avg)
	
	print(total_pospol_score_avg)
	print(total_negpol_score_avg)
	
	print(total_subjectivity_score_avg)
	
	
	finalpositivescore=.40*total_pos_score_avg+.40*total_pospol_score_avg+.2*total_subjectivity_score_avg
	finalnegativescore=.40*total_neg_score_avg+.40*total_negpol_score_avg+.2*total_subjectivity_score_avg
	
	print(finalpositivescore)
	print(finalnegativescore)
	
	if math.fabs(finalpositivescore) > math.fabs(finalnegativescore):
		return finalpositivescore 
	else:	
		return finalnegativescore
	
'''

	
def main():
	
	value=pd.read_csv("Infosys/tweetsenti1.csv",index_col=0)
	#create the sentiment dictionary using sentiwordnet 
	
	
	
	api = tweepy.API(auth)
	public_tweets = api.search('tcs', lang = 'en', since_id = 1111111, count = 2000, retweeted = False)
	public_tweets += api.search('infosys', lang = 'en', since_id = -1, count = 2000, retweeted = False)
	public_tweets += api.search('NatarajanChandrasekaran', lang = 'en', since_id = -1, count = 2000, pages =20, retweeted = False)
	public_tweets += api.search('Vishal Sikka', lang = 'en', since_id = -1, count = 2000, pages =20, retweeted = False)
	public_tweets += api.search('TATA', lang = 'en', since_id = -1, count = 2000, pages =20, retweeted = False)

	
	scores_dict = create_dict()

	'''
	words = []
	tweet_id_list = []
	final_tweets = []
	final_tweet_scores = list()

	value['Tweets']=value.Tweets.values.reshape(-1,1)
	value['Retweet_Count']=value.Retweet_Count.values.reshape(-1,1)
	value['Sentiment_Polarity']=value.Sentiment_Polarity.values.reshape(-1,1)
	value['Subjectivity']=value.Subjectivity.values.reshape(-1,1)
	
	length=len(value)
	
	'''
	
	for tweet in public_tweets:
		analysis = TextBlob(tweet.text)
		tokenized_tweets = tokenizeText(tweet.text, scores_dict)
		sent=sentimentAnalysis(tokenized_tweets, scores_dict,tweet.retweet_count)
		print(tweet.created_at+","+str(sent))
		df = pd.DataFrame(data=[[tweet.created_at,sent]],columns=['Date','Sentiment'])
		df.to_csv('SentiTweets.csv', mode='a', header=False)
		
	
	time.sleep(40)
	
	'''
		
		#use this line instead for all tweets
	#print "id = " + str(id) + " text = " + text + " num_followers = " + str(num_followers)
	#get the score of the company
	
	company_score = scoreTweets(final_tweet_scores,value) * 1000
	company_score = "{:10.3f}".format(company_score)
	
	if float(company_score) > 0:
		print("Decision: Buy\nConsumer Sentiment: " + str(company_score.lstrip()) + '% +')
	else:
		print("Decision: Sell\nConsumer Sentiment: " + str(company_score.lstrip()) + '% -')


		
	'''	
		
main()







