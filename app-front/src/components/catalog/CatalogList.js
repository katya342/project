import * as React from 'react';
import ImageList from '@mui/material/ImageList';
import ImageListItem from '@mui/material/ImageListItem';
import ImageListItemBar from '@mui/material/ImageListItemBar';
import ListSubheader from '@mui/material/ListSubheader';
import IconButton from '@mui/material/IconButton';
import InfoIcon from '@mui/icons-material/Info';
import api from '../../api';
import { BASE_URL } from '../constants';
import { Navigate, useNavigate } from 'react-router-dom';

export default function TitlebarImageList() {
    const [catalogData, setCatalogData] = React.useState([]);
    const navigate = useNavigate();

    const handleImageClick = (catalogId) => {
        navigate(`/workout/details/${catalogId}`);
    }

    React.useEffect(() => {
        const fetchData = async () => {
            const response = await api.get('/catalog');
            setCatalogData(response.data.data);
            console.log(response.data.data);
        }
        fetchData()
    }, [])

    return (
        <div style={{ display: 'flex', justifyContent: 'center' }}> {/* Centering container */}
            <ImageList sx={{ width: 500, height: 450 }}>
                <ImageListItem key="Subheader" cols={2}>
                    <ListSubheader component="div">Check out ready workout setups</ListSubheader>
                </ImageListItem>
                {catalogData.map((item) => (
                    <ImageListItem onClick={() => handleImageClick(item.id)} key={item.id}>
                        <img
                            srcSet={`${BASE_URL}${item.image_path}?w=248&fit=crop&auto=format&dpr=2 2x`}
                            src={`${BASE_URL}${item.image_path}?w=248&fit=crop&auto=format`}
                            alt={item.name}
                            loading="lazy"
                        />
                        <ImageListItemBar
                            title={item.name}
                            subtitle={item.description}
                            actionIcon={
                                <IconButton
                                    sx={{ color: 'rgba(255, 255, 255, 0.54)' }}
                                    aria-label={`info about ${item.name}`}
                                >
                                    <InfoIcon />
                                </IconButton>
                            }
                        />
                    </ImageListItem>
                ))}
            </ImageList>
        </div>
    );
}
