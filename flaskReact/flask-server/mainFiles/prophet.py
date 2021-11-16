import pandas as pd
from prophet import Prophet
import itertools
import numpy as np
import plotly.graph_objects as go
import yfinance as yf


def predictProphet(quote):
    data = yf.download(tickers=quote + '.NS', period='5y', interval='1d')
    data.to_csv(quote+".csv")
    df_temp=pd.read_csv(quote+".csv")
    df_temp.tail()
    df_temp.rename(columns={df_temp.columns[0]:"Datetime"})
    df=df_temp[[df_temp.columns[0],"Close"]]