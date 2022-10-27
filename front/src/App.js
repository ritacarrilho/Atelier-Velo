import React from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";
//  pages
import About from './pages/About';
import Evenements from './pages/Evenements';
import Home from './pages/Home';
import Services from './pages/Services';
import Store from './pages/Store';
import Contacts from './pages/Contacts';
import Error from './pages/Error';

const App = () => {

  return (
    <>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={ <Home /> }></Route>
        <Route path="/evenements" element={ <Evenements /> }></Route>
        <Route path="/magasin" element={ <Store /> }></Route>
        <Route path="/services" element={ <Services /> }></Route>
        <Route path="/atelier" element={ <About/> }></Route>
        <Route path="/contacts" element={ <Contacts /> }></Route>
        <Route path="*" element={ <Error /> }></Route>
      </Routes>
    </BrowserRouter>
    </>
  );
};

export default App;