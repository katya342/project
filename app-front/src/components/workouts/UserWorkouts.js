import React, { useState, useEffect } from "react";
import api from "../../api";
import { Box, Typography } from "@mui/material";

export default function UserWorkouts() {
    const [workouts, setWorkouts] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await api.get(`/get/user/workouts`);
                setWorkouts(response.data.workouts);
            } catch (error) {
                console.error(error);
            }
        };

        fetchData();
    }, []);

    return (
        <Box>
            <Typography variant="h4" gutterBottom>
                Your Workouts
            </Typography>
            {workouts.map((workout) => (
                <Box key={workout.id} sx={{ border: 1, p: 2, mb: 2 }}>
                    <Typography variant="h6">{workout.title}</Typography>
                    <Typography variant="body1">{workout.description}</Typography>
                    <Typography variant="body2">Date: {workout.date}</Typography>
                </Box>
            ))}
        </Box>
    );
}
