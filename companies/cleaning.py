import pandas as pd 

data = pd.read_csv("NSEPricedata.csv")
print(data)
cleanedData = data.dropna()
print(cleanedData)

cleanedData.to_csv("CleanedNSEPricedata.csv")