import { Container, FormControl, Typography, Input, InputLabel, FormHelperText, Box, Select, MenuItem, OutlinedInput, Button, Alert } from "@mui/material";
import { useEffect, useState } from "react";
import api from "../../api";

export default function Request() {
    const [trainers, setTrainers] = useState([]);
    const [alert, setAlertShow] = useState(false);
    const [alertSeverity, setAlertSeverity] = useState("");
    const [alertMessage, setAlertMessage] = useState([]);
    const [info, setInfo] = useState(null);
    const [userData, setUserData] = useState({
        name: '',
        phone: '',
        email: '',
        trainer: '',
    });

    const getTrainer = async () => {
        try {
            const response = await api.get('/trainers');
            setTrainers(response.data.trainers);
        } catch (error) {
            console.error("Error fetching trainers:", error);
        }
    };

    const handleChange = (event) => {
        const {
            target: { value },
        } = event;
        const selectedTrainer = trainers.find(trainer => trainer.name === value);
        setInfo(selectedTrainer || null);
        setUserData(prevState => ({ ...prevState, trainer: value }));
    };

    const handleInputChange = (event) => {
        const { name, value } = event.target;
        setUserData(prevState => ({ ...prevState, [name]: value }));
    };

    const handleSend = async () => {
        try {
            const formDataToSend = new FormData();
            formDataToSend.append('user_name', userData.name);
            formDataToSend.append('email', userData.email);
            formDataToSend.append('phone', userData.phone);
            formDataToSend.append('trainer_name', userData.trainer);
            const response = await api.post(`/store/request/${info.id}`, formDataToSend, {
                headers: { 'Content-Type': 'multipart/form-data' },
            });
            console.log(response);
            setAlertMessage("Successfully request sending!");
            setAlertSeverity("success");
            setAlertShow(true);
            setUserData({
                name: '',
                phone: '',
                email: '',
                trainer: '',
            });
        } catch (error) {
            console.error("Error sending request:", error);
            setAlertMessage(error.response.data.message);
            setAlertSeverity("error");
            setAlertShow(true);
        }
    };

    useEffect(() => {
        getTrainer();
    }, []);

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

            <Container component='main' maxWidth='xs'>
                <Box sx={{
                    display: 'flex',
                    flexDirection: 'column',
                    alignItems: 'center',
                }}>
                    <Typography>Leave a request for training</Typography>
                    <FormControl sx={{ width: 290, m: 1 }}>
                        <InputLabel htmlFor="my-input-1">Name</InputLabel>
                        <Input id="my-input-1" name="name" onChange={handleInputChange} value={userData.name} />
                    </FormControl>
                    <FormControl sx={{ width: 290, m: 1 }}>
                        <InputLabel htmlFor="my-input-2">Phone</InputLabel>
                        <Input id="my-input-2" name="phone" onChange={handleInputChange} value={userData.phone} />
                        <FormHelperText id="my-helper-text">We'll never share your phone number.</FormHelperText>
                    </FormControl>
                    <FormControl sx={{ width: 290, m: 1 }}>
                        <InputLabel htmlFor="my-input-3">Email</InputLabel>
                        <Input id="my-input-3" name="email" onChange={handleInputChange} value={userData.email} />
                    </FormControl>
                    <FormControl sx={{ width: 290, m: 1 }}>
                        <InputLabel id="demo-multiple-name-label">Select a trainer</InputLabel>
                        <Select
                            labelId="demo-multiple-name-label"
                            onChange={handleChange}
                            value={userData.trainer}
                            input={<OutlinedInput label="Name" />}
                        >
                            {trainers.map((trainer) => (
                                <MenuItem key={trainer.id} value={trainer.name}>
                                    {trainer.name} {trainer.surname}
                                </MenuItem>
                            ))}
                        </Select>
                    </FormControl>
                    <Button onClick={handleSend}>Send</Button>
                </Box>
            </Container>
        </>
    );
}
