import csv
import numpy as np
import pandas as pd


df = pd.read_csv("input/tcsnews.csv", index_col = 0)

df.sort_values('1')

print(df.head(5))