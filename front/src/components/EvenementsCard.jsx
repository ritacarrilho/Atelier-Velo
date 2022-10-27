import React from "react";

// Icons
import ClockIcon from '../images/clock_icon.svg';
import PinIcon from '../images/pin-Icon.svg';

const EvenementsCard = ({ event }) => {
    // Date format
    let optionsCard = { day: 'numeric', month: 'long', year:'numeric' };
    let cardDate = new Date(event.event_date).toLocaleDateString("fr-FR", optionsCard);

    // Hors fotmat
    let dateOptions = { weekday: 'long'};
    let eventDate = new Date(event.event_date).toLocaleDateString("fr-FR", dateOptions) + ' à ' + new Date(event.event_date).getHours() + 'h' + new Date(event.event_date).getMinutes(); 
    
    // // Upcoming or finished event
    // let label;

    // if(new Date(event.event_date) > new Date()) {
    //     label = "Prochains Événements";
    // } else {
    //     label = "Événements Passés";
    // }

    return (
        <div key={event.id} className="card">
            <img key={event.image} src={event.image} alt={event.title} className='event-card-image' />
            <div className="card-info">
                <span className="event-date"> { cardDate}  </span>
                {new Date(event.event_date) > new Date() ? <h5>Prochains Événements</h5> : <h5>Événements Passés</h5>}
                <h3>{ event.title }</h3>
                <p>{ event.description }</p>
                <div className="date-wrapper">
                    <img key={ ClockIcon } src={ ClockIcon } alt={ event.Date } />
                    <p>{ eventDate }</p>
                </div>
                <div className="date-wrapper">
                    <img key={ PinIcon } src={ PinIcon } alt={ event.address } />
                    <p>{ event.address }</p>
                </div>
            </div>
        </div>
    );
};

export default EvenementsCard;