#!/usr/bin/env python
# coding: utf-8

# In[1]:


import matplotlib.pyplot as plt
import seaborn as sns
import pandas as pd
import numpy as np
import joblib
from sklearn.feature_selection import SelectKBest,f_classif
from sklearn.model_selection import train_test_split
from sklearn.neighbors import KNeighborsClassifier

import warnings; warnings.simplefilter('ignore')


# In[2]:


product = pd.read_csv('dataset.csv')
product


# In[3]:


product.info()


# In[4]:


product.describe(include = 'O')


# In[5]:


product['also_bought'] = product['also_bought'].fillna('')
product['brand'] = product['brand'].fillna('')


# In[6]:


product.shape


# In[7]:


x = product.drop(['recommendation','brand','also_bought'],axis=1)
y = product['recommendation']


# In[8]:


selector = SelectKBest(f_classif,k='all').fit(x, y)
x_new = selector.transform(x)
nb_features = x_new.shape[1]
x_train, x_test, y_train, y_test = train_test_split(x_new, y ,test_size=0.2)


# In[9]:


algorithms = {
 "KNN" : KNeighborsClassifier(n_neighbors=3)
}


# In[10]:


results = {}
print("\nNow testing algorithms")
for algo in algorithms:
    clf = algorithms[algo]
    clf.fit(x_train, y_train)#fit may be called as 'trained'
    score = clf.score(x_test, y_test)
    print("%s : %f %%" % (algo, score*100))
    results[algo] = score
    

winner = max(results, key=results.get)
print('\nWinner algorithm is %s with a %f %% success' % (winner, results[winner]*100))


# In[12]:


joblib.dump(algorithms[winner], 'classifier/classifier.pkl')#Persist an arbitrary Python object into one file.
#joblib works especially well with NumPy arrays which are used by sklearn so depending on the classifier type you use you might have performance and size benefits using joblib.Otherwise pickle does work correctly so saving a trained classifier and loading it again will produce the same results no matter which of the serialization libraries you use
print('Saved')


# In[ ]:




