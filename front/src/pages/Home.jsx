// React
import React, { useEffect, useState } from 'react';
import Header from '../components/Header';
import { useNavigate, Link} from 'react-router-dom';

//  Axios
// import Connection from '../http/Connection';
import axios from 'axios';
// import { AxiosInstance} from '../http/AxiosInstance';

// Components
import { ServicesLabels } from '../components/ServicesLabels';
import BicyclesList from '../components/BicyclesList';
import EvenementsCard from '../components/EvenementsCard';
import Footer from '../components/Footer';
import { sortedByDate } from '../components/EvenementsList';

// images and icons
import banner from '../images/home_banner.jpg';
import introImage from '../images/intro_img.jpg';

const Home = () => {
    const navigate = useNavigate();
    const [services, setServices] = useState([]);
    const [bicyclesNb, setBicyclesNb] = useState([]);
    const [bicycles, setBicycles] = useState([]);

    const [subscribers, setSubscribers] = useState([]);
    const [evenements, setEvenements] = useState([]);
    const [nextEvenements, setNextEvenements] = useState([]);
    const [passedEvenements, setPassedEvenements] = useState([]);
    const [isDesktop, setDesktop] = useState(window.innerWidth > 1250);

    let title;

    let elementsNb;
    isDesktop ? elementsNb = 6 : elementsNb = 3;

    const updateMedia = () => {
        setDesktop(window.innerWidth > 1250);
    };

    const navigateServices = () => {
        navigate('/services');
    }

    evenements.map((evenement) => 
        new Date(evenement.event_date) >= new Date() ?
            nextEvenements.push(evenement) : passedEvenements.push(evenement)
    );
   
    // Events title
    nextEvenements.length > 0 ? title = 'Prochains Événements' : title = 'Événements Passés';

    // sort events by date
    const nextArr = sortedByDate(nextEvenements).reverse();
    const prevArr = sortedByDate(nextEvenements).reverse();

    useEffect(() => {
        axios.get(`${process.env.REACT_APP_API_URL}services`)
            .then(res =>  {
                setServices(res.data);
            })
            .catch(err => console.log(err));

        axios.get(`${process.env.REACT_APP_API_URL}bicycles`)
            .then(res =>  {
                setBicyclesNb(res.data);
                setBicycles(sortedByDate(res.data));
            })
            .catch(err => console.log(err));

        axios.get(`${process.env.REACT_APP_API_URL}subscribers`)
            .then(res =>  {
                setSubscribers(res.data);
            })
            .catch(err => console.log(err));

        axios.get(`${process.env.REACT_APP_API_URL}events`)
            .then(res =>  {
                setEvenements(res.data);     
        })
            .catch(err => console.log(err));

        window.addEventListener("resize", updateMedia);
        
        return () => {
            window.removeEventListener('resize', updateMedia);
          };
    }, []);

    return (
        <>
            <Header />

        {/* Banner */}
            <section className="home-banner">
                <img key= { banner } src={ banner } className="home-img-banner" alt={ banner }></img>
            </section>

        {/* Atelier presentation */}
            <section className='home-intro container'>
                <div className='home-intro-flex'>
                    <h1>Atelier Vélo du Vernet</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ac et adipiscing pellentesque amet viverra. Fusce phasellus pulvinar amet tellus ullamcorper enim amet. </p>
                    <p>Tristique vitae est cursus dolor purus. Pellentesque in nulla sodales dolor. Arcu in arcu in tellus massa.</p>
                    <p>Volutpat sed enim, risus aliquam proin tellus pellentesque facilisi. Vel non tellus, libero porta est ultricies at sit. Ipsum enim risus in feugiat quam purus tincidunt. </p>
                    <p>Dignissim quis euismod viverra imperdiet tristique est. Aliquam elit varius ut elit tempor et risus ut. </p>
                    <ServicesLabels services = { services }/>
                </div>

                <div className='home-intro-image-container'>
                    <img key="image" src={ introImage } alt={ introImage } className='image-intro-atelier'/>
                </div>
            </section>

        {/* Counter */}
            <section className='home-counter'>
                <p>{subscribers.length} Adhérents</p>
                <p>{bicyclesNb.length} Vélos Récupérés</p>
            </section>

            <section className='home-bicycles container'>
                <h2>Les Vélos</h2>
                <div className='home-bicycles-cards-wrapper'>
                    { bicycles
                        .slice(-elementsNb)
                        .map(( bicycle ) => (
                            <BicyclesList key={ bicycle.id}  bicycle={ bicycle } /> 
                    )) }
                </div>
            </section>

        {/* Services */}
            <section className='home-services'>
                <div className='home-services-container container'>
                    <h2>Nos Services</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ac et adipiscing pellentesque amet viverra. Fusce phasellus pulvinar amet tellus ullamcorper enim amet. Tristique vitae est cursus dolor purus. Pellentesque in nulla sodales dolor. Arcu in arcu in tellus massa.</p>
                    <p>Volutpat sed enim, risus aliquam proin tellus pellentesque facilisi. Vel non tellus, libero porta est ultricies at sit. Ipsum enim risus in feugiat quam purus tincidunt. Dignissim quis euismod viverra imperdiet tristique est. Aliquam elit varius ut elit tempor et risus ut.</p>
                    <button className='home-services-btn btn' onClick={navigateServices}>En savoir +</button>
                </div>
            </section>

        { /*  Events */}
            <section className='home-events container'>
                <h2>{ title }</h2>
                    <div className='cards-wrapper'> 
                { nextEvenements.lenght > 0 ? 
                    nextArr
                        .slice(0,elementsNb)
                        .map(( evenement ) => (
                            <EvenementsCard key={ evenement.id}  event = { evenement } /> 
                    )) : 
                    prevArr
                        .slice(0,elementsNb)
                        .map(( evenement ) => (
                            <EvenementsCard key={ evenement.id}  event = { evenement } /> 
                    ))
                    }
                </div>
            </section>

        {/* Quote */}
            <section className='home-quote container'>
                <h6>Pour devenir adhérent rejoindrez nous à l'atelier !</h6>
                <Link to="/atelier" className="btn">En savoir +</Link>
            </section>

        {/* Footer */}
            <Footer />
        </>
    )
};

export default Home;