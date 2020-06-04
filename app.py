#!/usr/bin/env python
# coding: utf-8

# In[1]:




import pandas
from sklearn.model_selection import train_test_split
import numpy as np
import time
import joblib
import Recommenders as Recommenders
import sys
import argparse
import os, sys, shutil, time

user = sys.argv[1]
# In[2]:


df =  pandas.read_csv('dataset.csv')
df


# In[3]:


len(df)


# In[4]:





#Merge song title and artist_name columns to make a merged column
df['item'] = df['product_name'].map(str) + " - " + df['brand']


# In[5]:


df


# In[6]:


item_grouped = df.groupby(['product_name']).agg({'order_frequency': 'count'}).reset_index()
grouped_sum = item_grouped['order_frequency'].sum()
item_grouped['percentage']  = item_grouped['order_frequency'].div(grouped_sum)*100
item_grouped.sort_values(['order_frequency', 'product_name'], ascending = [0,1])


# In[7]:


users = df['user_id']
len(users)


# In[8]:


products = df['product_name'].unique()
len(products)


# In[9]:



train_data, test_data = train_test_split(df, test_size = 0.20, random_state=0)
print(train_data.head(5))


# In[10]:


pm = Recommenders.popularity_recommender_py()
#pm.create(train_data, 'user_id', 'item')
pm.create(train_data, 'user_id', 'product_id')


# In[11]:



user_id = users[float(sys.argv[1])]
pm.recommend(user_id)





# In[13]:


is_model = Recommenders.item_similarity_recommender_py()
#is_model.create(train_data, 'user_id', 'item')
is_model.create(train_data, 'user_id', 'product_id')



# In[15]:



#Fill in the code here
user_items = is_model.get_user_items(user_id)
#
print("------------------------------------------------------------------------------------")
print("Training data products for the user userid: %s:" % user_id)
print("------------------------------------------------------------------------------------")

for user_item in user_items:
    print(user_item)

print("----------------------------------------------------------------------")
print("Recommendation process going on:")
print("----------------------------------------------------------------------")

#Recommend products for the user using personalized model
recommend = is_model.recommend(user_id)
print(recommend['product_id'])

# In[ ]:




