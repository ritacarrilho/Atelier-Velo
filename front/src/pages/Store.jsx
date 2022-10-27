import React from 'react';

// Components
import Header from '../components/Header';
import Banner from '../components/Banner';
import Footer from '../components/Footer';

const Store = () => {
    return (
        <div>
            <Header />
            <Banner title={'Nos Produits'} />
            <Footer />
        </div>
    );
};

export default Store;