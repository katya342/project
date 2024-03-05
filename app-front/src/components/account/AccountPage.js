
import React, { useState, useEffect } from 'react';
import api from '../../api';
import { useNavigate } from 'react-router-dom';
import { Box, Button, Typography, Card, CardContent, Stack, Fab, Container } from '@mui/material';
import EmailIcon from '@mui/icons-material/Email';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import EventAvailableIcon from '@mui/icons-material/EventAvailable';
import EditIcon from '@mui/icons-material/Edit'
import { CustomDialog } from '../CustomDialog';
import SubsComponent from '../subscriptions/SubsComponent';


export default function AccountPage () {
  const [isOpen, setIsOpen] = React.useState(false);
  const [userData, setUserData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [msg, setMsg] = useState("");
  const handleDialogOpen = () => { setIsOpen(true) };
  const handleDialogClose = () => { setIsOpen(false); navigate('/home') };

  const navigate = useNavigate();

  useEffect(() => {

    api.get('/user/data')
      .then(response => {
        setUserData(response.data);
      })
      .catch(error => {
        console.error('Error fetching user data:', error);
        setError("Account not found");
      })
      .finally(() => {
        setLoading(false);
      });
  }, []);

  const handleDeleteAccount = () => {


    const userId = userData && userData.user_id;

    if (userId) {

      api.delete(`/subscription/delete/${userId}`)
        .then(() => {
          return api.delete(`/delete/${userId}`);
        })
        .then(response => {
          localStorage.clear();
          setMsg(response.data.message);
          setIsOpen(true);
          
        })
        .catch(error => {
          setError(error);
        })
    }

  }
  const handleLogoutAccount = () => {

    localStorage.clear();
    navigate('/home');

  };



  if (!userData || loading) {
    return (
      <Container>
        {error}
      </Container>

    );
  }

  return (
    <Box p={10} display={'flex'} justifyContent={'center'} alignItems={'center'}>
      {userData && (
        <Box>
          <Card sx={{ borderRadius: 4, mb: 2, position: 'relative', width: 400 }}>

            <Fab size='small' color="secondary" aria-label="edit" sx={{ position: 'absolute', top: 0, right: 0, m: 1 }}>
              <EditIcon fontSize='small' />
            </Fab>

            <CardContent>
              <Typography variant="h6">User Profile</Typography>
              <Box sx={{ display: 'flex', alignItems: 'center', mb: 1 }}>
                <AccountCircleIcon sx={{ mr: 1 }} />
                <Typography>Name:</Typography>
                <Typography sx={{ ml: 1 }}>{userData.user_name}</Typography>
              </Box>
              <Box sx={{ display: 'flex', alignItems: 'center', mb: 1 }}>
                <EmailIcon sx={{ mr: 1 }} />
                <Typography>Email:</Typography>
                <Typography sx={{ ml: 1 }}>{userData.user_email}</Typography>
              </Box>
              <Box sx={{ display: 'flex', alignItems: 'center' }}>
                <EventAvailableIcon sx={{ mr: 1 }} />
                <Typography>Last workout check:</Typography>
                <Typography sx={{ ml: 1 }}>{userData.last_check}</Typography>
              </Box>
            </CardContent>

          </Card>
          <Stack direction="row" spacing={2}>
            <Button variant='outlined' onClick={handleDeleteAccount}>Delete account</Button>
            <Button variant='outlined' color='error' onClick={handleLogoutAccount}>Logout</Button>
          </Stack>
          <SubsComponent></SubsComponent>
        </Box>
      )}
   
      <CustomDialog handleClose={handleDialogClose} title='Success' isOpen={isOpen}>
        <p>{msg}</p>
      </CustomDialog>
    </Box>
  );
};


