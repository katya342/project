import * as React from 'react';
import { useState } from 'react';
import Avatar from '@mui/material/Avatar';
import Button from '@mui/material/Button';
import CssBaseline from '@mui/material/CssBaseline';
import TextField from '@mui/material/TextField';
import FormControlLabel from '@mui/material/FormControlLabel';
import Checkbox from '@mui/material/Checkbox';
import Link from '@mui/material/Link';
import Grid from '@mui/material/Grid';
import Box from '@mui/material/Box';
import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { useNavigate } from 'react-router-dom';
import { CustomDialog } from '../CustomDialog';
import { Alert } from '@mui/material';
import { useDispatch, useSelector } from 'react-redux';
import { loginUser } from '../../features/auth/authSlice';

export default function SignIn() {
    const [isOpen, setIsOpen] = React.useState(false);


    const [responseData, setResponseData] = useState("");

    const [avatar, setAvatar] = useState("");
    const [alert, setAlertShow] = useState(false);
    const [alertSeverity, setAlertSeverity] = useState("");
 


    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const dispatch = useDispatch();
    const {loading, error} = useSelector((state) => state.auth);



    const navigate = useNavigate();

    const handleDialogOpen = () => {
        setIsOpen(true);
    };

    const handleDialogClose = () => {
        setIsOpen(false);
        navigate('/home');
    };


    const handleSubmit = async (event) => {
        event.preventDefault();
        const userCredentials = {email, password}
        dispatch(loginUser(userCredentials)).then((result) => {
            if(result.payload)
            {
                setEmail('')
                setPassword('')
                navigate('/home')
            }
        })
       
    };
    return (
        <>
            {/* {error && (
               
                <Alert
                    severity="error" onClose={() => { setAlertShow(false) }}
                    sx={{ position: 'fixed', bottom: '20px', right: '20px', zIndex: 9999 }}
                >
                    {error}
                </Alert>
            )} */}
            <ThemeProvider theme={createTheme()}>
                <Container component="main" maxWidth="xs">
                    <CssBaseline />
                    <Box
                        sx={{
                            marginTop: 8,
                            display: 'flex',
                            flexDirection: 'column',
                            alignItems: 'center',
                        }}
                    >
                        <Avatar sx={{ m: 1, bgcolor: 'secondary.main' }}>
                            <LockOutlinedIcon />
                        </Avatar>
                        <Typography component="h1" variant="h5">
                            Sign in
                        </Typography>
                        <Box component="form" onSubmit={handleSubmit} noValidate sx={{ mt: 1 }}>
                            <TextField
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                margin="normal"
                                required
                                fullWidth
                                id="email"
                                label="Email Address"
                                name="email"
                                autoComplete="email"
                                autoFocus
                            />
                            <TextField
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                margin="normal"
                                required
                                fullWidth
                                name="password"
                                label="Password"
                                type="password"
                                id="password"
                                autoComplete="current-password"
                            />
                            <FormControlLabel
                                control={<Checkbox value="remember" color="primary" />}
                                label="Remember me"
                            />
                            <Button
                                type="submit"
                                fullWidth
                                variant="contained"
                                sx={{ mt: 3, mb: 2 }}
                            >
                                Sign In
                            </Button>
                            <Grid container>
                                <Grid item xs>
                                    <Link href="#" variant="body2">
                                        Forgot password?
                                    </Link>
                                </Grid>
                                <Grid item>
                                    <Link component="button" variant="body2" onClick={() => { navigate('/register') }}>
                                        Don't have an account? Sign Up
                                    </Link>
                                </Grid>
                            </Grid>
                        </Box>
                    </Box>
                </Container>
            </ThemeProvider>
            <CustomDialog isOpen={isOpen} title='Successfully authorized' handleClose={handleDialogClose}>
                <p>{responseData.message}</p>
            </CustomDialog>
        </>
    );
}


