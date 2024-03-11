import { useEffect, useState } from "react";
import api from "../../api";
import { BASE_URL } from "../constants";
import { extractFileName } from '../utils/avatarUtils';
import { Box, Button, Rating, TextField, Typography, Alert, Avatar, Container } from "@mui/material";
import ClearIcon from '@mui/icons-material/Clear';

export default function FeedBack (props) {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [inputValue, setInputValue] = useState("");
    const [value, setValue] = useState(0);
    const [rating, setRating] = useState(0);
    const [alert, setAlertShow] = useState(false);
    const [alertSeverity, setAlertSeverity] = useState("");
    const [alertMessage, setAlertMessage] = useState("");
    const [isHovered, setIsHovered] = useState(false); 
  
    const fetchData = async () => {
        try {
            const response = await api.get(`feedbacks/${props.planId}`);
            setData(response.data.success);
        } catch (error) {
            setError(error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchData();
    }, [props.planId]);

    const handleDeleteComment = async (feedbackId) => {
        try {
            await api.delete(`/delete/feedback/${feedbackId}`);
            fetchData();
        } catch (error) {
            console.error("Error deleting comment:", error);
        }
    };

    const handleAddComment = async () => {
        try {
            await api.post(`/add/feedback/${props.planId}/${props.trainerId}`, {
                
                comment: inputValue,
                rating: value
            });
            setInputValue("");
            setRating(0);
            fetchData();
        } catch (error) {
            setAlertShow(true);
            setAlertSeverity("error");
            setAlertMessage(error.response.data.message)
            console.error("Error adding comment:", error);
        }
    };

    const handleChange = (event) => {
        setInputValue(event.target.value);
    };

    const formatDate = (dateStr) => {
        const date = new Date(dateStr);
        return date.toLocaleString();
    };

    return (
        <Box>
             {alert && (
                <Alert 
                     
                    severity={alertSeverity} onClose={() => {setAlertShow(false)}}
                    sx={{ position: 'fixed', top: 0, left: 0, right: 0, zIndex: 9999 }} 
                >
                    {alertMessage}
                </Alert>
            )}
            {data.map((item) => (
                <Box 
                    key={item.id} 
                    border={1} 
                    position="relative" 
                    sx={{ marginBottom: 1 }} 
                    onMouseEnter={() => setIsHovered(true)} 
                    onMouseLeave={() => setIsHovered(false)} 
                >
                    <Avatar src={`${BASE_URL}storage/${extractFileName(item.avatar)}`} alt="Cannot display image" width={50} />
                    <Typography>{item.user.name}</Typography>
                    <Typography>{item.name}</Typography>
                    <Typography>{item.comment}</Typography>
                    <Typography variant="caption">Rating: <Rating name="read-only" size="small" value={item.rating} readOnly /></Typography>
                    <Typography>Posted on: {formatDate(item.created_at)}</Typography>
                    {localStorage.getItem('token') === item.user.remember_token && (
                        <ClearIcon 
                            color={isHovered ? "primary" : "disabled"} 
                            sx={{ position: 'absolute', top: 5, right: 5, cursor: 'pointer' }} 
                            onClick={() => handleDeleteComment(item.id)} 
                        />
                    )};
                </Box>
            ))}
            <TextField placeholder="Write comment here" value={inputValue} onChange={handleChange} multiline rows={5} />
            <Rating name="simple-controlled" value={value} onChange={(event, newValue) => { setValue(newValue) }} />
            <Button variant="outlined" onClick={handleAddComment}>Add comment</Button>
        </Box>
    );
};


