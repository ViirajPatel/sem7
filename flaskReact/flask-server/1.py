import pandas as pd

df = pd.read_csv("https://docs.google.com/spreadsheets/d/e/2PACX-1vQ2MU4egl62xhdNShFslsocErbZXfe1OAsjI2uZXzUzLKZSQDmXNTRCqnmNHVRCItH96CVDKleJePaz/pub?output=csv")
print(df)
result = df[["Symbol","CompanyName"]].to_json("companies.json")