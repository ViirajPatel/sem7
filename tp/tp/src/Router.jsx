import React from "react";
 
import {
    BrowserRouter, Switch, Route,
    Link
} from "react-router-dom"
import App2 from "./App2";
 

function Router() {
    return(
   <BrowserRouter>
   
    <switch>

        
        <Route exact path="/about" component={App2}/>
       

    </switch>
   
   </BrowserRouter>
    )}

export default Router

