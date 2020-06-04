import os
import array
import math
import pickle
from sklearn.externals import joblib
import sys
import argparse
import os, sys, shutil, time

from sklearn.externals import joblib

clf = joblib.load(os.path.join(os.path.dirname(os.path.realpath(__file__)),'classifier/classifier.pkl'))
res = clf.predict([[sys.argv[1]]])[0]
print(res)