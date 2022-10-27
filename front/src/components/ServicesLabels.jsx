import React from "react";
import { Link } from "react-router-dom";
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
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ SchoolIcon } alt={ SchoolIcon }/></Link> 
      case 'Marquage bicycode':
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ MarcageIcon } alt={ MarcageIcon }/></Link>
      case 'Animations':
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ AnimationsIcon } alt={ AnimationsIcon }/></Link>
      case 'Récuperation de vélos':
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ RecuperationIcon } alt={ RecuperationIcon }/></Link>
      case 'Formations mécaniques':
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ FormationsIcon } alt={ FormationsIcon }/></Link>
      case 'Actions de sensibilisation':
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ SensibilisationIcon } alt={ SensibilisationIcon }/> </Link>  
      default:
          return <Link to={`#${ service.id}`} ><img key={ service.id } src={ DefaultIcon } alt={ DefaultIcon }/></Link>     
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