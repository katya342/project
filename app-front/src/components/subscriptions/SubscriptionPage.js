import React, { useEffect, useState } from "react";
import api from "../../api";
import { useNavigate } from 'react-router-dom';
import { Box, Button, Container, Typography, makeStyles } from "@mui/material";

export default function SubscriptionPage() {
    const [planData, setPlanData] = useState([]);
    const [selectedPlan, setSelectedPlan] = useState(null);
    const [modal, setShowModal] = useState(false);
    const [errorMessage, setErrorMessage] = useState('');
    const navigate = useNavigate();
    useEffect(() => {
        api.get('/user/plans').then(response => {
            setPlanData(response.data['All plans: '] || []);
        });
    }, []);
    
  
    const redirectToPlansPage = (plan) => {
        console.log(plan);
        navigate(`/plans/${plan.id}`, { state: { planData: plan } });
    }
    return (
        <>
        
            <Container maxWidth="sm">
                {planData.map(plan => (
                    <Box key={plan.id}  m={2} textAlign={"center"}>
                        
                        <Typography>Name: {plan.name}</Typography>
                        <Typography>Price: {plan.price}</Typography>
                        <Typography>Duration: {plan.duration_months} months</Typography>
                        <Button variant="outlined"
                            onClick={() => redirectToPlansPage(plan)}
                        >
                            Select Plan
                        </Button>
                    </Box>
                ))}

            </Container>
        </>



    );
};


