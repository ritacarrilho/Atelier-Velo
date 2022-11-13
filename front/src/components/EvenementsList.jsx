import React from 'react';
import EvenementsCard from '../components/EvenementsCard';

export const sortedByDate = (arr) => arr.sort((a,b) => {
    return new Date(a.event_date).getTime() - new Date(b.sevent_date).getTime()
}).reverse();

const EvenementsList = ( {evenements} ) => {

    console.log(sortedByDate(evenements));

    return (
        <div className='cards-wrapper'>
        { sortedByDate(evenements.map(( evenement ) => (
            <EvenementsCard key={ evenement.id}  event = { evenement } /> 
        )))}
    </div>

    );
};

export default EvenementsList;