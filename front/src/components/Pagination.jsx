import React from 'react';

const Pagination = ( selected, elements, pageNumber) => {


    const elementsPerPage = 10;
    const pagesVisited = pageNumber * elementsPerPage; // number of pages visited
    const pageCount =  Math.ceil(elements.length / elementsPerPage);

    // const changePage = ({ selected }) => {
    //     setPageNumber(selected);
    // };
 

    return (
        <div>
            
        </div>
    );
};

export default Pagination;