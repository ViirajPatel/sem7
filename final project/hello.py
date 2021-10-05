from flask import Flask
import pandas  as  pd
import matplotlib.pyplot as plt



app = Flask(__name__)

@app.route("/")
def hello_world():
    df = pd.read_csv("TATACHEM.csv")
    print(df)
    return 