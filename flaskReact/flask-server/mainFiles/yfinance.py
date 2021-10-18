from pandas_datareader import data as pdr
import pandas as pd
from datetime import date

import yfinance as yf
yf.pdr_override()  # <== that's all it takes :-)


def main(abc):
    sym = abc
    # download dataframe
    data1= pdr.get_data_yahoo(sym+".NS", start=date(2019,8,13),end=date(2021,9,13))
    var = yf.Ticker(sym + ".NS")
    data = var.history("1m")
    return data