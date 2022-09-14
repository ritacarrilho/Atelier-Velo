import React from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import About from './pages/About';
import Contacts from './pages/Contacts';
import Events from './pages/Events';
import Home from './pages/Home';
import Services from './pages/Services';
import Store from './pages/Store';
import Error from './pages/Error';

const App = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={ <Home /> }></Route>
        <Route path="/evenements" element={ <Events /> }></Route>
        <Route path="/magasin" element={ <Store /> }></Route>
        <Route path="/activites" element={ <Services /> }></Route>
        <Route path="/contacts" element={ <Contacts /> }></Route>
        <Route path="/atelier" element={ <About/> }></Route>
        <Route path="*" element={ <Error /> }></Route>
      </Routes>
    </BrowserRouter>
  );
};

export default App;