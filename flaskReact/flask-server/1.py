import yfinance as yf

msft = yf.Ticker("SBIN.NS")
hist = msft.history(period="1d",interval="5m")
print(hist)