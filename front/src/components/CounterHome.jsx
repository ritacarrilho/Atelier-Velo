import React, { useState, useEffect } from 'react';
import { AxiosInstance } from '../http/AxiosInstance';

const CounterHome = () => {
    const [subscribers, setSubscribers] = useState([]);
    const [bicycles, setBicycles] = useState([]);


    useEffect(() => {
        AxiosInstance.get(`/subscribers`)
            .then(res =>  {
                setSubscribers(res.data);
                // console.log(res.data)
            })
            .catch(err => console.log(err));
    }, [])

    useEffect(() => {
        AxiosInstance.get(`/bicycles/`)
            .then(res =>  {
                setBicycles(res.data);
                console.log(res.data)
            })
            .catch(err => console.log(err));
    }, [])

    const bicyclesCounter = subscribers.filter((e) => e.disponibility == false);


    console.log(bicyclesCounter);

    // console.log(Object.keys(subscribers).length);
    return (
        <section className='counter-section'>
                <span>{Object.keys(subscribers).length} Adherents</span> 
                <span>{Object.keys(bicyclesCounter).length} Vélos Récuperés</span> 
        </section>
    );
};

export default CounterHome;