from pandas_datareader import data as pdr
import pandas as pd
from datetime import date

import yfinance as yf
yf.pdr_override()  # <== that's all it takes :-)

sym = "INFY"
# download dataframe
data = pdr.get_data_yahoo(sym+".NS", start=date(2019,8,13),end=date(2021,9,13))
df = pd.DataFrame(data)
df.to_csv(sym+".csv")
data = yf.download(tickers='IRCTC.NS', period='1d', interval='5m')
data.to_csv("IRCTC.csv")