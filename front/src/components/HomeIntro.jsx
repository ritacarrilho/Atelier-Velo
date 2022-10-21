import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import axios from 'axios';
import { faBicycle} from '@fortawesome/free-solid-svg-icons';
import React, { useEffect } from "react";
import { useState } from "react";
import { AxiosInstance } from '../http/AxiosInstance';

const HomeIntro = () => {

    const [services, setServices] = useState();

    useEffect(() => {
        AxiosInstance.get(`/services`)
            .then(res =>  {
                setServices(res.data);
                // console.log(res.data)
            })
            .catch(err => console.log(err));
    }, [])

    console.log(services);

    return (
        <section className='home-intro container'>
            <h1>Atelier Vélo du Vernet</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ac et adipiscing pellentesque amet viverra. Fusce phasellus pulvinar amet tellus ullamcorper enim amet. </p>
            <p>Tristique vitae est cursus dolor purus. Pellentesque in nulla sodales dolor. Arcu in arcu in tellus massa.</p>
            <p>Volutpat sed enim, risus aliquam proin tellus pellentesque facilisi. Vel non tellus, libero porta est ultricies at sit. Ipsum enim risus in feugiat quam purus tincidunt. </p>
            <p>Dignissim quis euismod viverra imperdiet tristique est. Aliquam elit varius ut elit tempor et risus ut. </p>

            <div className='services-flex'>
                { services.map((service) => (
                    <div key={service.id}>
                        <FontAwesomeIcon icon={faBicycle} />
                        <p>{service.label}</p>
                    </div>
                ))}
                <div>
                </div>
            </div>
        </section>
    );
};

export default HomeIntro;