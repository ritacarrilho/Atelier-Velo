import React, { useEffect, useState } from 'react';

// Axios
import axios from 'axios';

// Components
import Banner from '../components/Banner';
import Header from '../components/Header';
import EvenementsCard from '../components/EvenementsCard';
import Footer from '../components/Footer';
import EventsCategories from '../components/EventsCategories';
import { sortedByDate } from '../components/EvenementsList';

const Events = () => {
    const [evenements, setEvenements] = useState([]);
    const [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState("");

    const handleClick = (e) => {
        setSelectedCategory(e.target.innerText);
    }

    useEffect(() => {
        axios.get(`http://atelier.lndo.site/api/events`)
        .then(res =>  {
            setEvenements(res.data);
            console.log(res.data);
        })
        .catch(err => console.log(err));    

        axios.get(`http://atelier.lndo.site/api/event_categories`)
        .then(res =>  {
            setCategories(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));  

    },[]);

    return (
        <>
            <Header />
            <Banner title = { "Nos Événements" } />
            <section className='events-categories-labels container'>
                <EventsCategories categories = { categories } handleClick={ handleClick }/>
                {selectedCategory && <button onClick={() => setSelectedCategory("") }>Annuler la recherche</button>}
            </section>
            <section className='events container'>
                <h2 className='event-category-title'>{ selectedCategory }</h2>
                <div className='cards-wrapper'>
                    { sortedByDate(evenements
                        .filter((evenement) => evenement.category_id.label.includes(selectedCategory))
                        .map(( evenement ) => (
                        <EvenementsCard key={ evenement.id}  event = { evenement } /> 
                    )))}
                </div>
            </section>
            <Footer />
        </>
    );
};

export default Events;