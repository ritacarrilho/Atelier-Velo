import React, { useEffect, useState } from 'react';

// Axios
import axios from 'axios';

// Components
import Banner from '../components/Banner';
import Header from '../components/Header';
import EvenementsList from '../components/EvenementsList';

const Events = () => {
    const [evenements, setEvenements] = useState([]);

    useEffect(() => {
        axios.get(`http://atelier.lndo.site/api/events`)
        .then(res =>  {
            setEvenements(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));    
    },[]);

    return (
        <>
            <Header />
            <Banner title = { "Nos Événements" } />
            <section className='events container'>
                <EvenementsList evenements = { evenements} />
            </section>
        </>
    );
};

export default Events;