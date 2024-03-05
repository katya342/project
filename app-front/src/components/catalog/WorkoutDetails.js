import { Box, Typography, Divider, Alert, Button } from "@mui/material";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import api from "../../api";
import { BASE_URL } from "../constants";

export default function Workouts() {
    const { catalogId } = useParams();
    const [workouts, setWorkouts] = useState([]);
    const [alert, setAlertShow] = useState(false);
    const [alertSeverity, setAlertSeverity] = useState("");
    const [alertMessage, setAlertMessage] = useState("");

    const handleAddWorkout = async (id) => {
        try {
            const response = await api.post(`/add-workout/${id}`);
            setAlertSeverity("success");
            setAlertMessage("Success");
            setAlertShow(true);
        } catch(error) {
            setAlertSeverity("error");
            setAlertMessage(error.response.data.message); 
            setAlertShow(true);
        }
    }

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await api.get(`/get-workout/${catalogId}`);
                setWorkouts(response.data.workouts);
            } catch (error) {
                console.error(error);
            }
        };

        fetchData();
    }, [catalogId]);

    return (
        <Box sx={{ maxWidth: 600, margin: "0 auto" }}>
            {alert && (
                <Alert
                    severity={alertSeverity}
                    onClose={() => { setAlertShow(false) }}
                    sx={{ position: 'fixed', bottom: '20px', right: '20px', zIndex: 9999 }}
                >
                    {alertMessage}
                </Alert>
            )}
            {workouts.map((workout) => (
                <Box key={workout.id} sx={{ border: 1, p: 3, mb: 3, borderRadius: 5, boxShadow: 2 }}>
                    <Typography variant="h5">{workout.title}</Typography>
                    <Typography variant="body1" sx={{ mt: 1, mb: 1 }}>{workout.description}</Typography>
                    <Divider />
                    <Typography variant="body2" sx={{ mt: 1, mb: 1 }}>Date: {workout.date}</Typography>
                    <Button onClick={() => handleAddWorkout(workout.id)} variant="contained" sx={{ mt: 1 }}>Add</Button>
                </Box>
            ))}
        </Box>
    );
}
