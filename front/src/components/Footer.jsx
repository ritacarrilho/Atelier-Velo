import React from 'react';
import { Link } from 'react-router-dom';

// images
import Logo from '../images/footer-logo.svg';
import Facebook from '../images/facebook.svg';
import Instagram from '../images/instagram.svg';
import Linkedin from '../images/linkedin.svg';


const Footer = () => {
    return (
        <footer className='footer-container'>
             <Link to="/">
                <img src={ Logo } alt="Atelier Vélo du Vernet" className='footer-logo' />
            </Link>
            <div className='footer-icons-wrapper'>
                <Link to={{ pathname: "https://www.facebook.com" }} target="_blank">
                    <img key={ Facebook } src={ Facebook } alt="Atelier Vélo du Vernet" />
                </Link>
                <Link to={{ pathname: "https://www.instagram.com" }} target="_blank">
                    <img key={ Instagram } src={ Instagram } alt="Atelier Vélo du Vernet" />
                </Link>
                <Link to={{ pathname: "https://www.linkedin.com" }} target="_blank">
                    <img key={ Linkedin } src={ Linkedin } alt="Atelier Vélo du Vernet" />
                </Link>
            </div>
        </footer>
    );
};

export default Footer;