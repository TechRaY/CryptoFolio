# CryptoFolio
The Ultimate Cryptocurrency Challenge Hackathon ( 36 hrs :) )

Problem Statement: There are about more than 100 cryptocurrencies which are used by a investor/user. This large number and variety makes it difficult to understand it and manage the purchases and the holdings by the user. Also keeping track of different rates at various coin exchange markets is a cumbersome task. 

Problems that we addressed during the competition : 1)Avoiding Naive traders from falling in the trap of Pump and Dump. 2) Helping users to get familiarised with Cryptocurrencies. 3)Correlation of Public Sentiments and Cryptocurrency prices along with historical trends.
4)Real time tracking of multiple portfolios simultaneously. 5)Real time charts and alerts.

Our Approach : Combined Approach -> 1)Sentiment Analysis 2)Trend Forecasting 3)Better Visulaization of Data with Analysis Reports.  

DataSet Used: 1)NewsFeed (moneycontol.com, reuters.com) 2)Reddit Feed 3)Twitter Feeds 4)TimeSeries Data from coinmarketcap.com

Algorithms Used : 1)CNN + LSTM model for Analysis of Textdata (wider network model gave better than that of Deep learning one).
2)Multistacked LSTM model (2 layered model helped us achieve better result, 3 layered seemed to overfit the data). (For removing the seasonality used log1 differentiation technique).

API's Used : 1)Coinberg Api 2)Cryptocompare Api 3)Twitter Api 4)Google Oauth Api 5)Facebook Oath Api 6)Google Translate 7)DialogFlow Chatbot Api 8)Php-textlocal sms api 9)PHPMailer  

Papers Referred : 1)Cryptocurrency Pumping Predictions: A Novel Approach to Identifying Pump And Dump Schemes http://cs229.stanford.edu/proj2017/final-reports/5231579.pdf
2)Combination of Convolutional and Recurrent Neural Network for Sentiment Analysis of Short Texts http://www.aclweb.org/anthology/C16-1229

Requirements (Python packages): Keras, Tensorflow, Numpy, Scipy, Pandas, Tweepy, Beautiful Soup, LDA packages, Requests, etc.
And a hell lot of Caffeine to remain wake up throughout :) . 
