import React from 'react';
import { ServiceIcon } from './ServicesLabels';

// Icons
import SensibilisationIcon from '../images/sensibilisation-icon.svg';
import RecuperationIcon from '../images/recup-icon.svg';
import MarcageIcon from '../images/marcage-icon.svg';
import FormationsIcon from '../images/formations-icon.svg';
import AnimationsIcon from '../images/animations-icon.svg';
import SchoolIcon from '../images/school-icon.svg';
import DefaultIcon from '../images/default-icon.svg';

// Images
import Ecole from '../images/ecole-img.jpg';
import Bicycode from '../images/bicycode-img.jpg';
import Animations from '../images/animations-img.jpg';
import Recup from '../images/recup-img.jpg';
import Formations from '../images/formations-img.jpg';
import Actions from '../images/actions-img.jpg';

const ServicesCard = ({ service }) => {

    return (
            <div key={service.id} id= {service.id} className="card">
                {(() => {
                    switch (service.label) {
                        case 'Vélo école':
                            return <img key={ service.id } src={ Ecole } alt={ SchoolIcon } className='event-card-image' />
                        case 'Marquage bicycode':
                            return <img key={ service.id } src={ Bicycode } alt={ MarcageIcon } className='event-card-image' />
                        case 'Animations':
                            return <img key={ service.id } src={ Animations } alt={ AnimationsIcon } className='event-card-image' />
                        case 'Récuperation de vélos':
                            return <img key={ service.id } src={ Recup } alt={ RecuperationIcon } className='event-card-image' />
                        case 'Formations mécaniques':
                            return <img key={ service.id } src={ Formations } alt={ FormationsIcon } className='event-card-image' />
                        case 'Actions de sensibilisation':
                            return <img key={ service.id } src={ Actions } alt={ SensibilisationIcon } className='event-card-image' />   
                        default:
                            return <img key={ service.id } src={ Ecole } alt={ DefaultIcon } className='event-card-image' />   
                    }
                    })()}
                <div className="card-info">
                    <span className='services-card-icon'>{ ServiceIcon( service ) }</span>
                    <h3>{ service.label }</h3>
                    <p>{ service.description }</p>
                </div>
            </div>
    );
};

export default ServicesCard;