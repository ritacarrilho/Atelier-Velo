import React from "react";

// Icons
import SensibilisationIcon from '../images/sensibilisation-icon.svg';
import RecuperationIcon from '../images/recup-icon.svg';
import MarcageIcon from '../images/marcage-icon.svg';
import FormationsIcon from '../images/formations-icon.svg';
import AnimationsIcon from '../images/animations-icon.svg';
import SchoolIcon from '../images/school-icon.svg';
import DefaultIcon from '../images/default-icon.svg';


export const ServiceIcon = ( service ) => {
    switch (service.label) {
      case 'Vélo école':
          return <img key={ service.id } src={ SchoolIcon } alt={ SchoolIcon }/>
      case 'Marquage bicycode':
          return <img key={ service.id } src={ MarcageIcon } alt={ MarcageIcon }/>
      case 'Animations':
          return <img key={ service.id } src={ AnimationsIcon } alt={ AnimationsIcon }/>
      case 'Récuperation de vélos':
          return <img key={ service.id } src={ RecuperationIcon } alt={ RecuperationIcon }/>
      case 'Formations mécaniques':
          return <img key={ service.id } src={ FormationsIcon } alt={ FormationsIcon }/>
      case 'Actions de sensibilisation':
          return <img key={ service.id } src={ SensibilisationIcon } alt={ SensibilisationIcon }/>
      default:
          return <img key={ service.id } src={ DefaultIcon } alt={ DefaultIcon }/> 
    }
  }

export const ServicesLabels = ({ services }) => {

    return (
        <div className='services-flex'>
            { services.map((service) => (
                <div key={service.id}>
                    {ServiceIcon( service )}
                    <p>{service.label}</p>
                </div>
            ))}
        </div>
    );
};