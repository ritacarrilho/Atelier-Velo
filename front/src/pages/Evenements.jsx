import React, { useEffect, useState } from 'react';
import ReactPaginate from 'react-paginate';

// Axios
import axios from 'axios';

// Components
import Banner from '../components/Banner';
import Header from '../components/Header';
import EvenementsCard from '../components/EvenementsCard';
import Footer from '../components/Footer';
import EventsCategories from '../components/EventsCategories';
import { sortedByDate } from '../components/EvenementsList';
// import Pagination from '../components/Pagination';

const Events = () => {
    const evenementsPerPage = 10;
    const [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState("");
    const [pageNumber, setPageNumber] = useState(0);
    const [initialEvenements, setInitialEvenements] = useState([]);
    const [evenements, setEvenements] = useState([]);

    const pagesVisited = pageNumber * evenementsPerPage; // number of pages visited

    useEffect(() => {
        axios.get(`${process.env.REACT_APP_API_URL}events`)
        .then(res =>  {
            setInitialEvenements(res.data);
            setEvenements(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));    

        axios.get(`${process.env.REACT_APP_API_URL}event_categories`)
        .then(res =>  {
            setCategories(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));  
        
    },[]);

    const pageCount =  Math.ceil(evenements.length / evenementsPerPage);

    const changePage = ({ selected }) => {
      setPageNumber(selected);
    };

    const handleClick = (e) => {
        setSelectedCategory(e.target.innerText);
        setPageNumber(0);
        setEvenements(sortedByDate(initialEvenements.filter((evenement) => evenement.category_id.label.includes(e.target.innerText))));
    }

    return (
        <>
            <Header />
            <Banner title = { "Nos Événements" } />
            <section className='events-categories-labels container'>
                <EventsCategories categories = { categories } handleClick={ handleClick }/>
                {selectedCategory && <button onClick={() => { setSelectedCategory(""); setEvenements(initialEvenements) } }>Annuler la recherche</button>}
            </section>
            <section className='events container'>
                <h2 className='event-category-title'>{ selectedCategory }</h2>
                <div className='cards-wrapper'>
                    { evenements
                        // .filter((evenement) => evenement.category_id.label.includes(selectedCategory))
                        .slice(pagesVisited, pagesVisited + evenementsPerPage)
                        .map(( evenement ) => (
                        <EvenementsCard key={ evenement.id}  event={ evenement } /> 
                    ))}
                </div>
                    <ReactPaginate
                        previousLabel={"Précédent"}
                        nextLabel={"Suivant"}
                        pageCount={pageCount}
                        onPageChange={changePage}
                        containerClassName={"paginate-container "}
                        previousLinkClassName={"previousBttn"}
                        nextLinkClassName={"nextBttn"}
                        disabledClassName={"paginationDisabled"}
                        activeClassName={"paginationActive"}
                    />
            </section>
            <Footer />
        </>
    );
};

export default Events;