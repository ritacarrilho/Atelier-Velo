import React, { useEffect, useState } from 'react';
import axios from 'axios';

// Components
import Header from '../components/Header';
import Banner from '../components/Banner';
import { ServicesLabels } from '../components/ServicesLabels';
import ServicesList from '../components/ServicesList';
import Footer from '../components/Footer';

const Services = () => {
    const [services, setServices] = useState([]);

    useEffect (() => {
        axios.get(`http://atelier.lndo.site/api/services`)
        .then(res =>  {
            setServices(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));
    })

    return (
    <>
        <Header />
        <Banner title={'Nos Services'} />

        <section className='services-list container'>
            <ServicesLabels services={ services } />
        </section>

        <section id="services-section" className='services-cards-list container'>
            <ServicesList services = { services } />
        </section>
        
        <Footer />
    </>
)};

export default Services;