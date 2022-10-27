import React from 'react';

const Banner = ( {title} ) => {

    return (
        <section className='banner'>
            <h1 className='banner-title'>{ title }</h1>
        </section>
    );
};

export default Banner;