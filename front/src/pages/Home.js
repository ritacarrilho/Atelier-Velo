import React from 'react';
import Navigation from '../components/Navigation';
import Evenements from '../components/Evenements';
import { useNavigate } from 'react-router-dom';
import banner from '../images/home_banner.jpg';
import HomeIntro from '../components/HomeIntro';


const Home = () => {
    const navigate = useNavigate();

    const navigateServices = () => {
        // 👇️ navigate to /
        navigate('/activites');
    }

    return (
        <>
            <Navigation />
            <section className="home-banner">
                <img src={banner} className="home-img-banner"></img>
            </section>
            <HomeIntro />

            <Evenements />

            <section>
                <h2>Nos Services</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ac et adipiscing pellentesque amet viverra. Fusce phasellus pulvinar amet tellus ullamcorper enim amet. Tristique vitae est cursus dolor purus. Pellentesque in nulla sodales dolor. Arcu in arcu in tellus massa. Volutpat sed enim, risus aliquam proin tellus pellentesque facilisi. Vel non tellus, libero porta est ultricies at sit. Ipsum enim risus in feugiat quam purus tincidunt. Dignissim quis euismod viverra imperdiet tristique est. Aliquam elit varius ut elit tempor et risus ut. </p>
                <button onClick={navigateServices}>En savoir +</button>
            </section>
        </>
        )

  };

export default Home;