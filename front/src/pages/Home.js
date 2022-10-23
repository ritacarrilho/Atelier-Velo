import React, { useEffect, useState } from 'react';
import Navigation from '../components/Navigation';
import { useNavigate } from 'react-router-dom';
import banner from '../images/home_banner.jpg';
import Connection from '../http/Connection';
import axios, { Axios } from 'axios';
import { connectionService } from '../services/connection.services';
import { AxiosInstance} from '../http/AxiosInstance';
import { setAuthToken } from '../http/setAuthToken';
import { getAuthorizationHeader } from '../http/AxiosInstance';
// import HomeIntro from '../components/HomeIntro';
// import HomeBicycles from '../components/HomeBicycles';
// import CounterHome from '../components/CounterHome';
// import { AxiosInstance } from '../http/AxiosInstance';

const Home = () => {
    const navigate = useNavigate();
    const [services, setServices] = useState([]);

    const navigateServices = () => {
        // 👇️ navigate to /
        navigate('/activites');
    }

    useEffect(() => {
        Connection();

        // axios.get(`http://atelier.lndo.site/api/events`, {
        //     headers: {
        //       'Authorization': `AuthToken ${connectionService.isConnected}`
        //     }
        // })
        //     .then(res => {
        //         console.log(res.data);
        //     })
        //     .catch(err => console.log(err));

        AxiosInstance.get(`/services`)
            .then(res =>  {
                // setServices(res.data);
                console.log(res)
            })
            .catch(err => console.log(err));
    }, [])


    return (
        <>
            <Navigation />
            <section className="home-banner">
                <img src={banner} className="home-img-banner"></img>
            </section>

            <section>
                <h2>Nos Services</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ac et adipiscing pellentesque amet viverra. Fusce phasellus pulvinar amet tellus ullamcorper enim amet. Tristique vitae est cursus dolor purus. Pellentesque in nulla sodales dolor. Arcu in arcu in tellus massa. Volutpat sed enim, risus aliquam proin tellus pellentesque facilisi. Vel non tellus, libero porta est ultricies at sit. Ipsum enim risus in feugiat quam purus tincidunt. Dignissim quis euismod viverra imperdiet tristique est. Aliquam elit varius ut elit tempor et risus ut. </p>
                <button onClick={navigateServices}>En savoir +</button>
            </section>

        </>
        )

  };

export default Home;