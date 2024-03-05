import { useState, useEffect } from "react";
import api from "../../api";

import {Box, Typography} from "@mui/material";

const SubsComponent = () => {
    const [subData, setSubData] = useState([]);
    const [unactiveSubData, setUnactiveSubData] = useState([]);
    const [activeCounter, setActiveCounter] = useState(0);
    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await api.get('/user/active-subs');
                if (Array.isArray(response.data.success)) {
                    setSubData(response.data.success);
                    const counter = response.data.success.reduce((acc, sub) => acc + (sub.active ? 1 : 0), 0);
                    setActiveCounter(counter);
                    const secondResponse = api.get('/user/unactive-subs');
                    setUnactiveSubData(secondResponse);
                } else {
                    console.error('Invalid data format:', response.data);
                }
            } catch (error) {
                console.error('Error fetching active subscriptions:', error);
            }
        };
    
        fetchData();
    }, []);
    

    return (
        <Box>
            <Typography>Activated subscription count: {activeCounter}</Typography>
        </Box>
    );
};

export default SubsComponent;
