import React from 'react';
import { NavLink } from 'react-router-dom';
import logo from '../images/logo_header.svg';
import HomeIntro from './HomeIntro';

const Navigation = () => {
    return (
        <>
        <input type="checkbox" id="burger-toggle"></input>
        {/* // Menu Mobile */}
        <nav>
            <label htmlFor="burger-toggle" className="burger-menu">
                <div className="line"></div>
                <div className="line"></div>
                <div className="line"></div>
            </label>
            <div className="logo-mobile">
                <img src={logo} alt={logo} />
            </div>
        </nav>

        <div className="menu">
            <div className="menu-inner"> 
            <ul className="menu-nav">
                <li className="menu-nav-item"> 
                    <NavLink to="/">
                        <span><div>Accueil</div></span>
                    </NavLink>
                </li>
                <li className="menu-nav-item">
                    <NavLink to="/evenements">
                        <span><div>Evènements</div></span>
                    </NavLink>
                </li>
                <li className="menu-nav-item">
                    <NavLink to="/magasin">
                        <span><div>Magasin</div></span>
                    </NavLink>
                </li>
                <li className="menu-nav-item">
                    <NavLink to="/activites">
                        <span><div>Activites</div></span>
                    </NavLink>
                </li>
                <li className="menu-nav-item">
                    <NavLink to="/atelier">
                        <span><div>L'atelier</div></span>
                    </NavLink>
                </li>
                <li className="menu-nav-item">
                    <NavLink to="/contacts">
                        <span><div>Contacts</div></span>
                    </NavLink>
                </li>

            </ul>
            <div className="gallery">
            <div className="title">
                <p>Atelier Vélo du Vernet</p>
            </div>
            <div className="images">
                <a className="image-link" href="#">
                <div className="image" data-label="Star"><img src="https://i.loli.net/2019/11/23/cnKl1Ykd5rZCVwm.jpg" alt="" /></div>
                </a>
                <a className="image-link" href="#">
                <div className="image" data-label="Sun"><img src="https://i.loli.net/2019/11/16/FLnzi5Kq4tkRZSm.jpg" alt="" /></div>
                </a>
                <a className="image-link" href="#">
                <div className="image" data-label="Tree"><img src="https://i.loli.net/2019/10/18/uXF1Kx7lzELB6wf.jpg" alt="" /></div>
                </a>
                <a className="image-link" href="#">
                <div className="image" data-label="Sky"><img src="https://i.loli.net/2019/10/18/buDT4YS6zUMfHst.jpg" alt="" /></div>
                </a>
            </div>
            </div>
        </div>
        </div>
        </>
    );
};

export default Navigation;