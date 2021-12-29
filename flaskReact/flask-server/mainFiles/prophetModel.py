import pandas as pd
from prophet import Prophet
import os
import numpy as np
import plotly.graph_objects as go
import yfinance as yf
from sklearn.metrics import r2_score, mean_absolute_error


def predictProphet(quote, daysToPredict):
    
    if os.path.exists("static/prophet/"+quote+".png"):
        print("okoko")
        os.remove("static/prophet/"+quote+".png")
 
    data = yf.download(tickers=quote + '.NS', period='5y', interval='1d')
    data.to_csv("static/prophet/"+quote+".csv")
    df_temp = pd.read_csv("static/prophet/"+quote+".csv")
    
    df_temp.rename(columns={df_temp.columns[0]:"Datetime"})
    df=df_temp[[df_temp.columns[0],"Close"]]
    df.columns = ['ds', 'y']
    m = Prophet(interval_width=0.9, daily_seasonality=True)
    model = m.fit(df)
    future = m.make_future_dataframe(periods=daysToPredict, freq='D')
    forecast = m.predict(future)
    se = np.square(forecast.loc[:, 'yhat'] - df["y"])
    mse = np.mean(se)
    rmse = np.sqrt(mse)
    mae = mean_absolute_error(df['y'], forecast.loc[:, 'yhat'][:-daysToPredict])
    r2 = r2_score(df['y'], forecast.loc[:, 'yhat'][:-daysToPredict])
    plotted = m.plot(forecast)
    plotted.savefig("static/prophet/"+quote+".png")
    output = forecast[:-daysToPredict]
    
    return rmse,mae,r2,output['yhat']
