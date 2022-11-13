import React from "react";

// Icons
import MarcageIcon from '../images/marcage-icon.svg';
import FormationsIcon from '../images/formations-icon.svg';
import SchoolIcon from '../images/school-icon.svg';
import DefaultIcon from '../images/default-icon.svg';

const EventsCategories = ({ categories, handleClick}) => {

    const ServiceIcon = ( categorie ) => {
        switch (categorie.label) {
          case 'Balades':
              return <img key={ 'icon-1' } src={ SchoolIcon } alt={ SchoolIcon }/>
          case 'Activités':
              return <img key={ 'icon-2' } src={ MarcageIcon } alt={ MarcageIcon }/>
          case 'Formation de mécanique':
              return <img key={ 'icon-3' } src={ FormationsIcon } alt={ FormationsIcon }/>
          default:
              return <img key={ 'icon-4' } src={ DefaultIcon } alt={ DefaultIcon }/>    
        }
    }

    return (
        <div className='services-flex' onClick={ handleClick } >
            { categories.map(( categorie ) => (
                <div key={categorie.label}>
                    <a className="categories-label"  href={() => false} value={ categorie.id } >
                        { ServiceIcon( categorie )}
                        <p>{ categorie.label }</p>
                    </a>
                </div>
            ))}
        </div>
    );
};

export default EventsCategories;