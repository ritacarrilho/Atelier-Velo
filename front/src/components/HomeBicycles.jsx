import React, { useEffect } from "react";
import { useState } from "react";
import axios from "axios";


const HomeBicycles = () => {
    // const[bicycles, setBicycles] = useState([]);

    // useEffect(() => {
    //     axios
    //         .get('http://atelier.lndo.site/api/bicycles')
    //         .then((res) => setBicycles(res.data))
    //         .catch((err) =>console.log(err));
    // }, [])

    return (
        <section id="home-bicycles" className="container">
                <h2>Vélos à vendre</h2>
            <div>
            </div>
            
        </section>
    );
};

export default HomeBicycles;