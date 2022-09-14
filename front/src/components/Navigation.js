import React from 'react';
import { NavLink } from 'react-router-dom';

const Navigation = () => {
    return (
        <div className='navigation'>
            <ul>
                <NavLink to="/">
                    <li>Accueil</li>
                </NavLink>
                <NavLink to="/evenements">
                    <li>Evènements</li>
                </NavLink>
                <NavLink to="/magasin">
                    <li>Magasin</li>
                </NavLink>
                <NavLink to="/activites">
                    <li>Activites</li>
                </NavLink>
                <NavLink to="/atelier">
                    <li>L'atelier</li>
                </NavLink>
                <NavLink to="/contacts">
                    <li>Contacts</li>
                </NavLink>

            </ul>
            
        </div>
    );
};

export default Navigation;