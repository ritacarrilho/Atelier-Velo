import React from 'react';
import ServicesCard from './ServicesCard';

const ServicesList = ({ services }) => {

    return (
        <div className='cards-wrapper'>
            { services.map(( service ) => (
                <ServicesCard key={ service.id}  service = { service } /> 
            ))}
        </div>
    )
};

export default ServicesList;