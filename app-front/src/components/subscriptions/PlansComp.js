import { useState, useEffect } from "react";
import api from "../../api";
import { useLocation, useNavigate, useParams } from "react-router-dom";
import { BASE_URL } from "../constants";
import FeedBack from "./FeedBack";
import Alert from '@mui/material/Alert';
import { Avatar, Box, Button, Container, Grid, Typography } from "@mui/material";

export default function PlansComp() {
    const [info, setInfo] = useState(null);
    const [alert, setAlertShow] = useState(false);
    const [alertSeverity, setAlertSeverity] = useState("");
    const [alertMessage, setAlertMessage] = useState("");
    const { planId } = useParams();
    const location = useLocation();
    const navigate = useNavigate();
    const { planData } = location.state;
    useEffect(() => {
        const fetchData = async () => {
            try {

                const response = await api.get(`plan-info/${planId}`);
                const { trainer } = response.data;

                setInfo(trainer);
            } catch (error) {
                console.error('Error fetching plan info:', error);
            }
        };

        fetchData();
    }, [planId]);

    const handleSubscribe = () => {

        if (planId) {
            api.post(`/user/add-subscription/${planId}`)
                .then(response => {

                    setAlertSeverity("success");
                    setAlertMessage(response.data.message);
                    setAlertShow(true);

                })
                .catch(error => {
                    if (error.response.status == 400) {
                        setAlertSeverity("error");
                        setAlertMessage(error.response.data.error)
                        setAlertShow(true);

                    }
                    else {
                        setAlertSeverity("error");
                        console.log(error.response.data.message)
                        setAlertMessage(error.response.data.message)
                        setAlertShow(true);
                    }

                });
        }
    }
    if (!info) {
        return <Typography>Loading...</Typography>;
    }
    return (
        <>
            {alert && (
                <Alert
                    severity={alertSeverity} onClose={() => { setAlertShow(false) }}
                    sx={{ position: 'fixed', bottom: '20px', right: '20px', zIndex: 9999 }}
                >
                    {alertMessage}
                </Alert>
            )}
            <Container sx={{ padding: '40px' }}>

                <Box>
                    <Typography>Information about chosen plan</Typography>
                    <Typography>{planData.name}</Typography>
                    <Typography>Price: {planData.price}$</Typography>
                    <Typography>Duration: {planData.duration_months} months</Typography>
                </Box>

                <Box>

                    <Grid container alignItems='center' spacing={2}>
                        <Grid item>
                            <Avatar src={`${BASE_URL}${info.image_path}`} sx={{ width: 150, height: 150 }} alt="Cannot display image" />
                        </Grid>
                        <Grid item>
                            <Typography>{info.name}</Typography>
                            <Typography>{info.surname}</Typography>
                        </Grid>

                    </Grid>


                    <Typography>{info.description}</Typography>
                    <Typography>{info.year_exp} years of experience</Typography>
                    <blockquote>
                        <p>{info.quote}</p>

                    </blockquote>


                    <Button variant="outlined" onClick={() => handleSubscribe()}>Subscribe</Button>

                </Box>
                <Typography>Users comments subscribed to this plan</Typography>
                <FeedBack planId={planId} trainerId={planData.trainer_id} />

            </Container >




        </>
    );
}




