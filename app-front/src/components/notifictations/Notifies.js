import React, { useState, useEffect } from 'react';
import { ListItem, Typography, Divider, List } from "@mui/material";
import api from "../../api";
import ClearIcon from '@mui/icons-material/Clear';

export default function Notify({ setNotifyCount }) {
    const [notifyData, setNotifyData] = useState([]);
    const [hoveredId, setHoveredId] = useState(null);

    const fetchNotifyData = async () => {
        try {
            const response = await api.get('/get/requests');
            setNotifyData(response.data.success);
            setNotifyCount(response.data.success.length);
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    };

    useEffect(() => {
        fetchNotifyData();
    }, []);

    const softDeleteRequest = async (id) => {
        try {
            await api.put(`/change/request/status/${id}`, { status: 'deleted' });
            fetchNotifyData()
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <List>
            {notifyData.map((item) => (
                <ListItem key={item.id}>
                    <Typography>
                        Request sent at: {item.created_at} Status: {item.status}
                    </Typography>
                    <Divider />
                    <ClearIcon
                        color={hoveredId === item.id ? "primary" : "disabled"}
                        sx={{ position: 'absolute', top: 5, right: 5, cursor: 'pointer' }}
                        onClick={() => softDeleteRequest(item.id)}
                        onMouseEnter={() => setHoveredId(item.id)}
                        onMouseLeave={() => setHoveredId(null)}
                    />
                </ListItem>
            ))}
        </List>
    );
}
