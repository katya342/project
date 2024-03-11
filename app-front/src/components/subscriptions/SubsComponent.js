import { useState, useEffect } from "react";
import api from "../../api";

import { Box, Button, Typography } from "@mui/material";

const SubsComponent = () => {
    const [activeSubData, setActiveSubData] = useState([]);
    const [unactiveSubData, setUnactiveSubData] = useState([]);
    const [activeCounter, setActiveCounter] = useState(0);
    
    const handleUnsubscribe = async(subId) => {
        try {
            await api.post(`/user/unsubscribe/${subId}`);
            // После отмены подписки обновляем данные
            fetchData();
        } catch (error) {
            console.error('Error unsubscribing:', error);
        }
    }
    // const fetchPlanData = async()
    const fetchData = async () => {
        try {
            const activeResponse = await api.get('/user/active-subs');
            setActiveSubData(activeResponse.data.success);
            const activeCounter = activeResponse.data.success.filter(sub => sub.active).length;
            setActiveCounter(activeCounter);

            const unactiveResponse = await api.get('/user/unactive-subs');
            setUnactiveSubData(unactiveResponse.data.success);
        } catch (error) {
            console.error('Error fetching subscriptions:', error);
        }
    };
    
    useEffect(() => {
        fetchData();
    }, []);
    
    return (
        <Box>
            <Typography>Activated subscription count: {activeCounter}</Typography>
            <Typography>Active Subscriptions:</Typography>
            <ul>
                {activeSubData.map(sub => (
                    <li key={sub.id}>
                        Plan ID: {sub.plan_id}, Expires at: {sub.expires_at}
                        <Button onClick={() => handleUnsubscribe(sub.id)}>Cancel subscription</Button>
                    </li>
                ))}
            </ul>
            <Typography>Inactive Subscriptions:</Typography>
            <ul>
                {unactiveSubData.map(sub => (
                    <li key={sub.id}>
                        Plan ID: {sub.plan_id}, Expires at: {sub.expires_at}
                    </li>
                ))}
            </ul>
        </Box>
    );
};

export default SubsComponent;
