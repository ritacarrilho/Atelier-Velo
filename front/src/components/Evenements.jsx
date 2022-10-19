import axios from "axios";
import React, { useEffect } from "react";
import { useState } from "react";
// import Connector from './Connection';

const Evenements = () => {
    const[events, setEvents] = useState([]);

useEffect(() => {
    axios
        .get('http://atelier.lndo.site/api/events')
        // .then((res) => console.log(res.data))
        .then((res) => setEvents(res.data))
        .catch((err) =>console.log(err));
}, [])

    return (
        <div>
            
        </div>
    );
};

export default Evenements;