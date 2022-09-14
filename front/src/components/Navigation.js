import React from 'react';
import { NavLink } from 'react-router-dom';

const Navigation = () => {
    return (
        <div className='navigation'>
            <ul>
                <NavLink to="/" className={(nav) => (nav.isActive ? "nav-active" : "")}>
                    <li>Accueil</li>
                </NavLink>
                <NavLink to="/evenements" className={(nav) => (nav.isActive ? "nav-active" : "")}>
                    <li>Evènements</li>
                </NavLink>
                <NavLink to="/magasin" className={(nav) => (nav.isActive ? "nav-active" : "")}>
                    <li>Magasin</li>
                </NavLink>
                <NavLink to="/activites" className={(nav) => (nav.isActive ? "nav-active" : "")}>
                    <li>Activites</li>
                </NavLink>
                <NavLink to="/atelier" className={(nav) => (nav.isActive ? "nav-active" : "")}>
                    <li>L'atelier</li>
                </NavLink>
                <NavLink to="/contacts" className={(nav) => (nav.isActive ? "nav-active" : "")}>
                    <li>Contacts</li>
                </NavLink>

            </ul>
            
        </div>
    );
};

export default Navigation;