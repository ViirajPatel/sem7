import pandas as pd 
import numpy as np 
import os 
import matplotlib.pyplot as plt
import yfinance as yf
from statsmodels.tsa.arima_model import ARIMA
quote="ITC"
daysToPredict  = 100
data = yf.download(tickers=quote + '.NS', period='5y', interval='1d')
data.to_csv("static/"+quote+".csv")
df = pd.read_csv("static/"+quote+".csv")
df= df["High"].copy()
df_new=df
n = int(len(df)*0.8)
train = df[:n]
test = df[n:]
model = ARIMA(df, order=(1,1,1))
result = model.fit(disp=0)
step = daysToPredict
fc , se, conf = result.forecast(step )
mse = np.mean(se)
rmse = np.sqrt(mse)
df_d=df.to_numpy()
df_d=np.concatenate((df_d,fc))
plt.plot(df_d)
plt.plot(df)
plt.savefig("abc.png")
plt.show()

