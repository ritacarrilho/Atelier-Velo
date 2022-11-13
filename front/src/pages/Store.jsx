import React, { useEffect, useState } from 'react';
import ReactPaginate from 'react-paginate';

// Axios
import axios from 'axios';

// Components
import Header from '../components/Header';
import Banner from '../components/Banner';
import BicyclesList from '../components/BicyclesList';
import Footer from '../components/Footer';
import BicyclesCategories from '../components/BicyclesCategories';

const Store = () => {
    const elementsPerPage = 4;
    const [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState("");
    const [pageNumber, setPageNumber] = useState(0);
    const [initialProducts, setInitialProducts] = useState([]);
    const [bicycles, setBicycles] = useState([]);
    const [bicycleSizes, setBicycleSizes] = useState([]);
    // const [pageCount, setPageCount] = useState(Math.ceil(bicycles.length / elementsPerPage));

    const pagesVisited = pageNumber * elementsPerPage; // number of pages visited

    useEffect(() => {
        axios.get(`${process.env.REACT_APP_API_URL}bicycles`)
        .then(res =>  {
            const availableBicycles = res.data.filter((bicycle) => bicycle.disponibility === true);
            setInitialProducts(availableBicycles);
            setBicycles(availableBicycles);
            // console.log(res.data);
        })
        .catch(err => console.log(err));    

        axios.get(`${process.env.REACT_APP_API_URL}bicycle_sizes`)
        .then(res =>  {
            setBicycleSizes(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));  
        
        axios.get(`${process.env.REACT_APP_API_URL}bicycle_types`)
        .then(res =>  {
            setCategories(res.data);
            // console.log(res.data);
        })
        .catch(err => console.log(err));    

    },[]);

    let pageCount =  Math.ceil(bicycles.length / elementsPerPage);

    const changePage = ({ selected }) => {
        setPageNumber(selected);
    };

    const handleClick = (e) => {
        setSelectedCategory(e.target.innerText);
        setPageNumber(0);
        setBicycles(initialProducts.filter((bicycle) => 
            bicycle.size.size.includes(e.target.innerText) || 
            bicycle.type.type.includes(e.target.innerText)
        ));
    }
      
    return (
        <div>
            <Header />
            <Banner title={'Nos Produits'} />
            <section className='events-categories-labels container'>
                <BicyclesCategories types = { categories } sizes = {bicycleSizes} handleClick={ handleClick }/>
                {selectedCategory && <button onClick={() => { setSelectedCategory(""); setBicycles(initialProducts) } }>Annuler la recherche</button>}
            </section>

            <section className='bicycles-page container'>
            <h2 className='category-title'>{ selectedCategory }</h2>
                <div className='home-bicycles-cards-wrapper'>
                    {bicycles.length < 1 ? 
                        <p className='no-elements-p'>Aucun {selectedCategory} en ce moment !</p> :
                        bicycles
                            .slice(pagesVisited, pagesVisited + elementsPerPage)
                            .map(( bicycle ) => (
                                <BicyclesList key={ bicycle.id}  bicycle={ bicycle } /> 
                        )) 
                    }
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
        </div>
    );
};

export default Store;